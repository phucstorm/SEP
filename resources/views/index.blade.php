<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VLask</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-transparent">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img/logo-vlu-8.png')}}" alt="Storm" class="w-100" id="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item scrollto-btn">
                            <button class="nav-link scrollto-btn">{{ trans('message.login') }}</button>
                        </li>
                        <li class="nav-item scrollto-btn">
                            <button class="nav-link scrollto-btn">{{ trans('message.signup') }}</button>
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
                        <h1 style="text-align: center;">{{ trans('message.vlask') }}</h1>
                    </div>
                </div>
                <div class="description_content">
                    <div class="row_content">
                        <p style="text-align: center;">
                            <span>{{ trans('message.slogan') }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
                <div class="wrap-btn scrollto-btn col-btn-1 col-12 col-md-5 col-lg-4">
                    {{ trans('message.login') }}
                </div>
                <div class="wrap-btn scrollto-btn col-btn-2 col-12 col-md-5 col-lg-4">
                {{ trans('message.signup') }}
                </div>
        </div>
        <div class="row_3 row justify-content-center">
            <div class="wrap_form_position col-12 col-md-11 col-lg-9">
                <form action="/room" method="get">
                    <div class="form_flex">
                        <div class="join_shape">#</div>
                        <input type="text" name="room" class="join_input" placeholder="{{ trans('message.join-textbox') }}">
                        <button type="submit" class="join_button">{{ trans('message.join-btn') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="section_1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-6 img1">
                    <img src="{{ asset('img/content1.jpg')}}" class="w-100" alt="">
                </div>
                <div class="col-12 col-lg-6 content1">
                    <div class="row_col_text">
                        <div class="text_title_content">
                            <h2>{{ trans('message.title-question') }}</h2>
                            <p>
                            {{ trans('message.content-question') }}
                                
                            </p>
                        </div>
                    </div>
                    <div class="row_col_btn">
                        <button class="btn-form getstart-btn scrollto-btn" >{{ trans('message.getStart-btn') }}</button>
                    </div>
                </div>
                <div class="col-12 col-lg-6 img2">
                    <img src="{{ asset('img/content2.jpg')}}" class="w-100" alt="">
                </div>
                <div class="col-12 col-lg-6 content2">
                    <div class="row_col_text">
                        <div class="text_title_content">
                            <h2>{{ trans('message.title-vote') }}</h2>
                            <p>
                            {{ trans('message.content-vote') }}
                                
                            </p>
                        </div>
                    </div>
                    <div class="row_col_btn">
                        <button class="btn-form getstart-btn scrollto-btn" onclick="scrollTo()">{{ trans('message.getStart-btn') }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="section_2">
        <div class="sec_2_wrap_content row_pd">
            <div class="adv_title">
                <h1><span>{{ trans('message.title-utility') }}</span></h1>
            </div>
        </div>
        <div class="adv_col_items row_pd">
            <div class="row" style="text-align:center;">
                <div class="col-md-4 col-12" style="margin-bottom: 40px;">
                    <div class="adv_item_img">
                        <img src="{{asset('img/usability.png')}}" alt="">
                    </div>
                    <div class="adv_item_content">
                        <div class="adv_item_content_title">
                            <h4>{{ trans('message.Usability') }}</h4>
                        </div>
                        <div class="adv_item_content_des">
                            <p><span></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12" style="margin-bottom: 40px;">
                    <div class="adv_item_img">
                        <img src="{{asset('img/check.png')}}" alt="">
                    </div>
                    <div class="adv_item_content">
                        <div class="adv_item_content_title">
                            <h4>{{ trans('message.Moderation') }}</h4>
                        </div>
                        <div class="adv_item_content_des">
                            <p><span></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12" style="margin-bottom: 40px;">
                    <div class="adv_item_img">
                        <img src="{{asset('img/poll.png')}}" alt="">
                    </div>
                    <div class="adv_item_content">
                        <div class="adv_item_content_title">
                            <h4>{{ trans('message.Unlimited-poll') }}</h4>
                        </div>
                        <div class="adv_item_content_des">
                            <p><span></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section_3" id="login-section">
        <div class="form_section row_pd">
            <div class="row" style="text-align:center;">
                <div class="col-md-6 col-12">
                    <div class="form_container">
                        <h1>{{ trans('message.login') }}</h1>
                        <div class="input_placed">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div><button class="vanlang-btn">
                                <span class="microsoft-logo"><i class="fa fa-windows" aria-hidden="true"></i></span> LOG IN WITH MICROSOFT 
                                    </button></div>
                                <input id="email" placeholder="Email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input id="password" placeholder="{{ trans('message.password') }}" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="form-footer">
                                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    <button type="submit" class="btn-form getstart-btn">
                                    {{ trans('message.login') }}
                                    </button>
                                    @endif
                                </div>

                                
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form_container">
                        <h1>{{ trans('message.signup') }}</h1>
                        <div class="input_placed">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <input id="name" placeholder="{{ trans('message.name') }}" maxlength="30" type="text" 
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input id="email" placeholder="Email" type="email" maxlength="255"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input id="password" placeholder="{{ trans('message.password') }}" type="password" maxlength="255"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input id="password-confirm" placeholder="{{ trans('message.cfpassword') }}" type="password" maxlength="255"
                                    class="form-control" name="password_confirmation" required
                                    autocomplete="new-password">
                                <div class="form-footer" style="height:40px">
                                    <button type="submit" class="btn-form getstart-btn">
                                    {{ trans('message.signup') }}
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
                <img src="{{ asset('img/logo-vlu-8.png')}}" alt="">
            </div>
            <div class="pages_info_hotline">
                <div class="row_hotline_pd">
                    <strong>{{ trans('message.facility1') }}:</strong>
                    <span>{{ trans('message.basis-1') }}</span>
                </div>
                <div class="row_hotline_pd">
                    <strong>{{ trans('message.phone') }}: </strong>
                    <span>028. 3836 7933</span>
                </div>
                <div class="row_hotline_pd">
                    <strong>{{ trans('message.facility2') }}: </strong>
                    <span>{{ trans('message.basis-2') }}</span>
                </div>
                <div class="row_hotline_pd">
                    <strong>{{ trans('message.facility3') }}: </strong>
                    <span>{{ trans('message.basis-31') }}</span>
                </div>
                <div class="row_hotline_pd">
                    <strong>{{ trans('message.facility3') }}:</strong>
                    <span>{{ trans('message.basis-32') }}</span>
                </div>
            </div>
            <div class="pages_info_social">
                <div class="social_list">
                    <a href="https://www.facebook.com/truongdaihocvanlang/" class="icons_social_fb"
                        title="Follow on Facebook" target="_blank">
                        <span class="fa fa-facebook"></span>
                        <a href="https://www.youtube.com/user/truongdhvanlang" class="icons_social_yt"
                            title="Follow on Youtube" target="_blank">
                            <span class="fa fa-youtube-play"></span>
                        </a>
                </div>
            </div>
        </div>
    </div>
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
    <script>

    $('.scrollto-btn').click(function(){
        const element = document.getElementById('login-section');
        element.scrollIntoView({ block: 'end',  behavior: 'smooth' });
    })
    $(window).scroll(function() {
    if ($(window).scrollTop() > 200) {
        $('.navbar').removeClass('bg-transparent');
	    $('.navbar').addClass('bg-transparent-dark');
	    $('.bg-transparent-dark').css('background-color','#1d2124bf');
    }
    if($(window).scrollTop() == 0){
        $('.navbar').addClass('bg-transparent');
    }
    });
    </script>
</body>

</html>
