@extends('layouts.videos-app')

@section('content')
    <style>
        .video-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .video-card {
            width: 300px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
        }
        .video-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .video-card h3 {
            font-size: 1.2em;
            color: #333;
            margin: 10px 0;
        }
        .video-card p {
            font-size: 0.9em;
            color: #666;
            margin: 0 10px 10px;
        }
    </style>

    <h1>All Videos</h1>
    <a href="{{ route('videos.create') }}" class="btn btn-primary mb-3">Create Video</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="video-grid">
        @foreach($videos as $video)
            <div class="video-card">
                <a href="{{ route('videos.show', $video) }}">
                    <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/0.jpg" alt="{{ $video->title }}">
                    <h3>{{ $video->title }}</h3>
                </a>
                <p>{{ Str::limit($video->description, 100) }}</p>
            </div>
        @endforeach
    </div>
@endsection
