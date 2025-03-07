<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideosManageController extends Controller
{
    public function index(): View
    {
        if (auth()->user()->can('manage-videos')) {
            $videos = Video::all();
            return view('manage.index', compact('videos'));
        } else {
            return abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('manage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
        ]);

        Video::create($validated);

        return redirect()->route('manage.index')->with('success', 'Video created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video): View
    {
        return view('manage.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video): View
    {

        return view('manage.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|url',
        ]);

        $video->update($validated);

        return redirect()->route('manage.index')->with('success', 'Video updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video): RedirectResponse
    {
        $video->delete();

        return redirect()->route('manage.index')->with('success', 'Video deleted successfully.');
    }

    /**
     * Get the videos tested by the user.
     */
    public function testedBy(User $user): View
    {
        $videos = $user->testedBy;
        return view('videos.testedby', compact('videos'));
    }
}
