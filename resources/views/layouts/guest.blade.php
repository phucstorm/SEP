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
    <script src="{{ asset('js/guest.js') }}" defer></script>
    <!-- <script src="{{ asset('js/event.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/guest.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm" id="attendee-navbar">
        <img src="{{ asset('img/VLask-logo.png')}}" id="vlask-logo" alt="">
            <div class="container">
                <div class="event-info">
                    <div class="event-name">{{$event->event_name}}</div>
                    <div class="event-code">#{{$event->event_code}}</div>
                </div>      
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" class="nav-item-link" href="" style="color: white;">QUESTIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" class="nav-item-link" href="" style="color: white;">POLLS</a>
                    </li>
                </ul>
                <div class="switch-event">
                    <button>
                        <i class="fa fa-exchange"></i> Switch event
                    </button>
                </div>
            </div>
        </nav>
        <main class="py">
            @yield('content')
        </main>         
    </div>
</body>

</html>
