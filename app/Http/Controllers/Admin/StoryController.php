<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Story;
use Carbon\Carbon;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Story List';
        $stories = Story::latest()->get();
        return view('admin.story.index',compact('pageTitle','stories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Add Story';
        return view('admin.story.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'title' => 'required',
        ]);


        $story = new Story;

        if($request->status == Null){
            $request->status = 0;
        }
      
        $story->title = $request->title;
        $story->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title)));
        $story->excerpt = $request->excerpt;
        $story->content = $request->content;
        $story->status = $request->status;
        $story->created_at = Carbon::now();
        $story->save();


        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/story/'.$story->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/story'),$filename);
            $story['image'] = $filename;
        }

        $story->save();

        flash()->addSuccess("Story Created Successfully.");
        $url = '/admin/story';
        return redirect($url);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Story Show';
        $story = Story::find($id);
        return view('admin.story.show',compact('pageTitle','story'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $story = Story::find($id);
        $pageTitle = 'Story Edit';
        return view('admin.story.edit', compact('story','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $story = Story::find($id);

        $story->title = $request->title;
        $story->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->title)));
        $story->excerpt = $request->excerpt;
        $story->content = $request->content;
        $story->status = $request->status;

        $story->updated_at = Carbon::now();

        $story->save();

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/story/'.$story->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/story'),$filename);
            $story['image'] = $filename;
        }

        $story->save();

        flash()->addSuccess("Story Updated Successfully.");
        $url = '/admin/story';
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $story = Story::find($id);

        try {
            if(file_exists($story->image)){
                unlink($story->image);
            }
        } catch (Exception $e) {

        }


        $story->delete();

        flash()->addError("Story Deleted Successfully.");
        $url = '/admin/story';
        return redirect($url);
    }
}
