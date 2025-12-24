<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Carbon;
use Session;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Testimonial List';
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonial.index',compact('testimonials','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Testimonial Create';
        return view('admin.testimonial.create',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            // 'description' => 'required',
        ]);


        $testimonial = new Testimonial;

        $testimonial->name            = $request->name;
        $testimonial->designation     = $request->designation;
        $testimonial->description     = $request->description;

        if($request->status == Null){
            $request->status = 0;
        }
       
        $testimonial->status = $request->status;
        $testimonial->created_at = Carbon::now();
        $testimonial->save();


        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/testimonial/'.$testimonial->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/testimonial'),$filename);
            $testimonial['image'] = $filename;
        }

        $testimonial->save();

        flash()->addSuccess("Testimonial Created Successfully.");
        $url = '/admin/testimonials/index';
        return redirect($url);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Testimonial Show';
        $testimonial = Testimonial::find($id);
        return view('admin.testimonial.show',compact('pageTitle','testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testimonial = Testimonial::find($id);
        $pageTitle = 'Testimonial Edit';
        return view('admin.testimonial.edit', compact('testimonial','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testimonial = Testimonial::find($id);

        $testimonial->name            = $request->name;
        $testimonial->designation     = $request->designation;
        $testimonial->description     = $request->description;


        if($request->status == Null){
            $request->status = 0;
        }
      
        $testimonial->status = $request->status;


        $testimonial->updated_at = Carbon::now();

        $testimonial->save();

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/testimonial/'.$testimonial->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/testimonial'),$filename);
            $testimonial['image'] = $filename;
        }

        $testimonial->save();


        flash()->addSuccess("Testimonial Updated Successfully.");
        $url = '/admin/testimonials/index';
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::find($id);

        try {
            if(file_exists($testimonial->image)){
                unlink('upload/testimonial/'.$testimonial->image);
            }
        } catch (Exception $e) {

        }

        $testimonial->delete();


        flash()->addError("Testimonial Deleted Successfully.");
        $url = '/admin/testimonials/index';
        return redirect($url);
    }
}
