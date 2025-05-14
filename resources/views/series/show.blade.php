@extends('layouts.videos-app')

@section('content')
    <style>
        body {
            background-color: #F3F4F6;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #1E3A8A;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            color: #4B5563;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        .series-videos-list li {
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 1em;
            color: #1E3A8A;
        }

        .series-videos-list li:hover {
            background-color: #EFF6FF;
        }

        ul li:hover {
            background-color: #EFF6FF;
        }

        .btn-secondary {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 20px auto 0;
            padding: 10px;
            text-align: center;
            background-color: #6B7280;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #4B5563;
        }
    </style>

    <div class="container">
        <h1>Videos for Series: {{ $serie->title }}</h1>
        <p>{{ $serie->description }}</p>

        <ul class="series-videos-list">
            @foreach ($serie->videos as $video)
                <li>{{ $video->title }}</li>
            @endforeach
        </ul>

        <a href="{{ route('series.index') }}" class="btn btn-secondary">Back to Series</a>
    </div>
@endsection
