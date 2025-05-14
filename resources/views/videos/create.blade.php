@extends('layouts.videos-app')

@section('content')
    <style>
        body {
            background-color: #F3F4F6;
        }

        .container {
            max-width: 600px;
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

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #1E3A8A;
        }

        input[type="text"], input[type="url"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            background-color: #F9FAFB;
        }

        input[type="text"]:focus, input[type="url"]:focus, textarea:focus, select:focus {
            border-color: #2563EB;
            outline: none;
            background-color: #EFF6FF;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #2563EB;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1E40AF;
        }
    </style>

    <div class="container">
        <h1>Create Video</h1>
        <form action="{{ route('videos.store') }}" method="POST">
            @csrf
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>

            <label for="url">Video URL:</label>
            <input type="url" name="url" id="url" required>

            <label for="series_id">Series:</label>
            <select name="series_id" id="series_id" required>
                <option value="">-- Select a Series --</option>
                @foreach($series as $serie)
                    <option value="{{ $serie->id }}">{{ $serie->title }}</option>
                @endforeach
            </select>

            <button type="submit">Create Video</button>
        </form>
    </div>
@endsection
