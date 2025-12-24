<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UmrahTour;
use App\Models\Payment;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        // dd($request->all());
        $umrahtour_id  = $request->umrahtour_id;
        $payment_method  = $request->payment_method;
        $singleTour = UmrahTour::find($umrahtour_id);
        $pageTitle = 'Payment Method';

        return view('frontend.payment.create',compact('singleTour','payment_method','pageTitle'));
    }

    public function store(Request $request){
        // Validate the incoming request data
        $request->validate([
            'umrahtour_id' => 'required|exists:umrahtours,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'sender_number' => 'required|string|max:20',
            'total_amount' => 'required|numeric',
            'payment_number' => 'required|string|max:20',
            'transaction_id' => 'required|string|max:100|unique:payments,transaction_id',
            'screenshot' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'payment_method' => 'required|string|max:50',
        ]);

        if ($request->hasFile('screenshot')) {

            $screenshot  = $request->file('screenshot');
            // dd($screenshot);
            $filename    = uniqid() . '.' . $screenshot->extension('screenshot');
            $location    = public_path('upload/screenshot');

            $screenshot->move($location, $filename);
            // return 'ok';
        }

        // Create the payment record
        Payment::create([
            'umrahtour_id' => $request->umrahtour_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'sender_number' => $request->sender_number,
            'total_amount' => $request->total_amount,
            'payment_number' => $request->payment_number,
            'transaction_id' => $request->transaction_id,
            'screenshot' => $filename,
            'payment_method' => $request->payment_method,
            'status' => 'Pending', // Default status
        ]);

        return redirect()->route('frontend.home')->with('success', 'Order successfully placed.');
    }

}
