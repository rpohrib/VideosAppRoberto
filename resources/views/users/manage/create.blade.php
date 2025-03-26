{{-- resources/views/users/manage/create.blade.php --}}
@extends('layouts.videos-app')

@section('content')
    @can('manage-users')
        <h1>Create New User</h1>
        <form action="{{ route('users.manage.store') }}" method="POST" data-qa="form-create-user">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Create</button>
        </form>
    @else
        <p>You do not have permission to view this page.</p>
    @endcan
@endsection

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
