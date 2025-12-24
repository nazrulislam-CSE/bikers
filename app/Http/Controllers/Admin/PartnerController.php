<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use Illuminate\Support\Carbon;
use Session;
use Str;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Partner List';
        $partners = Partner::latest()->get();
        return view('admin.partner.index',compact('partners','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Partner Create';
        return view('admin.partner.create',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            // 'description' => 'required',
        ]);


        $partner = new Partner;

        if($request->status == Null){
            $request->status = 0;
        }
      
        $partner->status = $request->status;
        $partner->name = $request->name;
        $partner->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name)));
        $partner->description = $request->description;
        $partner->created_at = Carbon::now();
        $partner->save();


        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/partner/'.$partner->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/partner'),$filename);
            $partner['image'] = $filename;
        }

        $partner->save();

        flash()->addSuccess("Partner Created Successfully.");
        $url = '/admin/partner/index';
        return redirect($url);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Partner Show';
        $partner = Partner::find($id);
        return view('admin.partner.show',compact('pageTitle','partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $partner = Partner::find($id);
        $pageTitle = 'Partner Edit';
        return view('admin.partner.edit', compact('partner','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $partner = Partner::find($id);

        if($request->status == Null){
            $request->status = 0;
        }
      
        $partner->status = $request->status;
        $partner->name = $request->name;
        $partner->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name)));
        $partner->description = $request->description;
        $partner->created_at = Carbon::now();
        $partner->save();


        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/partner/'.$partner->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/partner'),$filename);
            $partner['image'] = $filename;
        }

        $partner->save();

        flash()->addSuccess("Partner Updated Successfully.");
        $url = '/admin/partner/index';
        return redirect($url);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $partner = Partner::find($id);

        try {
            if(file_exists($partner->image)){
                unlink($partner->image);
            }
        } catch (Exception $e) {

        }


        $partner->delete();

        flash()->addError("Partner Deleted Successfully.");
        $url = '/admin/partner/index';
        return redirect($url);
    }
}
