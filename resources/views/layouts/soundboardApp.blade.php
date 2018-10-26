<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('favicon')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel') )</title>
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
            @auth
            <div id="cheapSidebar" style="position: sticky; top: 5px; float: left; margin-left: 1em;">
                <nav class="nav flex-column">
                    <a class="list-group-item list-group-item-primary">Super cheesy Navigation</a>
                    <a href="/home" class="list-group-item list-group-item-primary">Home</a>
                    <a href="#SampleSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-primary">Samples</a>
                    <div class="collapse list-unstyled @if(strpos(Route::current()->uri,'samples') !== false) show @endif" id="SampleSubmenu">
                        <a href="/samples/manage" class="list-group-item @if(strpos(Route::current()->uri,'samples/manage') !== false) list-group-item-success @else list-group-item-light @endif">Manage</a>
                        <a href="/samples/create" class="list-group-item @if(strpos(Route::current()->uri,'samples/create') !== false) list-group-item-success @else list-group-item-light @endif">Upload</a>
                    </div>
                    <a href="#MemesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-primary">Memes</a>
                    <div class="collapse list-unstyled @if(strpos(Route::current()->uri,'memes') !== false) show @endif" id="MemesSubmenu">
                        <a href="/memes/manage" class="list-group-item @if(strpos(Route::current()->uri,'memes/manage') !== false) list-group-item-success @else list-group-item-light @endif">Manage</a>
                        <a href="/memes/create" class="list-group-item @if(strpos(Route::current()->uri,'memes/create') !== false) list-group-item-success @else list-group-item-light @endif">Upload</a>
                    </div>
                    <a href="#GifsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-primary">Gifs</a>
                    <div class="collapse list-unstyled @if(strpos(Route::current()->uri,'gifs') !== false) show @endif" id="GifsSubmenu">
                        <a href="/gifs/manage" class="list-group-item @if(strpos(Route::current()->uri,'gifs/manage') !== false) list-group-item-success @else list-group-item-light @endif">Manage</a>
                        <a href="/gifs/create" class="list-group-item @if(strpos(Route::current()->uri,'gifs/create') !== false) list-group-item-success @else list-group-item-light @endif">Upload</a>
                    </div>
                    <a href="#BackgroundSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle list-group-item list-group-item-primary">Background</a>
                    <div class="collapse list-unstyled  @if(strpos(Route::current()->uri,'background') !== false) show @endif" id="BackgroundSubmenu">
                        <a href="/background/manage" class="list-group-item @if(strpos(Route::current()->uri,'background/manage') !== false) list-group-item-success @else list-group-item-light @endif">Manage</a>
                        <a href="/background/create" class="list-group-item @if(strpos(Route::current()->uri,'background/create') !== false) list-group-item-success @else list-group-item-light @endif">Upload</a>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="/">Soundboard</a>
                </nav>
            </div>
            @endauth
        @yield('content')
        </main>
    </div>
</body>
</html>
