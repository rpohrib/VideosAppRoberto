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

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            background-color: #F9FAFB;
        }

        input[type="text"]:focus, textarea:focus {
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

        p {
            text-align: center;
            font-weight: bold;
        }
    </style>

    <div class="container">
        @auth
            <h1>Create New Series</h1>
            <form action="{{ route('series.manage.store') }}" method="POST" data-qa="create-series-form">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" data-qa="input-title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" data-qa="input-description" required></textarea>
                </div>
                <button type="submit" class="btn btn-success" data-qa="submit-button">Create</button>
            </form>
        @else
            <p>You do not have permission to create series.</p>
        @endauth
    </div>
@endsection
