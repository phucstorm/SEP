<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VLask</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/layout.js') }}" defer></script>
    <script src="{{ asset('js/event.js') }}" defer></script>
    @stack('head')
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script>


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
                {{Auth::user()->name}}</div>
            <div class="event-name">{{$event->event_name}}</div>
            <div class="event-code">#{{$event->event_code}}</div>
            <div class="event-code">{{$event->start_date}}</div>
        </div>
        <ul class="sidebar-nav">
            <li class="nav-item">
                <span><a class="nav-link" class="nav-item-link" href="/admin/event" style="color: white;"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i>
                {{ trans('message.backeventlist') }}</a></span>
            </li>
            <li class="nav-item">
                <span><a class="nav-link" class="nav-item-link" href="/user" style="color: white;"><i
                            class="fa fa-edit"></i> {{ trans('message.edit-account') }}</a></span>
            </li>

            <li class="nav-item">
                <a class="nav-link" class="nav-item-link" href="{{ route('logout') }}" style="color: white;"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> {{ trans('message.logout') }}</a>
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
                                        <button type="button" style="color:white" class="btn edit-event-btn" data-id="{{$event->id}}"
                                            data-code="{{$event->event_code}}" 
                                            data-name="{{$event->event_name}}"
                                            data-description="{{$event->event_description}}" 
                                            data-link="{{$event->event_link}}"
                                            data-mod="{{$event->setting_moderation}}" 
                                            data-start="{{Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i')}}"
                                            data-end="{{Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i')}}"  
                                            data-join="{{$event->setting_join}}"
                                            data-question="{{$event->setting_question}}" 
                                            data-reply="{{$event->setting_reply}}"
                                            data-anonymous="{{$event->setting_anonymous}}" 
                                            data-toggle="modal" 
                                            data-target="#edit"><i
                                                class="fa fa-edit"></i>
                                        </button>

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
                                {{Auth::user()->name}} <i class="fa fa-cog"></i>
                            </div>
                            <div class="user_role">
                                Host
                            </div>
                        </div>
                        <div class="user_setting">      
                            <ul class="user-setting-menu">
                                <li class="dropdown-item edit_user_info-btn" data-name="{{Auth::user()->name}}" data-email="{{Auth::user()->email}}"
                                data-id="{{Auth::user()->id}}" data-toggle="modal" data-target="#editInfo"><a class="dropdown-item"><i class="fa fa-edit"></i> {{ trans('message.edit') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> {{ trans('message.logout') }}
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
                    <button class="question-btn" onclick="window.location.href='/admin/event/{{$event->event_code}}'">{{ trans('message.question-tab') }}</button>
                    <button class="poll-btn" onclick="window.location.href='/admin/event/poll/{{$event->event_code}}'">{{ trans('message.poll-tab') }}</button>
                </div>
            </div>
        </div>
    </header>
            <!-- Modal Edit User Information -->
            <div class="modal fade" id="editInfo" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">{{ trans('message.edit-user') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" method="post">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.name') }}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="un" name="un"required maxlength="30">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="em" name="em" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ trans('message.cancel-btn') }}</button>
                    <button type="submit" class="btn btn-success" id="edit_info">{{ trans('message.save-btn') }}</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal For Edit Event -->
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form role="form" method="post" id="edit_form" class="submit-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">{{ trans('message.edit-event') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.event-name') }}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="en" name="en" maxlength="100" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.event-code') }}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ec" name="ec" maxlength="5" required>
                            </div>
                            <div class="col-sm-12  text-center event-code-error-message">
                                <span class="text-danger">{{ trans('message.eventcode-error') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.description') }}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ds" name="ds" maxlength="200" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.start-date') }}</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="sd" name="sd" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.end-date') }}</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="ed" name="ed" required>
                            </div>
                        </div>
                        <div class="form-event-optional">
                            <label class="col-form-label">{{ trans('message.options') }}: </label>
                            <div class="form-group row">
                                <label for="ji" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="ji" name="ji">
                                    <span> {{ trans('message.join-check') }}</span>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label for="qt" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="qt" name="qt">
                                    <span> {{ trans('message.ask-check') }}</span>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label for="rl" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="rl" name="rl">
                                    <span> {{ trans('message.reply-check') }}</span>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label for="md" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="md" name="md">
                                    <span> {{ trans('message.moderation-check') }}</span>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label for="an" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="an" name="an">
                                    <span> {{ trans('message.anonymous-check') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Link</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="li" name="li" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12  text-center date-error-message">
                                <span class="text-danger">{{ trans('message.error-end-time') }}</span>
                            </div>
                            <div class="col-sm-12  text-center data-error-message">
                                <span class="text-danger">Please check the information you have entered, we do not accept incorrect dates</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ trans('message.cancel-btn') }}</button>
                        <button type="submit" class="btn btn-success" id="update">{{ trans('message.save-btn') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @yield('content')
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
    Pusher.logToConsole = true;

    var pusher = new Pusher('9ca3866fa2e26a25d235', {
        cluster: 'ap1',
        forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('form-submitted', function (data) {
        getQuestion();
    });
    //get question
getQuestion = function(){
    $.ajax({
        url: '/admin/getquestion/'+$('#this-event-id').val(),
        success: function(data){
            $('.content').html('');
            $('.accept').html('');
            for (var i=0; i<data.length; i++){
                var date = moment.parseZone(data[i].date).format("YYYY-MM-DD HH:mm:ss");
                if(data[i].status==0){
                    $('.content').append(
                        "<div class='question-item'>" +
                            "<div class='question-username'>"+
                                "<i class=' fa fa-user'></i> "+ data[i].name+
                            "</div>"+
                            "<div class='question-date'>"+date+"</div>"+
                            "<div class='question-content'>"+data[i].content+"</div>"+
                        "<div class='check-question'>" +
                        "<button class='btn accept-btn' style='font-size: 1em;padding:0' data-id='"+data[i].id+"'><i class='fa fa-check-circle-o text-success' aria-hidden='true'></i></button> " +
                        "<button class='btn deny-btn' style='font-size: 1em;padding:0' data-id='"+data[i].id+"'><i class='fa fa-times-circle-o text-success' aria-hidden='true'></i></a>" +
                        "</div>"+
                        "</div>"
                    )
                }else{
                    $('.accept').append(
                        '<div class="question-item">'+
                            '<div class="question-like">'+
                                '<button class="like-btn'+data[i].id+' like-btn is-not-liked" value="'+data[i].id+'">'+data[i].like+' <i class="fa fa-thumbs-up"></i></button>'+
                            '</div>'+
                            '<div class="question-username"><i class="fa fa-user"></i> '+data[i].name+' </div>'+
                            '<div class="question-date">'+date+'</div>'+
                            '<div class="question-content">'+data[i].content+'</div>'+
                            '<div style="display: flex; justify-content: space-between;">'+
                                '<div class="left-action">'+
        
                                '</div>'+
                                '<div style="float:right; display: flex">'+
                                    '<div style="margin-right:1em">'+
                                        '<button class="reply-btn reply-button" type="button" data-id="'+data[i].id+'"'+
                                            'data-name="'+data[i].content+'" data-toggle="modal" data-target="#replyQuestion">'+
                                                '<i class="fa fa-reply" aria-hidden="true"></i> <?php echo e(trans('message.reply')); ?></button>'+
                                    '</div>'+
        
                                '</div>'+
                            '</div>'+
                            '<div class="delete-question-btn">'+
                                '<button class="item-action delete-item" data-toggle="modal" data-target="#delete_question"'+
                                    'data-id="'+data[i].id+'" data-name="'+data[i].content+'">'+
                                    '<i class="fa fa-times" aria-hidden="true"></i>'+
                                '</button>'+
                            '</div>'+
                        '</div>'
                    );
                }
            }
            likeQuestion();
            getReplies();
            loadLike();
            acceptQuestion();
            denyQuestion();
        },
        error: function(data){
            alert('fail'+data);
        }
    })

}
</script>
</body>

</html>
