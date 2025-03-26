<?php

namespace App\Http\Controllers;

use App\Models\User;
use Couchbase\View;

class usersController extends Controller
{
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('videos')->findOrFail($id);
        return view('users.show', compact('user'));
    }

}
