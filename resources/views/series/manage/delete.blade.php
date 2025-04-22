@extends('layouts.videos-app')

@section('content')
    @can('manage-videos')
        <h1>Delete Series</h1>
        <p>Are you sure you want to delete the series "{{ $serie->title }}"?</p>
        <p>This will also delete or unassign the associated videos.</p>
        <form action="{{ route('series.destroy', $serie->id) }}" method="POST" data-qa="delete-series-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" data-qa="confirm-delete-button">Delete</button>
            <a href="{{ route('series.index') }}" class="btn btn-secondary" data-qa="cancel-button">Cancel</a>
        </form>
    @else
        <p>You do not have permission to delete series.</p>
    @endcan
@endsection
