{{-- resources/views/users/manage/edit.blade.php --}}
@extends('layouts.videos-app')

@section('content')
    @can('manage-users')
        <h1>Edit User</h1>
        <form action="{{ route('users.manage.update', $user->id) }}" method="POST" data-qa="form-edit-user">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="{{ $user->password }}" required>
            <button type="submit">Update</button>
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
