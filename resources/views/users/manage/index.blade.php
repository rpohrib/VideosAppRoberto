@extends('layouts.videos-app')

@section('content')
    <style>
        .manage-users-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .manage-users-container h1 {
            color: #1E3A8A;
            text-align: center;
            margin-bottom: 20px;
        }

        .manage-users-container .create-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #2563EB;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .manage-users-container .create-button:hover {
            background-color: #1E40AF;
        }

        .manage-users-container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .manage-users-container table th,
        .manage-users-container table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .manage-users-container table th {
            background-color: #2563EB;
            color: white;
        }

        .manage-users-container table tr:nth-child(even) {
            background-color: #F9FAFB;
        }

        .manage-users-container table tr:hover {
            background-color: #EFF6FF;
        }

        .manage-users-container .list {
            display: none;
            list-style: none;
            padding: 0;
        }

        .manage-users-container .list li {
            background-color: #F9FAFB;
            margin: 10px 0;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .manage-users-container .list li a {
            text-decoration: none;
            color: #2563EB;
            font-weight: bold;
        }

        .manage-users-container .list li a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .manage-users-container table {
                display: none;
            }

            .manage-users-container .list {
                display: block;
            }
        }
    </style>

    <div class="manage-users-container">
        @can('manage-users')
            <h1>Manage Users</h1>
            <a href="{{ route('users.manage.create') }}" class="create-button">Create New User</a>
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('users.manage.edit', $user->id) }}">Edit</a> |
                            <a href="{{ route('users.manage.delete', $user->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <ul class="list">
                @foreach($users as $user)
                    <li>
                        <strong>{{ $user->name }}</strong> - {{ $user->email }}<br>
                        <a href="{{ route('users.manage.edit', $user->id) }}">Edit</a> |
                        <a href="{{ route('users.manage.delete', $user->id) }}">Delete</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>You do not have permission to view this page.</p>
        @endcan
    </div>
@endsection
