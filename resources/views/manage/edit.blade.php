@extends('layouts.videos-app')

@section('content')
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
                        <a href="{{ route('videos.edit', $video) }}">Edit</a>
                        <form action="{{ route('videos.destroy', $video) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>You do not have permission to view this page.</p>
    @endcan
@endsection
