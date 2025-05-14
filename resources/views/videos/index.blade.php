@extends('layouts.videos-app')

@section('content')
    <style>
        body {
            background-color: #F3F4F6;
        }

        h1 {
            color: #1E3A8A;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #2563EB;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }

        .btn-primary:hover {
            background-color: #1E40AF;
        }

        .alert-success {
            background-color: #D1FAE5;
            color: #065F46;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-info {
            background-color: #BFDBFE;
            color: #1E3A8A;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .video-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .video-card {
            width: 300px;
            background: linear-gradient(145deg, #ffffff, #d4d4d4);
            border-radius: 12px;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.1), -4px -4px 10px rgba(255, 255, 255, 0.7);
            overflow: hidden;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .video-card:hover {
            transform: translateY(-10px);
            box-shadow: 6px 6px 15px rgba(0, 0, 0, 0.15), -6px -6px 15px rgba(255, 255, 255, 0.8);
        }

        .video-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 2px solid #1E3A8A;
        }

        .video-card h3 {
            font-size: 1.3em;
            color: #1E3A8A;
            margin: 15px 0;
        }

        .video-card p {
            font-size: 0.95em;
            color: #4B5563;
            margin: 0 15px 15px;
        }

        .video-card p strong {
            color: #1E3A8A;
        }

        .video-card a {
            text-decoration: none;
        }
    </style>

    <h1>All Videos</h1>
    <a href="{{ route('videos.create') }}" class="btn btn-primary">Create Video</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($videos->isEmpty())
        <div class="alert alert-info">
            No videos available. Please create a new video.
        </div>
    @else
        <div class="video-grid">
            @foreach($videos as $video)
                <div class="video-card">
                    <a href="{{ route('videos.show', $video) }}">
                        <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/0.jpg" alt="{{ $video->title }}">
                        <h3>{{ $video->title }}</h3>
                    </a>
                    <p>{{ Str::limit($video->description, 100) }}</p>
                    <p><strong>Series:</strong> {{ $video->series->title ?? 'No Series' }}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection
