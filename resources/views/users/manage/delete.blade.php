{{-- resources/views/users/manage/delete.blade.php --}}
@extends('layouts.videos-app')

@section('content')
    @can('manage-users')
        <h1>Delete User</h1>
        <p>Are you sure you want to delete {{ $user->name }}?</p>
        <form action="{{ route('users.manage.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Yes, Delete</button>
        </form>
        <a href="{{ route('users.manage.index') }}">Cancel</a>
    @else
        <p>You do not have permission to view this page.</p>
    @endcan
@endsection
