<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quiz</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    @yield('head')
</head>
<body>
<header class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">Quiz</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/">Kezdőlap</a></li>
                <li><a href="/ranglista">Ranglista</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bejelentkezés <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/bejelentkezes">Bejelentkezés</a></li>
                            <li><a href="/regisztracio">Regisztráció</a></li>
                        </ul>
                    </li>
                @endguest
                @auth
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/kijelentkezes">Kijelentkezés</a></li>
                            </ul>
                        </li>
                @endauth
            </ul>
        </nav>
    </div>
</header>
<div class="container bs-docs-container master-container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @yield('content')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
@yield('footer')
</body>
</html>