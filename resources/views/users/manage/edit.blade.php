@extends('layouts.videos-app')

@section('content')
    <style>
        .edit-user-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .edit-user-container h1 {
            color: #1E3A8A;
            text-align: center;
            margin-bottom: 20px;
        }

        .edit-user-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .edit-user-container label {
            font-weight: bold;
            color: #4B5563;
        }

        .edit-user-container input[type="text"],
        .edit-user-container input[type="email"],
        .edit-user-container input[type="password"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            background-color: #F9FAFB;
        }

        .edit-user-container input:focus {
            border-color: #2563EB;
            outline: none;
            background-color: #EFF6FF;
        }

        .edit-user-container button {
            padding: 10px 20px;
            background-color: #2563EB;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-user-container button:hover {
            background-color: #1E40AF;
        }

        .alert.alert-danger {
            background-color: #FEE2E2;
            color: #B91C1C;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert.alert-danger ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .alert.alert-danger li {
            margin: 5px 0;
        }
    </style>

    <div class="edit-user-container">
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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
