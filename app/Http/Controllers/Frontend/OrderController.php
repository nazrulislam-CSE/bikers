<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function storeSessionAndRedirect(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        session([
            'checkout_product_id' => $request->product_id,
            'checkout_quantity' => $request->quantity,
        ]);

        return redirect()->route('product.checkout.page');
    }

    public function checkoutPage()
    {
        $productId = session('checkout_product_id');
        $quantity = session('checkout_quantity');

        if (!$productId || !$quantity) {
            return redirect()->route('frontend.home')->with('error', 'অবৈধ অনুরোধ');
        }

        $product = Product::findOrFail($productId);

        $pageTitle = 'Checkout Page';
        return view('frontend.product.checkout', compact('product', 'quantity','pageTitle'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'division' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'upazila' => 'nullable|string|max:100',
            'union' => 'nullable|string|max:100',
            'address' => 'required|string',
            'payment_method' => 'required|in:cod,bkash,nagad',
            'delivery_area' => 'required|in:inside_dhaka,outside_dhaka',
            'delivery_charge' => 'required|numeric|min:0',
        ]);

        // Fetch product price
        $product = Product::findOrFail($request->product_id);
        $subtotal = $product->gross_price * $request->quantity;
        $total = $subtotal + $request->delivery_charge;

        // Save order
        $order = new Order();
        $order->product_id = $request->product_id;
        $order->quantity = $request->quantity;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->email = $request->email;
        $order->division = $request->division;
        $order->district = $request->district;
        $order->upazila = $request->upazila;
        $order->union = $request->union;
        $order->address = $request->address;
        $order->payment_method = $request->payment_method;

        // New fields
        $order->delivery_area = $request->delivery_area;
        $order->delivery_charge = $request->delivery_charge;
        $order->subtotal = $subtotal;
        $order->total_amount = $total;

        $order->status = 'pending';
        $order->save();

        // ✅ Clear session data
        session()->forget(['checkout_product_id', 'checkout_quantity']);

        return redirect()->route('product.order.success')->with('success', 'আপনার অর্ডার সফলভাবে সম্পন্ন হয়েছে!');
    }


    public function success(Request $request)
    {
        $pageTitle = 'Order Success Page';
        return view('frontend.product.order_success', compact('pageTitle'));
    }


}
