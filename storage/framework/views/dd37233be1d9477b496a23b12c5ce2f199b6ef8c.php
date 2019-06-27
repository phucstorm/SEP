<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/index.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="<?php echo e(asset('js/index.js')); ?>"></script>

</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-transparent">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="<?php echo e(asset('img/logo-vlu-8.png')); ?>" alt="Storm" id="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">LOG IN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">SIGN UP</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="section_0 " style="padding-top: 138px;">
        <div class="row_pd row_1">
            <div class="row_description">
                <div class="description_title">
                    <div class="row_title">
                        <h1 style="text-align: center;">VAN LANG ASK</h1>
                    </div>
                </div>
                <div class="description_content">
                    <div class="row_content">
                        <p style="text-align: center;">
                            <span>Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row_pd row_2">
            <div class="row_col_1">
                <div class="wrap-btn col-btn-1">
                    <a href="#login-section">LOG IN</a>
                </div>
            </div>
            <div class="row_col_2">
                <div class="wrap-btn col-btn-2">
                    <a href="#login-section">SIGN UP</a>
                </div>
            </div>
        </div>
        <div class="row_pd row_3">
            <div class="">
                <div class="wrap_form_position">
                    <form action="/room" method="get">
                        <div class="form_flex">
                            <div class="join_shape">#</div>
                            <input type="text" name="room" class="join_input" placeholder="Enter Event Code">
                            <button type="submit" class="join_button">JOIN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="section_1">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img src="<?php echo e(asset('img/notfolder.png')); ?>" alt="">
                </div>
                <div class="col">
                    <div class="row_col_text">
                        <div class="text_title_content">
                            <h1>Title</h1>
                            <p>
                                <span>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                                    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="row_col_btn">
                        <button class="btn-form" data-target="#login-section">GET START</button>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col">
                    <div class="row_col_text">
                        <div class="text_title_content">
                            <h1>Title</h1>
                            <p>
                                <span>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                                    aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="row_col_btn">
                        <button class="btn-form">GET START</button>
                    </div>
                </div>
                <div class="col">
                    <img src="<?php echo e(asset('img/notfolder.png')); ?>" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="section_2">
        <div class="sec_2_wrap_content row_pd">
            <div class="adv_title">
                <h1><span>Title goes here</span></h1>
            </div>
            <div class="adv_content">
                <p><span>Content goes here</span></p>
            </div>
        </div>
        <div class="adv_col_items row_pd">
            <div class="row" style="text-align:center;">
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <div class="adv_item_img">
                        <img src="<?php echo e(asset('img/usability.png')); ?>" alt="">
                    </div>
                    <div class="adv_item_content">
                        <div class="adv_item_content_title">
                            <h4>Usability</h4>
                        </div>
                        <div class="adv_item_content_des">
                            <p><span>Content goes here</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <div class="adv_item_img">
                        <img src="<?php echo e(asset('img/check.png')); ?>" alt="">
                    </div>
                    <div class="adv_item_content">
                        <div class="adv_item_content_title">
                            <h4>Moderation</h4>
                        </div>
                        <div class="adv_item_content_des">
                            <p><span>Content goes here</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="margin-bottom: 20px;">
                    <div class="adv_item_img">
                        <img src="<?php echo e(asset('img/poll.png')); ?>" alt="">
                    </div>
                    <div class="adv_item_content">
                        <div class="adv_item_content_title">
                            <h4>Unlimited poll</h4>
                        </div>
                        <div class="adv_item_content_des">
                            <p><span>Content goes here</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section_3" id="login-section">
        <div class="form_section row_pd">
            <div class="row" style="text-align:center;">
                <div class="col-md-6">
                    <div class="form_container">
                        <h1>Log in</h1>
                        <div class="input_placed">
                            <form method="POST" action="<?php echo e(route('login')); ?>">
                                <?php echo csrf_field(); ?>
                                <input id="email" placeholder="Email" type="email"
                                    class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email"
                                    value="<?php echo e(old('email')); ?>" required autocomplete="email">
                                <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                <input id="password" placeholder="Password" type="password"
                                    class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password"
                                    required autocomplete="current-password">
                                <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                <div class="form-footer">
                                     <?php if(Route::has('password.request')): ?>
                                    <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                        <?php echo e(__('Forgot Your Password?')); ?>

                                    </a>
                                    <button type="submit" class="btn-form" >
                                        LOG IN
                                    </button>
                                </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form_container">
                        <h1>Sign Up</h1>
                        <div class="input_placed">
                            <form method="POST" action="<?php echo e(route('register')); ?>">
                                <?php echo csrf_field(); ?>
                                <input id="email" placeholder="Email" type="email"
                                    class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email"
                                    value="<?php echo e(old('email')); ?>" required autocomplete="email">
                                <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                <input id="password" placeholder="Password" type="password"
                                    class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password"
                                    required autocomplete="new-password">
                                <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                <input id="password-confirm" placeholder="Confirm Password" type="password"
                                    class="form-control" name="password_confirmation" required
                                    autocomplete="new-password">
                                <div class="form-footer">
                                    <button type="submit" class="btn-form">
                                        SIGN UP
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section_4">
        <div class="pages_info row_pd">
            <div class="pages_info_logo">
                <img src="<?php echo e(asset('img/logo-vlu-8.png')); ?>" alt="">
            </div>
            <div class="pages_info_hotline">
                <div class="row_hotline_pd">
                    <strong>Cơ sở 1 : </strong>
                    <span>45 Nguyễn Khắc Nhu, P. Cô Giang, Q.1, Tp. HCM</span>
                </div>
                <div class="row_hotline_pd">
                    <strong>Điện thoại : </strong>
                    <span>028. 3836 7933</span>
                </div>
                <div class="row_hotline_pd">
                    <strong>Cơ sở 2 : </strong> 
                    <span>233A Phan Văn Trị , P.11, Q. Bình Thạnh, Tp. HCM</span>
                </div>
                <div class="row_hotline_pd">
                    <strong>Cơ sở 3 : </strong>   
                    <span>Cổng 1 - 80/68 Dương Quảng Hàm, P.5, Q. Gò Vấp, Tp. HCM</span> 
                </div>
                <div class="row_hotline_pd">
                    <strong>Cơ sở 3 :</strong>  
                    <span>Cổng 2 - 69/68 Đặng Thùy Trâm, P. 13, Q. Bình Thạnh, Tp. HCM</span> 
                </div>    
            </div>
            <div class="pages_info_social">
                <div class="social_list">
                        <a href="https://www.facebook.com/truongdaihocvanlang/" class="icons_social_fb" title="Follow on Facebook" target="_blank">
                            <span class="fa fa-facebook"></span>
                        <a href="https://www.youtube.com/user/truongdhvanlang" class="icons_social_yt" title="Follow on Youtube" target="_blank">
                            <span class="fa fa-youtube-play"></span>
                        </a>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer_pd row_pd">
            <div class="row justify-content-between" style="text-align:center">
                <div class="ul-flex-decoration">
                    Desiged by 5Bs | Powered by Storm
                </div>
                <div class="col-4">
                </div>
            </div>
        </div>
    </footer>
</body>

</html><?php /**PATH D:\SEP\resources\views/index.blade.php ENDPATH**/ ?>