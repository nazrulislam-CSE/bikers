<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BikeRegistration;
use App\Models\BikePayment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class BikeRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageTitle = 'Bike Registration List';
        
        $query = BikeRegistration::with('user')->latest();
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Filter by registration date if provided
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }
        
        // Search by registration number or name
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('registration_no', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('mobile', 'like', "%{$search}%")
                  ->orWhere('bike_name', 'like', "%{$search}%");
            });
        }
        
        $registrations = $query->paginate(20);
        
        return view('admin.bike.index', compact('pageTitle', 'registrations'));
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Bike Registration Details';
        $bike = BikeRegistration::with('user')->findOrFail($id);
        return view('admin.bike.show', compact('pageTitle', 'bike'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Bike Registration';
        $bike = BikeRegistration::findOrFail($id);
        $users = User::where('status', 'active')->latest()->get();
        return view('admin.bike.edit', compact('pageTitle', 'bike', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bike = BikeRegistration::findOrFail($id);

        $request->validate([
            // 'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'bike_name' => 'required|string|max:255',
            'registration_no' => 'required|string|max:50|unique:bike_registrations,registration_no,' . $id,
            'registration_fee' => 'nullable|numeric',
            'payment_method' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bike_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_slip' => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $data = $request->all();

        // Handle file uploads
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($bike->photo) {
                Storage::disk('public')->delete($bike->photo);
            }
            $data['photo'] = $request->file('photo')->store('members', 'public');
        }

        if ($request->hasFile('bike_photo')) {
            // Delete old bike photo if exists
            if ($bike->bike_photo) {
                Storage::disk('public')->delete($bike->bike_photo);
            }
            $data['bike_photo'] = $request->file('bike_photo')->store('bikes', 'public');
        }

        if ($request->hasFile('payment_slip')) {
            // Delete old payment slip if exists
            if ($bike->payment_slip) {
                Storage::disk('public')->delete($bike->payment_slip);
            }
            $data['payment_slip'] = $request->file('payment_slip')->store('slips', 'public');
        }

        $bike->update($data);

        flash()->addSuccess("Bike registration updated successfully!");
        $url = '/admin/bike/register/index';
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bike = BikeRegistration::findOrFail($id);

        // Delete associated files
        if ($bike->photo) {
            Storage::disk('public')->delete($bike->photo);
        }
        if ($bike->bike_photo) {
            Storage::disk('public')->delete($bike->bike_photo);
        }
        if ($bike->payment_slip) {
            Storage::disk('public')->delete($bike->payment_slip);
        }

        $bike->delete();

        flash()->addSuccess("Bike registration deleted successfully!");
        $url = '/admin/bike/register/index';
        return redirect($url);
    }

    /**
     * Quick status update
     */

    public function changeStatus($id)
    {
        $bike = BikeRegistration::findOrFail($id);

        if($bike->status == 'pending'){
            $bike->status = 'approved';
        }
        elseif($bike->status == 'approved'){
            $bike->status = 'rejected';
        }
        else{
            $bike->status = 'pending';
        }

        $bike->save();

        flash()->addSuccess("Status Updated Successfully");
        $url = '/admin/bike/register/index';
        return redirect($url);
    }

     /**
     * Display payment list
     */
    public function paymentIndex(Request $request)
    {
        $pageTitle = 'Bike Payment List';
        
        $query = BikePayment::with(['user', 'bike'])->latest();
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Filter by approval status if provided
        if ($request->has('approval_status') && $request->approval_status != '') {
            $query->where('approval_status', $request->approval_status);
        }
        
        // Filter by payment method if provided
        if ($request->has('payment_method') && $request->payment_method != '') {
            $query->where('payment_method', $request->payment_method);
        }
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                              ->orWhere('email', 'like', "%{$search}%")
                              ->orWhere('phone', 'like', "%{$search}%");
                })
                ->orWhereHas('bike', function($bikeQuery) use ($search) {
                    $bikeQuery->where('registration_number', 'like', "%{$search}%")
                              ->orWhere('owner_name', 'like', "%{$search}%");
                })
                ->orWhere('plan', 'like', "%{$search}%")
                ->orWhere('payment_method', 'like', "%{$search}%");
            });
        }
        
        $payments = $query->paginate(20);
        
        // Get statistics
        $totalPayments = BikePayment::count();
        $pendingPayments = BikePayment::where('approval_status', 'pending')->count();
        $approvedPayments = BikePayment::where('approval_status', 'approved')->count();
        $totalRevenue = BikePayment::where('approval_status', 'approved')->sum('total_paid');
        
        return view('admin.bike.payment.index', compact(
            'pageTitle',
            'payments',
            'totalPayments',
            'pendingPayments',
            'approvedPayments',
            'totalRevenue'
        ));
    }

    /**
     * Show payment details
     */
    public function showPayment($id)
    {
        $payment = BikePayment::with(['user', 'bike'])->findOrFail($id);
        $pageTitle = 'Payment Details';
        
        return view('admin.bike.payment.show', compact('payment', 'pageTitle'));
    }

    /**
     * Approve a payment
     */
    public function approvePayment(Request $request, $id)
    {
        $payment = BikePayment::findOrFail($id);
        
        // Check if payment is already approved
        if ($payment->approval_status == 'approved') {
            return redirect()->route('admin.bike.register.payment')
                ->with('error', 'Payment is already approved!');
        }
        
        // Update payment status
        $payment->due_days = max(0, $payment->due_days - 1);
        $payment->due_amount = max(0, $payment->due_amount - $payment->fixed_amount);
        $payment->total_paid += $payment->fixed_amount;
        $payment->last_paid_date = now();
        $payment->approval_status = 'approved';
        $payment->save();
        
        // Auto-block if due days exceed limit
        $payment->autoBlock();
        
        return redirect()->route('admin.bike.register.payment')
            ->with('success', 'Payment approved successfully!');
    }

    /**
     * Reject a payment
     */
    public function rejectPayment(Request $request, $id)
    {
        $payment = BikePayment::findOrFail($id);
        
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);
        
        $payment->update([
            'approval_status' => 'rejected',
            'notes' => $request->rejection_reason . (($payment->notes ? "\n\n" : '') . $payment->notes),
        ]);
        
        return redirect()->route('admin.bike.register.payment.index')
            ->with('success', 'Payment rejected successfully!');
    }

    /**
     * Block a payment
     */
    public function blockPayment($id)
    {
        $payment = BikePayment::findOrFail($id);
        $payment->update(['status' => 'blocked']);
        
        return redirect()->route('admin.bike.register.payment')
            ->with('success', 'Payment blocked successfully!');
    }

    /**
     * Unblock a payment
     */
    public function unblockPayment($id)
    {
        $payment = BikePayment::findOrFail($id);
        $payment->update(['status' => 'active']);
        
        return redirect()->route('admin.bike.register.payment')
            ->with('success', 'Payment unblocked successfully!');
    }

    /**
     * Delete a payment
     */
    public function destroyPayment($id)
    {
        $payment = BikePayment::findOrFail($id);
        
        // Delete payment slip if exists
        if ($payment->payment_slip && \Illuminate\Support\Facades\Storage::disk('public')->exists($payment->payment_slip)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($payment->payment_slip);
        }
        
        $payment->delete();
        
        return redirect()->route('admin.bike.register.payment')
            ->with('success', 'Payment deleted successfully!');
    }

    /**
     * View payment slip
     */
    public function viewSlipPayment($id)
    {
        $payment = BikePayment::findOrFail($id);
        
        if (!$payment->payment_slip) {
            abort(404, 'Payment slip not found.');
        }
        
        $path = storage_path('app/public/' . $payment->payment_slip);
        
        if (!file_exists($path)) {
            abort(404, 'Payment slip file not found.');
        }
        
        return response()->file($path);
    }

    /**
     * Generate payment report
     */
    public function reportPayment(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'report_type' => 'required|in:all,approved,pending,rejected',
        ]);
        
        $query = BikePayment::with(['user', 'bike'])
            ->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        
        if ($request->report_type != 'all') {
            $query->where('approval_status', $request->report_type);
        }
        
        $payments = $query->get();
        
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $report_type = $request->report_type;
        
        return view('admin.bike.payment.report', compact('payments', 'start_date', 'end_date', 'report_type'));
    }
}