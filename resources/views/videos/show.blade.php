<!-- resources/views/videos/show.blade.php -->
@extends('layouts.videos-app')

@section('content')
    <style>
        .video-details {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .video-details h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 10px;
        }
        .video-details p {
            font-size: 1.2em;
            color: #666;
            margin-bottom: 20px;
        }
        .video-details iframe {
            width: 100%;
            height: 450px;
            border: none;
            border-radius: 8px;
        }
        .video-details .published-date {
            font-size: 0.9em;
            color: #999;
        }
    </style>

    <div class="video-details">
        <h1>{{ $video->title }}</h1>
        <p>{{ $video->description }}</p>
        <iframe src="{{ $video->url }}" allowfullscreen></iframe>
        <p class="published-date">Published at: {{ $video->formatted_published_at }}</p>
    </div>
@endsection
