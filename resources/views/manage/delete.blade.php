@extends('layouts.videos-app')

@section('content')
    @can('delete', $video)
        <h1>Delete Video</h1>
        <p>Are you sure you want to delete this video?</p>
        <form action="{{ route('videos.destroy', $video) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this video?');">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @else
        <p>You do not have permission to view this page.</p>
    @endcan
@endsection
