<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usersManageController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.manage.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $team = Team::create([
            'name' => $request->name,
            'user_id' => $user->id,
            'personal_team' => true,
        ]);

        $user->current_team_id = $team->id;
        $user->save();

        return redirect()->route('users.manage.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.manage.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'password']));

        return redirect()->route('users.manage.index')->with('success', 'User updated successfully.');
    }

    public function create ()
    {
        return view('users.manage.create');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return view('users.manage.delete', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

       return redirect()->route('users.manage.index')->with('success', 'User deleted successfully.');
    }

    public function testedBy($userId)
    {
        $videos = Video::where('tested_by', $userId)->get();
        return response()->json($videos);
    }
}
