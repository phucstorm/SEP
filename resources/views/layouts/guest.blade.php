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
    <!-- <script src="{{ asset('js/event.js') }}" defer></script> -->

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
            
            <a href="" class="navbar-brand">{{$event->event_name}}</a>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="" style="color: white;">Question</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="" style="color: white;">Poll</a>
                </li>
            </ul>
        </div>
    </nav>
    <main class="py" style="padding: 0px 200px;">
        @yield('content')
    </main>  
        
    </div>
</body>

</html>
