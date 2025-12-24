<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notice;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'Notice List';
        $notices = Notice::orderBy('date', 'desc')->get();

        return view('admin.notice.index', compact('pageTitle', 'notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Notice';
        return view('admin.notice.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'date'        => 'required|date',
            'file_url'    => 'nullable|file|mimes:pdf|max:2048', // ✅ File upload
            'description' => 'nullable|string',
            'status'      => 'required|in:0,1',
        ]);

        $slug = Str::slug($request->title);

        // Ensure unique slug
        $originalSlug = $slug;
        $count = 1;
        while (Notice::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // ✅ Handle file upload
        $filePath = null;
        if ($request->hasFile('file_url')) {
            $filePath = $request->file('file_url')->store('notices', 'public');
        }

        Notice::create([
            'title'       => $request->title,
            'slug'        => $slug,
            'date'        => $request->date,
            'file_url'    => $filePath,
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.notice.index')
            ->with('success', 'Notice created successfully.');
    }


    public function show($id)
    {
        $pageTitle = 'Notice Details';
        $notice = Notice::findOrFail($id);
        return view('admin.notice.show', compact('pageTitle', 'notice'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pageTitle = 'Edit Notice';
        $notice = Notice::findOrFail($id);

        return view('admin.notice.edit', compact('pageTitle', 'notice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'date'        => 'required|date',
            'file_url'    => 'nullable|file|mimes:pdf|max:2048', // ✅ File validation
            'description' => 'nullable|string',
            'status'      => 'required|in:0,1',
        ]);

        $notice = Notice::findOrFail($id);

        // Only regenerate slug if title changed
        if ($notice->title !== $request->title) {
            $slug = Str::slug($request->title);

            $originalSlug = $slug;
            $count = 1;
            while (Notice::where('slug', $slug)->where('id', '!=', $notice->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $notice->slug = $slug;
        }

        // ✅ Handle file upload
        if ($request->hasFile('file_url')) {
            // Delete old file if exists
            if ($notice->file_url && Storage::disk('public')->exists($notice->file_url)) {
                Storage::disk('public')->delete($notice->file_url);
            }

            // Store new file
            $filePath = $request->file('file_url')->store('notices', 'public');
            $notice->file_url = $filePath;
        }

        $notice->update([
            'title'       => $request->title,
            'date'        => $request->date,
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        $notice->save();

        return redirect()->route('admin.notice.index')
            ->with('success', 'Notice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);

        // ✅ Delete associated PDF
        if ($notice->file_url && Storage::disk('public')->exists($notice->file_url)) {
            Storage::disk('public')->delete($notice->file_url);
        }

        $notice->delete();

        return redirect()->route('admin.notice.index')
            ->with('success', 'Notice deleted successfully.');
    }

    /**
     * Optional: Toggle active/inactive status (AJAX or button)
     */
    public function toggleStatus($id)
    {
        $notice = Notice::findOrFail($id);
        $notice->status = !$notice->status;
        $notice->save();

        return back()->with('success', 'Notice status updated.');
    }
}
