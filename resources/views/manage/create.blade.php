@extends('layouts.videos-app')

@section('content')
    @can('create videos', App\Models\Video::class)
        <h1>Create Video</h1>
        <form action="{{ route('manage.store') }}" method="POST" data-qa="form-create-video">
            @csrf
            <div>
                <label for="title" data-qa="label-title">Title:</label>
                <input type="text" id="title" name="title" required data-qa="input-title">
            </div>
            <div>
                <label for="description" data-qa="label-description">Description:</label>
                <textarea id="description" name="description" required data-qa="textarea-description"></textarea>
            </div>
            <div>
                <label for="url" data-qa="label-url">URL:</label>
                <input type="url" id="url" name="url" required data-qa="input-url">
            </div>
            <button type="submit" data-qa="button-submit">Create</button>
        </form>
    @else
        <p>You do not have permission to view this page.</p>
    @endcan
@endsection
