<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Event Planner')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('events.index') }}">EventPlanner</a>

        <ul class="navbar-nav ms-auto">
            @auth
                <li class="nav-item"><a class="nav-link" href="{{ route('events.create') }}">Create Event</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('favorites.index') }}">Favorites</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="padding-top: 8px; margin: 0; border: none; background: none; color: white; text-decoration: none;">
                            Logout
                        </button>
                    </form>
                </li>
            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
    </div>
</nav>

<div class="container">
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
