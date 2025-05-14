@extends('layouts.videos-app')

@section('content')
    <style>
        .user-profile-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .user-profile-container h1 {
            color: #1E3A8A;
            text-align: center;
            margin-bottom: 10px;
        }

        .user-profile-container p {
            color: #4B5563;
            text-align: center;
            margin-bottom: 20px;
        }

        .user-profile-container h2 {
            color: #1E3A8A;
            margin-bottom: 10px;
        }

        .user-profile-container ul {
            list-style: none;
            padding: 0;
        }

        .user-profile-container ul li {
            background-color: #F9FAFB;
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 1em;
            color: #1E3A8A;
        }

        .user-profile-container ul li:hover {
            background-color: #EFF6FF;
        }
    </style>

    <div class="user-profile-container">
        <h1>{{ $user->name }}</h1>
        <p>Email: {{ $user->email }}</p>
        <h2>Videos</h2>
        <ul>
            @foreach($user->videos as $video)
                <li>{{ $video->title }}</li>
            @endforeach
        </ul>
    </div>
@endsection
