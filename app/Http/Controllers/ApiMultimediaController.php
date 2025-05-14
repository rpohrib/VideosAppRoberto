<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiMultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all multimedia records
        $multimedia = Multimedia::all();
        return response()->json($multimedia);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,mp4,mov|max:10240', // Max 10MB
            'type' => 'required|in:photo,video',
        ]);

        // Store the file
        $file = $request->file('file');
        $path = $file->store('multimedia', 'public');

        // Create a new multimedia record
        $multimedia = Multimedia::create([
            'type' => $request->input('type'),
            'path' => $path,
        ]);

        return response()->json($multimedia, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the multimedia record by ID
        $multimedia = Multimedia::findOrFail($id);
        return response()->json($multimedia);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'file' => 'nullable|file|mimes:jpeg,png,mp4,mov|max:10240', // Max 10MB
            'type' => 'nullable|in:photo,video',
        ]);

        // Find the multimedia record
        $multimedia = Multimedia::findOrFail($id);

        // Update the file if provided
        if ($request->hasFile('file')) {
            // Delete the old file
            Storage::disk('public')->delete($multimedia->path);

            // Store the new file
            $file = $request->file('file');
            $path = $file->store('multimedia', 'public');
            $multimedia->path = $path;
        }

        // Update the type if provided
        if ($request->has('type')) {
            $multimedia->type = $request->input('type');
        }

        $multimedia->save();

        return response()->json($multimedia);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the multimedia record
        $multimedia = Multimedia::findOrFail($id);

        // Delete the file from storage
        Storage::disk('public')->delete($multimedia->path);

        // Delete the record
        $multimedia->delete();

        return response()->json(['message' => 'Multimedia deleted successfully.']);
    }
}
