<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index(): \Illuminate\View\View
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

    /**
     * Display a listing of videos tested by a specific user.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function testedBy($userId)
    {
        $videos = Video::where('tested_by', $userId)->get();
        return response()->json($videos);
    }

}
