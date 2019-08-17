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
    @stack('head')    
    <script src="{{ asset('js/layout.js') }}" defer></script>
    <!-- <script src="{{ asset('js/event.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/guest.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

</head>

<body>
        <header>
        <input id="this-event-id" value="{{$event->id}}" hidden>
            <div class='navbar_info'>
                <div class="sidebar-toggle">
                    <i class="fa fa-bars" ></i>
                </div>
                <div class="vlask-logo">
                    <img src="{{ asset('img/VLask-logo.png')}}" alt="">
                    <h1>VLask</h1>
                </div>
                <div class="container">
                    <div class="event-info">
                        <div class="event-name">{{$event->event_name}}</div>
                        <div class="event-code">#{{$event->event_code}}</div>
                    </div>      
                </div>
                <div class="switch-event" onclick="window.location.href='/'">
                    <button>
                        <i class="fa fa-exchange"></i> {{ trans('message.switch-event') }}
                    </button>
                </div>
            </div>
            <div class="navbar_select">
                <div class="container">
                    <button class="question-btn" onclick="window.location.href='/room?room={{$event->event_code}}'">{{ trans('message.question-tab') }}</button>
                    <button class="poll-btn" onclick="window.location.href='/room/poll/{{$event->event_code}}'">{{ trans('message.poll-tab') }}</button>
                </div>
            </div>
        </header>
        <div class="opacity_menu"></div>
        <nav class="sidebar-navigation">
            <div class="event-sidebar-info">
                <div class="event-name">{{$event->event_name}}</div>
                <div class="event-code">#{{$event->event_code}}</div>
                <div class="event-code">#{{$event->start_date}}</div>
            </div>
            <ul class="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link" class="nav-item-link" href="/" style="color: white;"><i class="fa fa-exchange"></i> {{ trans('message.switch-event') }}</a>
                </li>
            </ul>
        </nav>
        <main class="py">
            @yield('content')
        </main>   
        <footer>
        <div class="footer_pd row_pd">
            <div class="row align-items-center" style="text-align:center">
                <div class="change-language col-12 col-md-4">
                    <a href="/lang/en" class="">
                        <img src="{{ asset('img/united-states.png')}}" alt="">
                        English
                    </a>
                    <span>|</span>
                    <a href="/lang/vi" class="">
                        <img src="{{ asset('img/vietnam.jpg')}}" alt="">
                            Tiếng Việt
                    </a>
                </div>
                <div class="ul-flex-decoration col-12 col-md-8">
                    VLask | Designed by 5Bs
                </div>

            </div>
        </div>
    </footer>      
</body>

</html>
