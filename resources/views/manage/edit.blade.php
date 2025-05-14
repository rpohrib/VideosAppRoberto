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

        h1, h2 {
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

        input[type="text"], input[type="url"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            background-color: #F9FAFB;
        }

        input[type="text"]:focus, input[type="url"]:focus, textarea:focus {
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #1E3A8A;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #F9FAFB;
        }

        table a {
            color: #2563EB;
            text-decoration: none;
        }

        table a:hover {
            text-decoration: underline;
        }

        .btn-danger {
            background-color: #DC2626;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #B91C1C;
        }

        .btn-warning {
            background-color: #F59E0B;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-warning:hover {
            background-color: #D97706;
        }
    </style>

    <div class="container">
        @can('edit videos', $video)
            <h1>Edit Video</h1>
            <form action="{{ route('manage.update', $video) }}" method="POST" data-qa="form-edit-video">
                @csrf
                @method('PUT')
                <div>
                    <label for="title" data-qa="label-title">Title:</label>
                    <input type="text" id="title" name="title" value="{{ $video->title }}" required data-qa="input-title">
                </div>
                <div>
                    <label for="description" data-qa="label-description">Description:</label>
                    <textarea id="description" name="description" required data-qa="textarea-description">{{ $video->description }}</textarea>
                </div>
                <div>
                    <label for="url" data-qa="label-url">URL:</label>
                    <input type="url" id="url" name="url" value="{{ $video->url }}" required data-qa="input-url">
                </div>
                <button type="submit" data-qa="button-submit">Update</button>
            </form>

            <h2>Manage Videos</h2>
            <table>
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($videos as $video)
                    <tr>
                        <td>{{ $video->title }}</td>
                        <td>{{ $video->description }}</td>
                        <td><a href="{{ $video->url }}" target="_blank">View</a></td>
                        <td>
                            <a href="{{ route('manage.edit', $video) }}" class="btn-warning">Edit</a>
                            <form action="{{ route('manage.destroy', $video) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>You do not have permission to view this page.</p>
        @endcan
    </div>
@endsection
