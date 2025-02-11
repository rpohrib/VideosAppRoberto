<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    /**
     * Display the specified video.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function testedBy($userId)
    {
        $videos = Video::where('tested_by', $userId)->get();
        return response()->json($videos);
    }

}
