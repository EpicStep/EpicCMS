
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | Панель администратора</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Styles -->
    <link href="{{ asset('css/admdashboard.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('welcome')}}">EpicCMS</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#logout" onclick="document.getElementById('logout-form').submit();"><i class="fas fa-door-open"></i> Выйти</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" id="home" href="{{ route('admin') }}">
                            <i class="fas fa-home"></i> Главная панель <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="news" href="{{ route('admin/news') }}">
                            <i class="fas fa-newspaper"></i> Новости
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="servers" href="{{ route('admin/servers') }}">
                            <i class="fas fa-server"></i> Сервера
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="donate" href="{{route('admin/donate')}}">
                            <i class="fas fa-donate"></i> Донат
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="shop" href="#">
                            <i class="fas fa-shopping-cart"></i> Магазин блоков
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pages" href="{{route('admin/page')}}">
                            <i class="fas fa-file"></i> Статистические страницы
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="mreq" href="#">
                            <i class="fas fa-user-tie"></i> Заявки на модератора
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="settings" href="{{ route('admin/settings') }}">
                            <i class="fas fa-cog"></i> Настройки
                        </a>
                    </li>
                    <br>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <p>Вы авторизованы как - {{ Auth::user()->name }}</p>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
            @yield('content')
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</body>
</html>
