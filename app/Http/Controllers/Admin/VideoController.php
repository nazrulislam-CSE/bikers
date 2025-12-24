<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Carbon;
use Session;


class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Video List';
        $videos = Video::latest()->get();
        return view('admin.video.index',compact('videos','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Video Create';
        return view('admin.video.create',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'url' => 'required',
            'title' => 'required',
        ]);


        $video = new Video;

        if($request->status == Null){
            $request->status = 0;
        }
      
        $video->status = $request->status;
        $video->url = $request->url;
        $video->title = $request->title;
        $video->caption = $request->description;
        $video->created_at = Carbon::now();
        $video->save();


        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/video/'.$video->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/video'),$filename);
            $video['image'] = $filename;
        }

        $video->save();

        flash()->addSuccess("Video Created Successfully.");
        $url = '/admin/video/index';
        return redirect($url);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Video Show';
        $video = Video::find($id);
        return view('admin.video.show',compact('pageTitle','video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $video = Video::find($id);
        $pageTitle = 'Video Edit';
        return view('admin.video.edit', compact('video','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $video = Video::find($id);

        if($request->status == Null){
            $request->status = 0;
        }
      
        $video->status = $request->status;
        $video->url = $request->url;
        $video->title = $request->title;
        $video->caption = $request->description;
        $video->created_at = Carbon::now();
        $video->save();


        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/video/'.$video->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/video'),$filename);
            $video['image'] = $filename;
        }

        $video->save();

        flash()->addSuccess("Video Updated Successfully.");
        $url = '/admin/video/index';
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $video = Video::find($id);

        try {
            if(file_exists($video->image)){
                unlink($video->image);
            }
        } catch (Exception $e) {

        }

        $video->delete();


        flash()->addError("Video Deleted Successfully.");
        $url = '/admin/video/index';
        return redirect($url);
    }
}
