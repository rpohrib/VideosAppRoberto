@extends('layouts.videos-app')

@section('content')
    <style>
        .users-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .users-container h1 {
            color: #1E3A8A;
            text-align: center;
            margin-bottom: 20px;
        }

        .users-container .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .users-container .card {
            background-color: #F9FAFB;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .users-container .card h2 {
            font-size: 1.2em;
            color: #1E3A8A;
            margin-bottom: 10px;
        }

        .users-container .card p {
            color: #4B5563;
            margin-bottom: 15px;
        }

        .users-container .card a {
            display: inline-block;
            padding: 10px 15px;
            background-color: #2563EB;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
        }

        .users-container .card a:hover {
            background-color: #1E40AF;
        }
    </style>

    <div class="users-container">
        <h1>All Users</h1>
        <form method="GET" action="{{ route('users.index') }}" data-qa="form-search-users">
            <input type="text" name="search" placeholder="Search users..." data-qa="input-search">
            <button type="submit" data-qa="button-search">Search</button>
        </form>
        <div class="cards">
            @foreach($users as $user)
                <div class="card">
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->email }}</p>
                    <a href="{{ route('users.show', $user->id) }}" data-qa="link-user-{{ $user->id }}">View Profile</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
