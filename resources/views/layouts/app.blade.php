<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'My Laracast') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar  navbar-expand-lg navbar-dark bg-success">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'My Laracast') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                                {{-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> --}}
                                <a href="#" class="nav-link" data-toggle="modal"
                            data-target="#loginModal"><i class="fa fa-lock" aria-hidden="true"></i> {{__('login')}}</a>
                            <login-modal></login-modal>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    {{-- <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user" aria-hidden="true"></i> {{ __('Register') }}</a> --}}
                                    <a class="nav-link" href="#"  data-toggle="modal"
                                    data-target="#registrationFormModal"><i class="fa fa-user" aria-hidden="true"></i> {{ __('Register') }}</a>
                                    <registration-form></registration-form>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a href="{{route('view.profile')}}" class="dropdown-item"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                                  <logout></logout>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
