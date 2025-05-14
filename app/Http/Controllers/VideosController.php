<?php

namespace App\Http\Controllers;

use App\Events\VideoCreated;
use App\Models\Video;
use App\Notifications\VideoCreatedNotification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class VideosController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('videos.index', compact('videos'));
    }

    /**
     * Display the specified video.
     *
     * @param int $id
     * @return Factory|View|Application
     */
    public function show($id)
    {
        $video = Video::findOrFail($id);
        //return response()->json($video);
        return view('videos.show', compact('video'));
    }

    public function create()
    {
        $series = \App\Models\Series::all(); // Obté totes les sèries
        return view('videos.create', compact('series'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'required|string|url',
            'series_id' => 'required|exists:series,id', // Valida que la sèrie existeixi

        ]);

        $video = \App\Models\Video::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'url' => $request->input('url'),
            'series_id' => $request->input('series_id'), // Assigna la sèrie
            'user_id' => auth()->id(), // Assigna l'usuari autenticat

        ]);

        // Dispara l'event
        event(new VideoCreated($video));
//        // Envia la notificació
//        Notification::send($video->user, new VideoCreatedNotification($video));

        return redirect()->route('videos.index')->with('success', 'Video created successfully.');
    }

    public function edit(Video $video)
    {
        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $video->update($request->all());

        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
    }
}
