<style>
    /* Default table styles */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
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
            background-color: #f9f9f9;
        }

        .responsive-list-item div {
            margin-bottom: 5px;
        }

        .responsive-list-item div span {
            font-weight: bold;
        }
    }
</style>

<!-- Table for larger screens -->
<table>
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

<!-- Responsive list for mobile -->
<div class="responsive-list">
    @foreach ($series as $serie)
        <div class="responsive-list-item">
            <div><span>Title:</span> {{ $serie->title }}</div>
            <div><span>Description:</span> {{ $serie->description }}</div>
            <div>
                <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('series.destroy', $serie->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
