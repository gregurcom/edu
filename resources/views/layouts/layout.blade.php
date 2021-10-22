<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:site_name" content="{{ config('app.name') }}" />
    <meta property="og:image" content="{{ asset('images/ogImage.png') }}" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:title" content="@yield('title', 'Mentor')" />
    @yield('meta')

    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @env('production')
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-NQBJ9919BD"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-NQBJ9919BD');
        </script>
    @endenv

    <title>@yield('title', 'Mentor')</title>
</head>
<body class="h-100">
    <div class="d-flex w-100 h-100 flex-column">
        @section('header')
            <header class="mb-auto bg-dark">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="align-content-center">
                            <a href="{{ route('home') }}" class="text-decoration-none text-light h5 px-3">Mentor</a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-list"></i>
                        </button>
                        <div class="collapse navbar-collapse align-content-center bg-dark" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="{{ route('platform.categories.list') }}" class="text-decoration-none text-light h5 px-3">{{ __('app.title.courses') }}</a>
                                </li>
                                @auth
                                    <li class="nav-item">
                                        <a href="{{ route('platform.subscriptions.index') }}" class="text-decoration-none text-light h5 px-3">{{ __('app.title.subscriptions') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="dropdown">
                                            <span class="dropdown-toggle text-white h5 px-3" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ auth()->user()->name }}
                                            </span>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li class="nav-item"><a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('app.title.dashboard') }}</a></li>
                                                <li class="nav-item"><a class="dropdown-item" href="{{ route('auth.logout') }}">{{ __('app.button.logout') }}</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('auth.login') }}" class="text-decoration-none text-light h5 px-3">{{ __('auth.login') }}</a>
                                    </li>
                                @endauth
                                <li class="nav-item">
                                    <form action="{{ route('language.switch') }}" method="GET" class="px-3">
                                        <select name="locale" class="bg-dark text-white border border-dark" onchange='this.form.submit()'>
                                            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>En</option>
                                            <option value="ru" {{ app()->getLocale() == 'ru' ? 'selected' : '' }}>Ru</option>
                                        </select>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        @show

        @yield('content')

        @section('footer')
            <footer class="footer mt-auto py-3 text-center bg-dark">
                <div class="container">
                    <span class="text-light">{{ __('app.title.copyright') }} © {{ date("Y") }} Mentor</span>
                </div>
            </footer>
        @show
    </div>
</body>
</html>
