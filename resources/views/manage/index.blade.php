@extends('layouts.videos-app')

@section('content')
    @can('manage-videos', App\Models\Video::class)
        <h1>Manage Videos</h1>
        <a href="{{ route('manage.create') }}">Create New Video</a>
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
                        <a href="{{ route('manage.edit', $video) }}">Edit</a>
                        <form action="{{ route('manage.destroy', $video) }}" method="POST" style="display:inline;">
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
