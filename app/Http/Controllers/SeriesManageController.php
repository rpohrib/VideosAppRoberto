<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesManageController extends Controller
{
    /**
     * Display a listing of the series.
     */
    public function index(Request $request)
    {
        $query = Series::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $series = $query->paginate(10);

        return view('series.index', compact('series'));
    }

    public function create()
    {
        return view('series.manage.create');
    }

    /**
     * Display the specified series.
     */
    public function show($id)
    {
        $serie = Series::with('videos')->findOrFail($id);

        return view('series.show', compact('serie'));
    }

    /**
     * Store a newly created series in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'user_photo_url' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $validated['user_name'] = auth()->user()->name; // Assigna el nom de l'usuari autenticat

        Series::create($validated);

        return redirect()->route('series.manage.index')->with('success', 'Series created successfully.');
    }

    /**
     * Show the form for editing the specified series.
     */
    public function edit(Series $series)
    {
        return view('series.manage.edit', compact('series'));
    }

    /**
     * Update the specified series in storage.
     */
    public function update(Request $request, Series $series)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'user_name' => 'required|string',
            'user_photo_url' => 'nullable|string',
            'published_at' => 'nullable|date',
        ]);

        $series->update($validated);

        return redirect()->route('series.manage.index')->with('success', 'Series updated successfully.');
    }

    /**
     * Soft delete the specified series.
     */
    public function delete(Series $series)
    {
        $series->delete();

        return redirect()->route('series.manage.index')->with('success', 'Series deleted successfully.');
    }

    /**
     * Permanently delete the specified series.
     */
    public function destroy(Series $series)
    {
        $series->forceDelete();

        return redirect()->route('series.manage.index')->with('success', 'Series permanently deleted.');
    }

    /**
     * Retrieve the user who tested the series.
     */
    public function testedBy(Series $series)
    {
        $user = $series->testedBy;
        return response()->json($user);
    }
}
