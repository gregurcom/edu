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
                        <a href="{{ route('home') }}" class="text-decoration-none text-light h5">Mentor</a>
                        @auth
                            <a href="{{ route('auth.logout') }}" class="text-decoration-none text-light h5">Logout</a>
                        @else
                            <a href="{{ route('auth.login') }}" class="text-decoration-none text-light h5">Login</a>
                        @endauth
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
