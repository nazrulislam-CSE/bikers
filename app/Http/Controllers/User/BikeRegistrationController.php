<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BikeRegistration;
use App\Models\BikePayment;
use Illuminate\Support\Facades\Auth;

class BikeRegistrationController extends Controller
{
    public function index()
    {
        $pageTitle = 'Register My Bike List';
        $registrations = BikeRegistration::where('user_id',auth()->id())->latest()->get();

        $total = $registrations->count();
        $approved = $registrations->where('status','approved')->count();
        $pending = $registrations->where('status','pending')->count();

        $today = now()->format('Y-m-d');

       $todayDue = $registrations->filter(function($r) use ($today){
            return $r->last_payment_date != $today;
        })->count();

        return view('user.bike.index',compact(
            'pageTitle','registrations','total','approved','pending','todayDue'
        ));
    }

    public function create()
    {
        $pageTitle = 'Register My Bike';
        return view('user.bike.create',compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|regex:/^[0-9]{11}$/',
            'email' => 'nullable|email',
            'bike_name' => 'required',
            'registration_no' => 'required|unique:bike_registrations',
            'registration_fee' => 'nullable|numeric',
            'payment_method' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bike_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_slip' => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);


        $data = $request->all();
        $data['user_id'] = auth()->id();

        if($request->hasFile('photo')){
            $data['photo'] = $request->file('photo')->store('members','public');
        }
        if($request->hasFile('bike_photo')){
            $data['bike_photo'] = $request->file('bike_photo')->store('bikes','public');
        }
        if($request->hasFile('payment_slip')){
            $data['payment_slip'] = $request->file('payment_slip')->store('slips','public');
        }

        BikeRegistration::create($data);

        flash()->addSuccess("Bike Registered Successfully!");
        $url = '/user/bike/register/index';
        return redirect($url);
    }

    public function show($id)
    {
        $pageTitle = 'Bike Registration Details';
        $registration = BikeRegistration::where('user_id',auth()->id())->findOrFail($id);
        return view('user.bike.show',compact('pageTitle','registration'));
    }

    public function payment()
    {
        $payments = BikePayment::with('bike')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Summary
        $totalPaid = $payments->sum('total_paid');
        $totalDue  = $payments->sum('due_amount');
        
        // Today's due (next_due_date <= today && approval_status approved)
        $todayDue = $payments->filter(function($p){
            return $p->next_due_date && $p->next_due_date->lte(now()) && $p->approval_status == 'approved';
        })->sum('fixed_amount');

        return view('user.bike.payment.index', [
            'pageTitle' => 'Bike Payments',
            'payments' => $payments,
            'totalPaid' => $totalPaid,
            'totalDue' => $totalDue,
            'todayDue' => $todayDue,
        ]);
    }


    public function paymentNow(Request $request)
    {
        $userBikes = BikeRegistration::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->get();

        $selected_bike_id = null;
        $due_payment = null;

        // If paying for specific due payment
        if ($request->has('payment_id')) {
            $due_payment = BikePayment::where('id', $request->payment_id)
                ->where('user_id', Auth::id())
                ->first();

            if ($due_payment) {
                $selected_bike_id = $due_payment->bike_registration_id;
            }
        }

        return view('user.bike.payment.create', [
            'pageTitle' => 'Make Payment',
            'bikes' => $userBikes,
            'selected_bike_id' => $selected_bike_id,
            'due_payment' => $due_payment
        ]);
    }

    public function  paymentStore(Request $request){
        $request->validate([
            'bike_registration_id' => 'required|exists:bike_registrations,id',
            'plan' => 'required|in:daily,weekly',
            'fixed_amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,bank_transfer,mobile_banking,card',
            'payment_slip' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'terms' => 'required|accepted',
        ]);

        // Check if bike belongs to user
        $bike = BikeRegistration::where('id', $request->bike_registration_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Handle file upload
        $paymentSlipPath = null;
        if ($request->hasFile('payment_slip')) {
            $paymentSlipPath = $request->file('payment_slip')->store('payment-slips', 'public');
        }

        // Calculate next due date
        $nextDueDate = now()->add($request->plan == 'daily' ? 1 : 7, 'day');

        // Create payment
        $payment = BikePayment::create([
            'user_id' => Auth::id(),
            'bike_registration_id' => $request->bike_registration_id,
            'plan' => $request->plan,
            'fixed_amount' => $request->fixed_amount,
            'payment_method' => $request->payment_method,
            'payment_slip' => $paymentSlipPath,
            'last_paid_date' => null, // Will be set when approved
            'next_due_date' => $nextDueDate,
            'due_days' => 0,
            'due_amount' => 0,
            'total_paid' => 0,
            'status' => 'active',
            'approval_status' => 'pending',
            'notes' => $request->notes,
        ]);

        flash()->addSuccess("Payment submitted successfully! Waiting for admin approval.");
        $url = '/user/bike/register/payment';
        return redirect($url);
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $payment = BikePayment::with('bike')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Only allow editing pending payments
        if ($payment->approval_status != 'pending') {
            return redirect()->route('user.bike.payments.index')
                ->with('error', 'Only pending payments can be edited.');
        }

        return view('user.bike-payments.edit', [
            'pageTitle' => 'Edit Payment',
            'payment' => $payment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $payment = BikePayment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Only allow updating pending payments
        if ($payment->approval_status != 'pending') {
            return redirect()->route('user.bike.register.payment')
                ->with('error', 'Only pending payments can be updated.');
        }

        $request->validate([
            'plan' => 'required|in:daily,weekly',
            'fixed_amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|in:cash,bank_transfer,mobile_banking,card',
            'payment_slip' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'next_due_date' => 'nullable|date',
        ]);

        // Handle file upload
        if ($request->hasFile('payment_slip')) {
            // Delete old slip if exists
            if ($payment->payment_slip && Storage::disk('public')->exists($payment->payment_slip)) {
                Storage::disk('public')->delete($payment->payment_slip);
            }
            
            $paymentSlipPath = $request->file('payment_slip')->store('payment-slips', 'public');
            $payment->payment_slip = $paymentSlipPath;
        }

        $payment->update([
            'plan' => $request->plan,
            'fixed_amount' => $request->fixed_amount,
            'payment_method' => $request->payment_method,
            'next_due_date' => $request->next_due_date ?: $payment->next_due_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('user.bike.register.payment')
            ->with('success', 'Payment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $payment = BikePayment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Only allow deleting pending payments
        if ($payment->approval_status != 'pending') {
            return redirect()->route('user.bike.register.payment')
                ->with('error', 'Only pending payments can be deleted.');
        }

        // Delete payment slip if exists
        if ($payment->payment_slip && Storage::disk('public')->exists($payment->payment_slip)) {
            Storage::disk('public')->delete($payment->payment_slip);
        }

        $payment->delete();

        return redirect()->route('user.bike.register.payment')
            ->with('success', 'Payment deleted successfully!');
    }

    /**
     * View payment slip
     */
    public function viewSlip($id)
    {
        $payment = BikePayment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$payment->payment_slip) {
            abort(404);
        }

        $path = storage_path('app/public/' . $payment->payment_slip);
        
        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }

    
}
