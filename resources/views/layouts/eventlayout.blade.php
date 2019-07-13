<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/layout.js') }}" defer></script>
    <script src="{{ asset('js/event.js') }}" defer></script>
    @stack('head')
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('8e870dcd45ee9590faac', {
            cluster: 'ap1',
            forceTLS: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('form-submitted', function (data) {
            $('.content').append(
                "<div>Question: " + data.question + " by " + data.user_name + "</div>" +
                "<div>ID: " + data.id + " by " + data.user_name + "</div>" +
                "<div>" +
                "<button><a href='/room/question/accept/" + data.id + "'>Yes</a></button>" +
                "<button><a href='/room/question/denied/" + data.id + "'>No</a></button>" +
                "</div>"
            );
        });

    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/event_detail.css') }}" rel="stylesheet">
</head>

<body>
    <div class="opacity_menu"></div>
    <nav class="sidebar-navigation">
        <div class="event-sidebar-info">
        <div><i class="fa fa-user"></i>
                {{Auth::user()->email}}</div>
            <div class="event-name">{{$event->event_name}}</div>
            <div class="event-code">#{{$event->event_code}}</div>
            <div class="event-code">{{$event->start_date}}</div>
        </div>
        <ul class="sidebar-nav">
            <li class="nav-item">
                <span><a class="nav-link" class="nav-item-link" href="/user" style="color: white;"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i>
                 Back to event list</a></span>
            </li>
            <li class="nav-item">
                <span><a class="nav-link" class="nav-item-link" href="/user" style="color: white;"><i
                            class="fa fa-edit"></i> Edit account</a></span>
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
        <div class="wrapper-flex">
            <div class="mobile-flex">
                <div class="sidebar-toggle">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="fixed_row">
                    <div class="container event_container">
                        <div class="row">
                            <div class="event-info">
                                <div class="event_left">
                                    <div>
                                        <a class="navbar-brand" href="{{ url('/admin/event') }}">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 30 30"
                                                style="enable-background:new 0 0 30 30;height: 40px;width: 40px;"
                                                xml:space="preserve">
                                                <style type="text/css">
                                                    .st0 {
                                                        fill: #FFFFFF;
                                                    }

                                                    .st1 {
                                                        fill: #1D73AD;
                                                    }

                                                </style>
                                                <circle class="st0" cx="15.4" cy="15" r="13.1"></circle>
                                                <g>
                                                    <g>
                                                        <polygon class="st1"
                                                            points="16.6,20.7 12,15 16.6,9.3 18,10.5 14.3,15 18,19.5 		">
                                                        </polygon>
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="flex_content">
                                        <div class="event_info_name">{{ $event->event_name}}

                                        </div>
                                        <div class="event_info_date">
                                            {{Carbon\Carbon::parse($event->start_date)->format('d/m/Y')}} -
                                            {{Carbon\Carbon::parse($event->end_date)->format('d/m/Y')}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="event-code">
                                <div class="event_info_code">#{{$event->event_code}}</div>
                                <button type="button" class="qr-btn" data-toggle="modal"
                                    data-target=".qrcode">
                                    <i class="fa fa-qrcode"></i>
                                </button>
                                <div class="modal fade qrcode" tabindex="-1" role="dialog" aria-labelledby="qrcode" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="title">{{$event->event_name}}</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="margin:0 auto;">
                                                {!! QrCode::size(600)->generate($event->event_link); !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="user_info_container">
                        <div class=user_header_info>
                            <div class="user_info">
                                <i class="fa fa-user"></i>
                                {{Auth::user()->email}}
                            </div>
                            <div class="user_role">
                                Host
                            </div>
                        </div>
                        <div class="user_setting" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fa fa-cog"></i>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" onclick="window.location.href='/user'"><i class="fa fa-edit"></i>Edit</a></li>
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
                        </div>
                    </div>
                </div>

            </div>
            <div class="navbar_select">
                <div class="container event_option">
                    <!-- <button class="is-active"><a href="/admin/event/{{$event->event_code}}">Question</a></button>
                    <button>Poll</button> -->
                    <button class="question-btn" onclick="window.location.href='/admin/event/{{$event->event_code}}'">QUESTIONS</button>
                    <button class="poll-btn" onclick="window.location.href='#'">POLLS</button>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <footer>
        <div class="top-footer">
            <div class="wrapper-title">VLask | Designed by 5Bs</div>
        </div>
    </footer>
</body>

</html>
