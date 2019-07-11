<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <script src="<?php echo e(asset('js/layout.js')); ?>" defer></script>
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
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/layout.css')); ?>" rel="stylesheet">
</head>

<body>
    <div class="opacity_menu"></div>
    <nav class="sidebar-navigation">
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link" class="nav-item-link" href="/user" style="color: white;"> <i class="fa fa-user"
                        style="margin-right:10px;"></i>
                    <?php echo e(Auth::user()->email); ?> - Host</a>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" class="nav-item-link" href="#" style="color: white;">Question</a> -->
                <ul>
                    <li>Tên event</li>
                    <li>01-01-2019 - 02-01-2019</li>
                    <li>Mã event</li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" class="nav-item-link" href="#" style="color: white;">Switch to Question</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" class="nav-item-link" href="#" style="color: white;">Switch to Poll</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" class="nav-item-link" href="/admin/event" style="color: white;">Switch Event</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" class="nav-item-link" href="<?php echo e(route('logout')); ?>" style="color: white;"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <?php echo e(__('Logout')); ?></a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </li>
        </ul>
    </nav>
    <header style="background-color: #1d73ad;color:#fff;">
        <div class="wrapper-flex">
            <div class="mobile-flex">
                <div class="sidebar-toggle">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="fixed_row">
                    <div class="container event_container">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="event_left">
                                    <div>
                                        <a class="navbar-brand" href="<?php echo e(url('/admin/event')); ?>">
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
                                        <div class="event_info_name"><?php echo e($event->event_name); ?></div>
                                        <div class="event_info_date">
                                            <?php echo e(Carbon\Carbon::parse($event->start_date)->format('d/m/Y')); ?> -
                                            <?php echo e(Carbon\Carbon::parse($event->end_date)->format('d/m/Y')); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="event_info_code"># <?php echo e($event->event_code); ?></div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="dropdown" style="text-align:center;">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo e(asset('img/149071.png')); ?>" alt="" width="40px" height="40px">
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#"><?php echo e(Auth::user()->email); ?></a>
                                        <a class="dropdown-item" href="/user">Edit</a>
                                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                            style="display: none;">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="navbar_select">
                <div class="container event_option">
                    <button class="is-active"><a href="/admin/event/<?php echo e($event->event_code); ?>">Question</a></button>
                    <button>Poll</button>
                </div>
            </div>
        </div>
    </header>
    <?php echo $__env->yieldContent('content'); ?>
    <footer>

    </footer>
</body>

</html>
<?php /**PATH D:\SEP\Lavarel\SEP\resources\views/layouts/demo.blade.php ENDPATH**/ ?>