<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class VideosManageController extends Controller
{
    public function index(): View
    {
        return view('videos.index');
    }
}
