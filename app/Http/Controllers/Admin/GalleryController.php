<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Carbon;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Gallery List';
        $gallerys = Gallery::latest()->get();
        return view('admin.gallery.index',compact('gallerys','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Gallery Create';
        return view('admin.gallery.create',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'title' => 'required',
            // 'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        $gallery = new Gallery;
        $gallery->title = $request->title;
        $gallery->description = $request->description;

        if($request->status == Null){
            $request->status = 0;
        }
        $gallery->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title)));
        $gallery->status = $request->status;
        $gallery->created_at = Carbon::now();
        $gallery->save();

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/gallery/'.$gallery->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/gallery'),$filename);
            $gallery['image'] = $filename;
        }

        $gallery->save();

        flash()->addSuccess("Gallery Created Successfully.");
        $url = '/admin/gallery/index';
        return redirect($url);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Gallery Show';
        $gallery = Gallery::find($id);
        return view('admin.gallery.show',compact('pageTitle','gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::find($id);
        $pageTitle = 'Gallery Edit';
        return view('admin.gallery.edit', compact('gallery','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gallery = Gallery::find($id);

        $gallery->title = $request->title;
        $gallery->description = $request->description;


        if($request->status == Null){
            $request->status = 0;
        }

        $gallery->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title)));
        $gallery->status = $request->status;

        $gallery->updated_at = Carbon::now();

        $gallery->save();

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/gallery/'.$gallery->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/gallery'),$filename);
            $gallery['image'] = $filename;
        }

        $gallery->save();

        flash()->addSuccess("Gallery Updated Successfully.");
        $url = '/admin/gallery/index';
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::find($id);

        try {
            if(file_exists($gallery->image)){
                unlink($gallery->image);
            }
        } catch (Exception $e) {

        }


        $gallery->delete();

        flash()->addError("Gallery Deleted Successfully.");
        $url = '/admin/gallery/index';
        return redirect($url);
    }
}
