@extends('layouts.videos-app')

@section('content')
    @can('manage-videos')
        <h1>Create New Series</h1>
        <form action="{{ route('series.manage.store') }}" method="POST" data-qa="create-series-form">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" data-qa="input-title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" data-qa="input-description" required></textarea>
            </div>
            <button type="submit" class="btn btn-success" data-qa="submit-button">Create</button>
        </form>
    @else
        <p>You do not have permission to create series.</p>
    @endcan
@endsection
