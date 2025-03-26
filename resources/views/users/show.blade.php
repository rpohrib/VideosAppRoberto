{{-- resources/views/users/show.blade.php --}}
@extends('layouts.videos-app')

@section('content')
    <h1>{{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
    <h2>Videos</h2>
    <ul>
        @foreach($user->videos as $video)
            <li>{{ $video->title }}</li>
        @endforeach
    </ul>
@endsection
