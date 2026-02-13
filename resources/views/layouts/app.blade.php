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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<style>
    .pagination .page-link {
        padding: 4px 8px;
        font-size: 14px;
    }

    /* ===== Tema Biru Muda Lembut ===== */
    body {
        background-color: #e3f2fd; /* ubah dari #f4f8ff ke biru muda */
    }

    .navbar {
        background: linear-gradient(90deg, #0d6efd, #3b82f6) !important;
    }

    .navbar .nav-link,
    .navbar .navbar-brand {
        color: white !important;
        font-weight: 500;
    }

    .navbar .nav-link:hover {
        opacity: 0.8;
    }

    .card {
        border: none;
        border-radius: 12px;
    }

    .card-stat {
        background: white;
        border-left: 5px solid #0d6efd;
    }

    .list-group-item {
        border: none;
        border-radius: 10px !important;
        margin-bottom: 8px;
        background-color: white;
        transition: 0.2s;
    }

    .list-group-item:hover {
        background-color: #e7f0ff;
        transform: translateX(4px);
    }
</style>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Kosongkan kiri -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Semua menu di kanan -->
                    <ul class="navbar-nav ms-auto">

                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/buku">Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/peminjaman">Peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/siswa">Siswa</a>
                        </li>
                        @endauth

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                   data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}"
                                          method="POST" class="d-none">
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
            @yield('content')
        </main>
    </div>
</body>
</html>
