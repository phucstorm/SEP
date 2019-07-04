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
    <script src="{{ asset('js/event.js') }}" defer></script>
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
            // alert(JSON.stringify(data));
            // $get = JSON.stringify(data);
            // console.log(data.question);
            // console.log(data.user_name);
            $('.content').append(
               "<div>Question: "+data.question+" by "+data.user_name+"</div>"+
                "<div>ID: by "+data.user_name+"</div>"+
                "<div>"+
                    "<button><a href=''>Yes</a></button>"+
                    "<button><a href=''>No</a></button>"+
                "</div>"
            );
        });
        
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="30px"
                        viewBox="0 0 66.137 66.137" style="enable-background:new 0 0 30 30;" xml:space="preserve">
                        <g>
                            <g>
                                <path
                                    d="M33.066,66.136C14.834,66.136,0,51.302,0,33.069C0,14.835,14.834,0.001,33.066,0.001
                                    c18.234,0,33.071,14.834,33.071,33.068C66.137,51.302,51.301,66.136,33.066,66.136z M33.066,4.001C17.039,4.001,4,17.041,4,33.069
                                    s13.039,29.067,29.066,29.067c16.03,0,29.071-13.04,29.071-29.067S49.096,4.001,33.066,4.001z" />
                                <polygon
                                    points="35.658,45.575 25.342,33.068 35.658,20.562 38.744,23.106 30.527,33.068 38.744,43.03 		" />
                            </g>
                        </g>
                    </svg>

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> {{ $event->event_name}}</li>
                    </ul>
                    <ul class="nav flex-column">
                        <li class="nav-item">#{{ $event->event_code}}</li>
                        <li class="nav-item"> {{Carbon\Carbon::parse($event->start_date)->format('d-m-Y')}} -
                            {{Carbon\Carbon::parse($event->end_date)->format('d-m-Y')}}</li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->email }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('')}}">Questions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Polls</a>
                </li>
            </ul>
            @yield('content')
        </main>
    </div>
</body>

</html>