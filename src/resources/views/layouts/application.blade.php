<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

    <title>
        Leaderboards
        @if (isset($title) && is_array($title))
            - {{ implode(' - ', $title) }}
        @elseif (isset($title))
            - {{ $title }}
        @endif
    </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="/assets/js/require.min.js"></script>
    <script>
        requirejs.config({
            baseUrl: '/'
        });
    </script>
    <!-- Dashboard Core -->
    <link href="/assets/css/dashboard.css" rel="stylesheet" />
    <script src="/assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="/assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="/assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="/assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="/assets/plugins/input-mask/plugin.js"></script>
</head>
<body class="">
<div class="page">
    <div class="page-main">
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <a class="header-brand" href="./index.html">
                        Leaderboards
                    </a>
                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="dropdown">
                            @auth
                                <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                    <span class="avatar rounded" style="background-image: url('{{ Auth::user()->avatar }}');"></span>
                                    <span class="ml-2 d-none d-lg-block">
                                        <span class="text-default">{{ Auth::user()->nickname }}</span>
                                        @if (Auth::user()->admin)
                                            <small class="text-muted d-block mt-1">Administrator</small>
                                        @endif
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="dropdown-icon fe fe-log-out"></i> Logout
                                    </a>
                                </div>
                            @endauth
                            @guest
                                <div class="nav-item d-none d-md-flex">
                                    <a href="{{ route('login') }}"><img src="/assets/images/steam_login.png" alt="Login with Steam" /></a>
                                </div>
                            @endguest
                        </div>
                    </div>
                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        @if (Auth::user() && Auth::user()->admin)
            <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link"><i class="fe fe-home"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.competitions.index') }}" class="nav-link"><i class="fa fa-gamepad"></i> Competitions</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.players.index') }}" class="nav-link"><i class="fa fa-users"></i> Players</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.apikeys.index') }}" class="nav-link"><i class="fa fa-key"></i> API Keys</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="my-3 my-md-5">
            <div class="container">
                @if ($message = Session::get('successMessage'))
                    <div class="alert alert-success alert-block">
                       {{ $message }}
                    </div>

                @endif


                @if ($message = Session::get('errorMessage'))
                    <div class="alert alert-danger alert-block">
                       {{ $message }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <a href="https://github.com/mintopia/beatsaber-scoreboard" class="btn btn-outline-primary btn-sm">Source code</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright &copy; {{ date('Y') }} <a href="https://github.com/mintopia">Mintopia</a>.
                    All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
