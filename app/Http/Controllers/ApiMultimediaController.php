<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApiMultimediaController extends Controller
{
    public function getVideos()
    {
        $files = Storage::disk('public')->files('videos');
        $videos = array_map(function ($file) {
            return [
                'url' => '/storage/' .$file,
                'name' => basename($file)
            ];
        }, $files);

        return response()->json($videos);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function deleteVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|string',
        ]);

        $video = $request->video;
        Storage::disk('public')->delete('videos/' . $video);

        return response()->json(['message' => 'Video deleted successfully'], 200);
    }


    /**
     * Store a newly uploaded video.
     */
    public function storeVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,mov,avi,wmv|max:20480', // Max size 20MB
        ]);

        $path = $request->file('video')->store('videos', 'public');

        Multimedia::create([
            'type' => 'video',
            'path' => $path
        ]);

        return response()->json(['message' => 'Video uploaded successfully', 'path' => $path], 201);
    }

    /**
     * Store a newly uploaded photo.
     */
    public function storePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|file|mimes:jpeg,png,jpg,gif|max:5120', // Max size 5MB
        ]);

        $path = $request->file('photo')->store('photos', 'public');

        return response()->json(['message' => 'Photo uploaded successfully', 'path' => $path], 201);
    }
}
