@extends('layouts.videos-app')

@section('content')
    <h1>All Series</h1>

    <!-- Search Form -->
    <form action="{{ route('series.index') }}" method="GET" data-qa="search-series-form">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Search series..." value="{{ request('search') }}" data-qa="search-input">
        </div>
        <button type="submit" class="btn btn-primary" data-qa="search-button">Search</button>
    </form>

    @auth
        <a href="{{ route('series.manage.create') }}" class="btn btn-success mb-3" data-qa="create-series-button">Create New Series</a>
    @endauth

    <!-- Series Table -->
    <table class="table" data-qa="series-table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Autor</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($series as $serie)
            <tr>
                <td>{{ $serie->title }}</td>
                <td>{{ $serie->description }}</td>
                <td>{{ $serie->user_name }}</td>
                <td>
                    <a href="{{ route('series.show', $serie->id) }}" class="btn btn-info" data-qa="view-series-button">View Videos</a>
                    <form action="{{ route('series.manage.delete', $serie->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" data-qa="delete-series-button">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $series->links() }}
@endsection
