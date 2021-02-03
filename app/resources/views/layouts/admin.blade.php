<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <style>
        body {
            background-color: #26263c;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    管理者
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
                        @if (Auth::guest())
                        <li><a href="{{ route('admin.login') }}" class="nav-link">管理者ログイン</a></li>

                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }}様 <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>


                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>


                                <a class="dropdown-item" href="{{ route('main') }}">
                                    ユーザー画面
                                </a>

                                <a href="{{ route('admin.register') }}" class="dropdown-item">
                                    新規管理者登録
                                </a>

                                <a class="dropdown-item" href="{{ route('admin.add') }}">
                                    商品を追加する
                                </a>


                        </li>
                    </ul>
                    </li>
                    @endif
                    </ul>
                </div>
            </div>
        </nav>


        @if (session('flash_message'))
        <div class="alert alert-success flash_message" role="alert">
            {{ session('flash_message') }}
        </div>
        @endif



        <main class="py-4">
            @yield('content')
        </main>




        <footer class="footer_design">

            @guest
            <p class="nav-item" style="display:inline;">
                <a class="nav-link" href="{{ route('admin.login') }}" style="color:#fefefe; display:inline;">{{ __('ログイン') }}</a>

                @if (Route::has('register'))

                <a class="nav-link" href="{{ route('admin.register') }}" style="color:#fefefe; display:inline;">{{ __('会員登録') }}</a>
            </p>
            @endif

            @endguest
            <br>
            <div style="margin-top:24px;">
                なんでも売ります<br>
                <p style="font-size:2.4em">Larashop</p><br>
            </div>

            <p style="font-size:0.7em;">@copyright @mukae9</p>

        </footer>

    </div>
</body>

</html>