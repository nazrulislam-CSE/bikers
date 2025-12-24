<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsEvent;
use Illuminate\Support\Facades\Storage;

class NewsEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'News & Events';
        $newsEvents = NewsEvent::latest()->get();

        return view('admin.newsevent.index', compact('pageTitle', 'newsEvents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Add News/Event';
        return view('admin.newsevent.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'venue' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
        ]);


        NewsEvent::create($validated);

        return redirect()->route('admin.news-events.index')
            ->with('success', 'News/Event created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit News/Event';
        $newsEvent = NewsEvent::findOrFail($id);

        return view('admin.newsevent.edit', compact('pageTitle', 'newsEvent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $newsEvent = NewsEvent::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'venue' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
        ]);


        $newsEvent->update($validated);

        return redirect()->route('admin.news-events.index')
            ->with('success', 'News/Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $newsEvent = NewsEvent::findOrFail($id);

        $newsEvent->delete();

        return redirect()->route('admin.news-events.index')
            ->with('success', 'News/Event deleted successfully.');
    }
}
