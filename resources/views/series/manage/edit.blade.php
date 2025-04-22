@extends('layouts.videos-app')

@section('content')
    @can('manage-videos')
        <h1>Edit Series</h1>
        <form action="{{ route('series.update', $serie->id) }}" method="POST" data-qa="edit-series-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $serie->title }}" data-qa="input-title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" data-qa="input-description" required>{{ $serie->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-success" data-qa="submit-button">Update</button>
        </form>
        <h2>Series List</h2>
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
        <p>You do not have permission to edit series.</p>
    @endcan
@endsection
