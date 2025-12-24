<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Carbon;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Service List';
        $services = Service::latest()->get();
        return view('admin.service.index',compact('services','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Service Create';
        return view('admin.service.create',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            // 'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        $service = new Service;
        $service->title = $request->title;
        $service->description = $request->description;

        if($request->status == Null){
            $request->status = 0;
        }
        $service->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title)));
        $service->status = $request->status;
        $service->created_at = Carbon::now();
        $service->save();

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/service/'.$service->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/service'),$filename);
            $service['image'] = $filename;
        }

        $service->save();

        flash()->addSuccess("Service Created Successfully.");
        $url = '/admin/service/index';
        return redirect($url);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Service Show';
        $service = Service::find($id);
        return view('admin.service.show',compact('pageTitle','service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::find($id);
        $pageTitle = 'Service Edit';
        return view('admin.service.edit', compact('service','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = Service::find($id);

        $service->title = $request->title;
        $service->description = $request->description;


        if($request->status == Null){
            $request->status = 0;
        }

        $service->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title)));
        $service->status = $request->status;

        $service->updated_at = Carbon::now();

        $service->save();

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/service/'.$service->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/service'),$filename);
            $service['image'] = $filename;
        }

        $service->save();

        flash()->addSuccess("Service Updated Successfully.");
        $url = '/admin/service/index';
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);

        try {
            if(file_exists($service->image)){
                unlink($service->image);
            }
        } catch (Exception $e) {

        }


        $service->delete();

        flash()->addError("Service Deleted Successfully.");
        $url = '/admin/service/index';
        return redirect($url);
    }
}
