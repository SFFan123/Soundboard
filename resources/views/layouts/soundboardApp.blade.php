<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('favicon')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    @yield('customJS')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    @yield('customCSS')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                        Control Panel
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            {{--
                           <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li> --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <div id="cheapSidebar" style="position: relative;
    float: left; margin-left: 2em;">
                <nav class="nav flex-column">
                    <a class="nav-link active" href="/home">Home</a>
                    <a class="nav-link dropdown-toggle">Samples</a>
                    <div class="dropdown-item">
                        <a class="nav-link" href="/samples/manage">Manage</a>
                        <a class="nav-link" href="/samples/create">Upload</a>
                    </div>
                    <a class="nav-link dropdown-toggle">Memes</a>
                    <div class="dropdown-item">
                        <a class="nav-link" href="/memes/manage">Manage</a>
                        <a class="nav-link" href="/memes/create">Upload</a>
                    </div>
                    <a class="nav-link dropdown-toggle">Gifs</a>
                    <div class="dropdown-item">
                        <a class="nav-link" href="/gifs/manage">Manage</a>
                        <a class="nav-link" href="/gifs/create">Upload</a>
                    </div>
                    <a class="nav-link dropdown-toggle">Background</a>
                    <div class="dropdown-item">
                        <a class="nav-link" href="/background/manage">Manage</a>
                        <a class="nav-link" href="/background/create">Upload</a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="nav-link active" href="/">Soundboard</a>
                </nav>
            </div>
            @yield('content')
        </main>
    </div>
</body>
</html>
