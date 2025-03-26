{{-- resources/views/users/index.blade.php --}}
@extends('layouts.videos-app')

@section('content')
    <h1>All Users</h1>
    <form method="GET" action="{{ route('users.index') }}" data-qa="form-search-users">
        <input type="text" name="search" placeholder="Search users..." data-qa="input-search">
        <button type="submit" data-qa="button-search">Search</button>
    </form>
    <ul>
        @foreach($users as $user)
            <li>
                <a href="{{ route('users.show', $user->id) }}" data-qa="link-user-{{ $user->id }}">
                    {{ $user->name }} - {{ $user->email }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
