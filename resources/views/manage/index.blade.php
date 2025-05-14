@extends('layouts.videos-app')

@section('content')
    @can('manage-videos', App\Models\Video::class)
        <h1 style="color: #1E3A8A; text-align: center; margin-bottom: 20px;">Manage Videos</h1>
        <a href="{{ route('videos.create') }}" style="display: inline-block; margin-bottom: 20px; padding: 10px 20px; background-color: #2563EB; color: white; text-decoration: none; border-radius: 5px;">Create New Video</a>

        <!-- Table for larger screens -->
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
                    <td><a href="{{ $video->url }}" target="_blank" style="color: #2563EB;">View</a></td>
                    <td>
                        <a href="{{ route('manage.edit', $video) }}" style="color: #1E3A8A; text-decoration: none; margin-right: 10px;">Edit</a>
                        <form action="{{ route('manage.destroy', $video) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: white; background-color: #DC2626; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Responsive list for mobile -->
        <div class="responsive-list">
            @foreach($videos as $video)
                <div class="responsive-list-item">
                    <div><span>Title:</span> {{ $video->title }}</div>
                    <div><span>Description:</span> {{ $video->description }}</div>
                    <div><span>URL:</span> <a href="{{ $video->url }}" target="_blank" style="color: #2563EB;">View</a></div>
                    <div>
                        <a href="{{ route('manage.edit', $video) }}" class="btn btn-warning" style="color: white; background-color: #1E3A8A; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Edit</a>
                        <form action="{{ route('manage.destroy', $video) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="color: white; background-color: #DC2626; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer;">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p style="color: #DC2626; text-align: center;">You do not have permission to view this page.</p>
    @endcan
@endsection

<style>
    /* Default table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    table th {
        background-color: #1E3A8A;
        color: white;
    }

    table tr:nth-child(even) {
        background-color: #F1F5F9;
    }

    table tr:hover {
        background-color: #E0F2FE;
    }

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

        .responsive-list-item {
            border: 1px solid #ddd;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #EFF6FF;
            border-radius: 5px;
        }

        .responsive-list-item div {
            margin-bottom: 5px;
        }

        .responsive-list-item div span {
            font-weight: bold;
            color: #1E3A8A;
        }
    }
</style>
