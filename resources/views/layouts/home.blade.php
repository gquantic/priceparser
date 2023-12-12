<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0a007e12dc.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/sass/styles.scss'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ asset(route('home')) }}">
                    {{'Название сайта'}}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <div class="grouped-form mt-2">
                            <input type="text" name="title" class="form-control shadow hover:no-shadow" style="height: 100%; border-radius: 0" placeholder="Поиск по товарам">
                            <button type="submit" class="btn btn-primary shadow" style="border-radius: 0">Поиск</button>
                        </div>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item">
                                        Баланс
                                    </a>
                                    <a class="dropdown-item">
                                        Документация
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="left-menu">
            <ul class="menu-container">
                <li class="menu-category">
                    <a>
                        <i class="fas fa-list-ul"></i>  Панель
                    </a>
                </li>
                <li class="menu-category">
                    <a>
                        <i class="fas fa-download"></i> Выгрузка цен
                    </a>
                    <ul class="menu-subcontainer">
                        <li><a>API</a></li>
                        <li><a>Файлом</a></li>
                    </ul>
                </li>
                <li class="menu-category">
                    <a>
                        <i class="fas fa-search"></i> Парсер товаров каталога
                    </a>
                </li>
                <li class="menu-category">
                    <a>
                        <i class="fas fa-info-circle"></i> Мой тариф
                    </a>
                </li>
            </ul>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
