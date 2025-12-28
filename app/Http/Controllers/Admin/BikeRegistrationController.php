<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BikeRegistration;
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

}