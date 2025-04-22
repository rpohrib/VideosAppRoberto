@extends('layouts.videos-app')

@section('content')
    <h1>Videos for Series: {{ $serie->title }}</h1>
    <p>{{ $serie->description }}</p>

    <ul>
        @foreach ($serie->videos as $video)
            <li>{{ $video->title }}</li>
        @endforeach
    </ul>

    <a href="{{ route('series.index') }}" class="btn btn-secondary">Back to Series</a>
@endsection
