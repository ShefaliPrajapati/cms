<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script
        src="{{ asset('/js/jquery-3.4.1.min.js') }}"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .registered-user.jumbotron {
            padding: 1rem 1rem;
            background: #e3e3e3;
        }
        .dropdown-menu.notify-drop.show {
            width: 300px;
            margin-left: -85px;
        }
        .drop-content li {
            border-bottom: 1px solid #cecaca;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">{{ __('Users') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('friends') }}">{{ __('Friends') }} <span class="badge-success badge">{{ Auth::user()->getFriendsCount() }}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('request_user') }}">{{ __('Requests') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('pending_user') }}">{{ __('Pending') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('blocked_user') }}">{{ __('Blocked') }}</a>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">History (<b>2</b>)</a>
                                <ul class="dropdown-menu notify-drop">
                                
                                    @if(isset($notification_users))
                                    <div class="drop-content">
                                        @foreach($notification_users as $user)
                                            @if(Auth::user()->hasFriendRequestFrom($user))
                                                <li>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 pd-5">
                                                       {{ $user->name }} Has requested you to become friend.
                                                    </div>
                                                </li>
                                            @elseif(Auth::user()->hasSentFriendRequestTo($user))
                                                <li>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 pd-5">
                                                        You sent friend request to {{ $user->name }}.
                                                    </div>
                                                </li>
                                            @elseif(Auth::user()->hasBlocked($user))
                                                <li>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 pd-5">
                                                        You have blocked to {{ $user->name }}.
                                                    </div>
                                                </li>
                                            @elseif(Auth::user()->isFriendWith($user))
                                                <li>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 pd-5">
                                                        You are now friend with {{ $user->name }}.
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </div>
                                    @endif
                                </ul>
                            </li>
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
            @if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>

            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
