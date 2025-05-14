<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos App</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- MDB CSS -->
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />--}}
{{--    <!-- MDB icons -->--}}
{{--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Top navbar */
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: white;
            cursor: pointer;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            height: 100%;
            width: 250px;
            background-color: #222;
            padding-top: 60px;
            transition: left 0.3s ease;
            z-index: 1000;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            border-bottom: 1px solid #444;
        }

        .sidebar ul li a,
        .sidebar ul li form button {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            background: none;
            border: none;
            text-align: left;
            width: 100%;
            font-size: 16px;
        }

        .sidebar ul li a:hover,
        .sidebar ul li form button:hover {
            background-color: #444;
        }

        @media (min-width: 769px) {
            .sidebar {
                display: none;
            }

            .menu-toggle {
                display: none;
            }

            nav ul {
                display: flex;
                gap: 15px;
            }

            nav ul li {
                list-style: none;
            }

            nav ul li a {
                color: #fff;
                text-decoration: none;
                font-weight: bold;
            }

            nav ul li form button {
                color: #fff;
                background: none;
                border: none;
                cursor: pointer;
                font-weight: bold;
            }
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            nav ul {
                display: none;
            }
        }
    </style>
</head>
<body>

<!-- Navbar (top) -->
<header>
    <nav>
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
        <span>Videos App</span>
        <ul>
            <li><a href="{{ route('videos.index') }}">Home</a></li>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            @auth
                <li><a href="{{ route('manage.index') }}">Manage Videos</a></li>
                <li><a href="{{ route('videos.create') }}">Add Video</a></li>
                <li><a href="{{ route('series.index') }}">All Series</a></li>
                <li><a href="{{ route('series.manage.index') }}">Manage Series</a></li>
                <li><a href="{{ route('users.index') }}">Usuaris</a></li>
                <li><a href="{{ route('users.manage.index') }}">Manage Users</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
    </nav>
</header>

<!-- Sidebar per mòbil -->
<aside class="sidebar" id="sidebar">
    <ul>
        <li><a href="{{ route('videos.index') }}">Home</a></li>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        @auth
            <li><a href="{{ route('manage.index') }}">Manage Videos</a></li>
            <li><a href="{{ route('videos.create') }}">Add Video</a></li>
            <li><a href="{{ route('series.index') }}">All Series</a></li>
            <li><a href="{{ route('series.manage.index') }}">Manage Series</a></li>
            <li><a href="{{ route('users.index') }}">Users</a></li>
            <li><a href="{{ route('users.manage.index') }}">Manage Users</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @endauth
    </ul>
</aside>

<!-- Contingut principal -->
<main>
    @yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }} Videos App Roberto. All rights reserved.</p>
</footer>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

</body>
</html>
