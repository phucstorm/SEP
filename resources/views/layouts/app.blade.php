<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VLAsk</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/event.js') }}" defer></script>
    <script src="{{ asset('js/layout.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">

</head>

<body>
    <div class="opacity_menu"></div>
    <nav class="sidebar-navigation">
        <div class='host-info'>
            <div><i class="fa fa-user"></i>
                {{Auth::user()->email}}</div>
            <div>Host</div>
        </div>
        <ul class="sidebar-nav">
            <li class="nav-item edit_user_info-btn" data-name="{{Auth::user()->name}}" data-email="{{Auth::user()->email}}"
        data-id="{{Auth::user()->id}}" data-toggle="modal" data-target="#editInfo">
                <span><a class="nav-link" class="nav-item-link" href="#" style="color: white;"><i
                            class="fa fa-edit"></i> Edit</a></span>
            </li>
            <li class="nav-item">
                <a class="nav-link" class="nav-item-link" href="{{ route('logout') }}" style="color: white;"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> {{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

    <header>
        @auth
        <div class='navbar_info'>
            <div class="sidebar-toggle">
                <i class="fa fa-bars"></i>
            </div>
            <div class="vlask-logo">
                <img src="{{ asset('img/VLask-logo.png')}}" alt="">
                <h1>VLask</h1>
            </div>
            <div class="container">
                <div class="row justify-content-between">
                    <div class="user_info_container">
                        <div class=user_header_info>
                            <div class="user_info">
                                <i class="fa fa-user"></i>
                                {{Auth::user()->email}} <i class="fa fa-cog"></i>
                            </div>
                            <div class="user_role">
                                Host
                            </div>
                        </div>
                        <div class="user_setting">      
                            <ul class="user-setting-menu">
                                <li class="dropdown-item edit_user_info-btn" data-name="{{Auth::user()->name}}" data-email="{{Auth::user()->email}}"
                                data-id="{{Auth::user()->id}}" data-toggle="modal" data-target="#editInfo"><a class="dropdown-item"><i class="fa fa-edit"></i>Edit</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>{{ __('Logout') }}
                                </a></li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                            </form>
                        </div>
                    </div>
                    <div class="search_event_form search-desktop">
                        <form action="/admin/event" method="get">
                            <div>
                                <i class="fa fa-search"></i>
                                <input type="text" name="search" placeholder="Search event...">
                            </div>

                        </form>
                    </div>
                    <div class="search_event_form search-mobile">
                        <form action="/admin/event" method="get">
                            <div>
                            <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                <i class="fa fa-search"></i>
                                <input type="text" name="search" placeholder="Search event...">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar_select">
            <div class="container">
                <button class="is-active"><a href="/admin/event">Event</a></button>
                <button>Analytics</button>
            </div>
        </div>
        @else
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @endauth
    </header>
        <!-- Modal Edit User Information -->
        <div class="modal fade" id="editInfo" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Edit User Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="post">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="un" name="un"required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="em" name="em" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="edit_info">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    @yield('content')

    <footer>
        <div class="top-footer">
            <div class="wrapper-title">VLask | Designed by 5Bs</div>
        </div>
    </footer>
</body>

</html>