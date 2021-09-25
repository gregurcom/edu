<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="{{ asset('js/app.js') }}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Mentor</title>
</head>
<body class="h-100">
    <div class="d-flex w-100 h-100 flex-column">
        @section('header')
            <header class="mb-auto bg-dark">
                <nav class="navbar">
                    <div class="container">
                        <a href="{{ route('platform.home') }}" class="text-decoration-none text-light h5">Mentor</a>
                        <div class="d-inline-flex align-items-center">
                            <a href="{{ route('platform.course-list') }}" class="text-decoration-none text-light h5 px-3">Courses</a>
                            @auth
                                <a href="{{ route('platform.course-followed') }}" class="text-decoration-none text-light h5 px-3">Followed</a>
                                <div class="dropdown">
                                    <span class="dropdown-toggle nav-link text-white h5" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ auth()->user()->name }}
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                        <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Logout</a></li>
                                    </ul>
                                </div>
                            @else
                                <a href="{{ route('auth.login') }}" class="text-decoration-none text-light h5">Login</a>
                            @endauth
                        </div>
                    </div>
                </nav>
            </header>
        @show

        @yield('content')

        @section('footer')
            <footer class="footer mt-auto py-3 text-center bg-dark">
                <div class="container">
                    <span class="text-light">Copyright © {{ date("Y") }} Mentor</span>
                </div>
            </footer>
        @show
    </div>
</body>
</html>
