<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/atom-one-dark.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
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
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
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
            <div class="container text-danger">
                @if($errors->count() > 0)
                    <ul class="list-group-item">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                <br>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <a href="{{ route('discussions.create') }}" class="form-control btn btn-primary">Create a new discussion</a>
                        </br>
                        </br>
                        <div class="card" style="margin-bottom: 30px;">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <a href="/forum" style="text-decoration: none;">Home</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="/forum?filter=me" style="text-decoration: none;">My discussions</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="/forum?filter=solved" style="text-decoration: none;">Answered discussions</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="/forum?filter=unsolved" style="text-decoration: none;">Unanswered discussions</a>
                                    </li>
                                </ul>
                            </div>
                            @if(Auth::check() && Auth::user()->admin)
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <a href="/channels" style="text-decoration: none;">All channels</a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="card">
                            <div class="card-header">Channels</div>

                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach($channels as $channel)
                                        <li class="list-group-item">
                                            <a href="{{ route('channel', [ 'slug' => $channel->slug ]) }}" style="text-decoration: none">{{ $channel->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        @yield('content')
                    </div>

                </div>
            </div>
        </main>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script>
        @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
        @endif

        @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}")
        @endif
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    {{--
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    --}}
</body>
</html>
