<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{-- {{ config('app.name', 'Laravel') }} --}}
        KBmedia
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="position: fixed; top: 0; left: 0; width: 100vw; z-index: 1;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'KBmedia') }} --}}
                    KB<i>media</i>
                    {{-- <img src="{{ asset('storage/uploads/KBmedia-logo.png') }}" alt="" style="height: 40px;"> --}}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse position-relative" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-outline-primary me-3" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                            </li>
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-primary me-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="btn btn-light d-flex align-items-center" style="border: 2px solid #91cd39; {{-- pointer-events: none; --}}" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <div>
                                        <img src="{{ asset('storage/' . Auth::user()->logo) }}" alt="profile_img" class="rounded-circle" style="width: 30px; height: 30px;">
                                    </div>
                                    <div class="ms-2">{{ Auth::user()->name }}</div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('channel') }}">
                                        {{ __('Il tuo canale') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('edit-profile', ['user' => Auth::user()]) }}">
                                        {{ __('Modifica Profilo') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Esci') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                    <div class="position-absolute top-0 start-50 translate-middle-x">
                        <form action="{{ route('searching-page') }}" method="GET" enctype="multipart/form" novalidate>
                            <div class="d-flex">
                                <input type="text" class="form-control @error('query') is-invalid @enderror" id="query" name="query" value="{{ old('query') }}" style="width: 30vw;">
                                <div class="invalid-feedback">
                                    @error('query')
                                        <ul>
                                            @foreach ($errors->get('query') as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @enderror
                                </div>
                                <button class="btn btn-light border border-dark ms-1"><i class="fas fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <main class="bg-white">
            @yield('content')
        </main>
    </div>
</body>
</html>
