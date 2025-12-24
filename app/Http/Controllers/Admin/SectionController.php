<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Section List';
        $sections = Section::latest()->get();
        return view('admin.section.index',compact('pageTitle','sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Section Create';
        return view('admin.section.create',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' =>'required',
            'title' =>'required',
          'status'=>'required',
        ]);

        Section::create([
            'name' => $request->name,
            'title' => $request->title,
            'slug' => preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name))),
            'status' => $request->status,
        ]);

        flash()->addSuccess("Section Created Successfully.");
        $url = '/admin/sections/index';
        return redirect($url);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Section View';
        $section = Section::find($id);
        return view('admin.section.show',compact('pageTitle','section'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Section Edit';
        $section = Section::find($id);
        return view('admin.section.edit',compact('pageTitle','section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $this->validate($request, [
        //     'name' =>'required',
        //     'title' =>'required',
        //   'status'=>'required',
        // ]);

        $section = Section::find($id);
        $section->name = $request->name;
        $section->title = $request->title;
        $section->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name)));
        $section->status = $request->status;
        $section->save();

        flash()->addSuccess("Section Updated Successfully.");
        $url = '/admin/sections/index';
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = Section::find($id);
        $section->delete();

        flash()->addError("Section Deleted Successfully.");
        $url = '/admin/sections/index';
        return redirect($url);
    }
}
