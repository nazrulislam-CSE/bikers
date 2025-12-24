<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Carbon;
use Session;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Team List';
        $teams = Team::latest()->get();
        return view('admin.team.index',compact('teams','pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Team Create';
        return view('admin.team.create',compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'designation' => 'required',
            // 'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            // 'description' => 'required',
        ]);


        $team = new Team;

        $team->name            = $request->name;
        $team->phone           = $request->phone;
        $team->address         = $request->address;
        $team->designation     = $request->designation;
        $team->description     = $request->description;
        $team->facebook_url    = $request->facebook_url;
        $team->linkedin_url    = $request->linkedin_url;
        $team->twitter_url     = $request->twitter_url;
        $team->whatsapp_url    = $request->whatsapp_url;

        if($request->status == Null){
            $request->status = 0;
        }
        $team->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name)));
        $team->status = $request->status;
        $team->created_at = Carbon::now();
        $team->save();


        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/team/'.$team->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/team'),$filename);
            $team['image'] = $filename;
        }

        $team->save();

        flash()->addSuccess("Team Created Successfully.");
        $url = '/admin/teams/index';
        return redirect($url);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Team Show';
        $team = Team::find($id);
        return view('admin.team.show',compact('pageTitle','team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $team = Team::find($id);
        $pageTitle = 'Team Edit';
        return view('admin.team.edit', compact('team','pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $team = Team::find($id);

        $team->name            = $request->name;
        $team->phone           = $request->phone;
        $team->address         = $request->address;
        $team->designation     = $request->designation;
        $team->description     = $request->description;
        $team->facebook_url    = $request->facebook_url;
        $team->linkedin_url    = $request->linkedin_url;
        $team->twitter_url     = $request->twitter_url;
        $team->whatsapp_url    = $request->whatsapp_url;


        if($request->status == Null){
            $request->status = 0;
        }
        $team->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name)));
        $team->status = $request->status;


        $team->updated_at = Carbon::now();

        $team->save();

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/team/'.$team->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/team'),$filename);
            $team['image'] = $filename;
        }

        $team->save();


        flash()->addSuccess("Team Updated Successfully.");
        $url = '/admin/teams/index';
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::find($id);

        try {
            if(file_exists($team->image)){
                unlink($team->image);
            }
        } catch (Exception $e) {

        }

        $team->delete();


        flash()->addError("Team Deleted Successfully.");
        $url = '/admin/teams/index';
        return redirect($url);
    }

    public function active($id){

        $team = Team::find($id);
        $team->status = 1;
        $team->save();

        flash()->addSuccess("Team Active Successfully.");
        $url = '/admin/teams/index';
        return redirect($url);
    }

    public function inactive($id){
        $team = Team::find($id);
        $team->status = 0;
        $team->save();

        flash()->addSuccess("Team InActive Successfully.");
        $url = '/admin/teams/index';
        return redirect($url);
    }
}
