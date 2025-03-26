{{-- resources/views/users/manage/index.blade.php --}}
@extends('layouts.videos-app')

@section('content')
    @can('manage-users')
        <h1>Manage Users</h1>
        <a href="{{ route('users.manage.create') }}">Create New User</a>
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }} - {{ $user->email }}
                    <a href="{{ route('users.manage.edit', $user->id) }}">Edit</a>
                    <a href="{{ route('users.manage.delete', $user->id) }}">Delete</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>You do not have permission to view this page.</p>
    @endcan
@endsection
