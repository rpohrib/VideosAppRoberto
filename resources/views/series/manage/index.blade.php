@extends('layouts.videos-app')

@section('content')
    @can('manage-videos')
        <h1>Manage Series</h1>
        <a href="{{ route('series.create') }}" class="btn btn-primary">Create New Series</a>
        <table class="table" data-qa="series-table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($series as $serie)
                <tr>
                    <td>{{ $serie->title }}</td>
                    <td>{{ $serie->description }}</td>
                    <td>
                        <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('series.destroy', $serie->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>You do not have permission to manage series.</p>
    @endcan
@endsection
