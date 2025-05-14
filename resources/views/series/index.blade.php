@extends('layouts.videos-app')

@section('content')
    <h1 style="color: #1E3A8A; text-align: center; margin-bottom: 20px;">All Series</h1>

    <!-- Search Form -->
    <form action="{{ route('series.index') }}" method="GET" data-qa="search-series-form" style="margin-bottom: 20px;">
        <div class="form-group" style="margin-bottom: 10px;">
            <input type="text" name="search" class="form-control" placeholder="Search series..." value="{{ request('search') }}" data-qa="search-input" style="padding: 10px; border: 1px solid #1E3A8A; border-radius: 5px;">
        </div>
        <button type="submit" class="btn btn-primary" data-qa="search-button" style="background-color: #2563EB; border: none; padding: 10px 20px; border-radius: 5px;">Search</button>
    </form>

    @auth
        <a href="{{ route('series.manage.create') }}" class="btn btn-success mb-3" data-qa="create-series-button" style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #2563EB; color: white; text-decoration: none; border-radius: 5px;">Create New Series</a>
    @endauth

    <!-- Series Table -->
    <table class="table" data-qa="series-table" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <thead>
        <tr>
            <th style="background-color: #1E3A8A; color: white; padding: 10px; text-align: left;">Title</th>
            <th style="background-color: #1E3A8A; color: white; padding: 10px; text-align: left;">Description</th>
            <th style="background-color: #1E3A8A; color: white; padding: 10px; text-align: left;">Autor</th>
            <th style="background-color: #1E3A8A; color: white; padding: 10px; text-align: left;">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($series as $serie)
            <tr style="border: 1px solid #ddd;">
                <td style="padding: 10px;">{{ $serie->title }}</td>
                <td style="padding: 10px;">{{ $serie->description }}</td>
                <td style="padding: 10px;">{{ $serie->user_name }}</td>
                <td style="padding: 10px;">
                    <a href="{{ route('series.show', $serie->id) }}" class="btn btn-info" data-qa="view-series-button" style="color: white; background-color: #1E3A8A; padding: 5px 10px; border-radius: 5px; text-decoration: none;">View Videos</a>
                    <form action="{{ route('series.manage.delete', $serie->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" data-qa="delete-series-button" style="color: white; background-color: #DC2626; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Responsive List for Mobile -->
    <div class="responsive-list">
        @foreach ($series as $serie)
            <div class="responsive-list-item" style="border: 1px solid #ddd; margin-bottom: 10px; padding: 10px; background-color: #EFF6FF; border-radius: 5px;">
                <div style="margin-bottom: 5px;"><span style="font-weight: bold; color: #1E3A8A;">Title:</span> {{ $serie->title }}</div>
                <div style="margin-bottom: 5px;"><span style="font-weight: bold; color: #1E3A8A;">Description:</span> {{ $serie->description }}</div>
                <div style="margin-bottom: 5px;"><span style="font-weight: bold; color: #1E3A8A;">Autor:</span> {{ $serie->user_name }}</div>
                <div>
                    <a href="{{ route('series.show', $serie->id) }}" class="btn btn-info" data-qa="view-series-button" style="color: white; background-color: #1E3A8A; padding: 5px 10px; border-radius: 5px; text-decoration: none;">View Videos</a>
                    <form action="{{ route('series.manage.delete', $serie->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" data-qa="delete-series-button" style="color: white; background-color: #DC2626; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div style="margin-top: 20px;">
        {{ $series->links() }}
    </div>
@endsection

<style>
    /* Default styles: Hide the responsive list */
    .responsive-list {
        display: none;
    }

    /* Responsive styles for mobile */
    @media (max-width: 768px) {
        table {
            display: none;
        }

        .responsive-list {
            display: block;
        }
    }
</style>
