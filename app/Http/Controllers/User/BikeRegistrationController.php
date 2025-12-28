<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BikeRegistration;
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
}
