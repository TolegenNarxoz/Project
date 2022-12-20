<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light text-bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    Men's bow shop
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('messages.register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown text-white">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('messages.logout') }}
                                    </a>
                                    @auth()
                                    <a class="dropdown-item" href="{{route('index.cart')}}">
                                        {{ __('messages.cart') }}
                                    </a>
                                @can('create', App\Models\Product::class)
                                        <a class="dropdown-item" href="{{route('adm.users.index')}}">
                                            {{ __('messages.admin_panel') }}
                                        </a>

                                @endcan
                                    @endauth
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest


                        <li class="nav-item dropdown text-white">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ config('app.languages')[app()->getLocale()] }}
                            </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @foreach(config('app.languages') as $ln => $lang)
                                        <a class="dropdown-item" href="{{route('switch.lang', $ln)}}">
                                            {{$lang}}
                                        </a>
                                    @endforeach
                                </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @if(session('destroy'))
            <div class="alert alert-success" role="alert">
                {{__('messages.category_delete')}}
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-success" role="alert">
                {{__('messages.product_add')}}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
