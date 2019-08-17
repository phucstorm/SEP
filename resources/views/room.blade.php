@extends('layouts.guest')
@push('head')
<!-- Scripts -->
    <script src="{{ asset('js/guest.js') }}" defer></script>
@endpush
@section('content')
@php
    $reply = trans('message.reply')
@endphp
    <div class="container">
        <div class="input-group">

            @if($event->setting_question==0)
            <div>{{ trans('message.not-allow-ask') }}</div>
            @else
            <h1 class="h1-content">{{ trans('message.ask-the-host') }}</h1>  
            <form action="/room" method="post" class="question-form">
                <div class="question-form-body">
                    <input type="text" name="event_id" value="{{$event->id}}" hidden>
                    <textarea type="text" class="input-question" name="question" maxlength='300' placeholder="{{ trans('message.type-your-question') }}" id="input-question"></textarea>
                    <span id="characters">300</span>
                </div>   
                <div class="question-form__footer">

                    <input type="text" name="user_name" placeholder="{{ trans('message.name-attendee') }}" id="input-name">
                    <button type="button" id="submit-btn" class='question-btn send-question-btn'>{{ trans('message.send-btn') }}</button>
                    
                </div>
                <div class="text-danger error-anonymous text-center">{{ trans('message.message-anonymous-ask') }}</div>
                    <div class="text-danger error-empty text-center">{{ trans('message.message-enter-question') }}</div>
                {{csrf_field()}}
            </form>
            @endif

        </div>
        <div class="content-header">
            <div>
                <ul class="content-nav-tabs">
                    <li role="presentation">
                        <button class="content-nav-tabs-item popular-btn  is-selected">{{ trans('message.recent-tab') }}</button>
                    </li> 
                </ul>
                <ul class="content-nav-tabs">
                    <li role="presentation">
                        <button class="content-nav-tabs-item recent-btn">{{ trans('message.popular-tab') }}</button> 
                    </li> 
                </ul>
            </div>
            <h1 class="h1-content total-question">
                {{$count}} {{ trans('message.questions') }}
            </h1>
        </div>
        <div class="question-list popular-question">

        </div>
    </div>

    <!-- Modal For Reply Quest -->
    <div class="modal fade" id="replyQuestion" tabindex="-1" role="dialog" aria-labelledby="reply"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="reply-form" enctype="multipart/form-data" method="post">
            @csrf
            <input type="text" id="questionIdInput" name="question-id" hidden>
                <div class="modal-header">
                    <h5 class="modal-title question-reply-title" id="title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-reply">

                </div>
                @if($event->setting_reply==1)
                <div class="text-danger error-ans-anonymous text-center">{{ trans('message.type-your-answer') }}</div>
                        <div class="text-danger error-ans-empty text-center">>{{ trans('message.message-enter-reply') }}</div>
                <div class="footer">
                    <div>
                        <textarea maxlength="300" placeholder="{{ trans('message.type-your-answer') }}" name="reply" class="input-answer"
                        type="text" required></textarea>
                        <input type="text" name="username" class="input-username" maxlength="30" placeholder="{{ trans('message.name-attendee') }}">
                    </div>
                        <button class="btn send-reply-btn" type="submit"><i class="fa fa-paper-plane"
                        aria-hidden="true"></i></button>

                </div>
                @endif
            </form>
        </div>
    </div>
</div>
<script>

getQuestion = function(){
    $.ajax({
        url: '/room/getquestion/'+$('#this-event-id').val(),
        success: function(data){
            $('.popular-question').html('');
            $('.accept').html('');
            $('.total-question').html(''+data.length+' <?php echo e(trans('message.questions')); ?>');
            for (var i=0; i<data.length; i++){
                var date = moment.parseZone(data[i].date).format("YYYY-MM-DD HH:mm:ss");
                    $('.popular-question').append(
                        '<div class="question-container">'+
                            '<div class="question-info">'+
                                '<div class="question-username"><i class="fa fa-user"></i> '+data[i].name+'</div>'+
                                '<div class="question-date">'+date+'</div>'+
                                '<div class="question-content">'+data[i].content+'</div>'+
                            '</div>'+
                            '<div class="question-like">'+
                                '<button class="like-btn'+data[i].id+' like-btn is-not-liked" value="'+data[i].id+'"><span class="like-number">'+data[i].like+' </span><i class="fa fa-thumbs-up"></i></button>'+
                            '</div>'+
                            '<button class="btn reply-btn" type="button" data-id="'+data[i].id+'" data-name="'+data[i].content+'" data-toggle="modal" data-target="#replyQuestion">'+
                            '<i class="fa fa-reply" aria-hidden="true"></i> <?php echo e(trans('message.reply')); ?></button>'+
                        '</div>'
                    );
            }
            likeQuestion();
            getReplies();
            loadLike();

        },
        error: function(data){
            alert('fail'+data);
        }
    })

}
getPopularQuestion = function(){
    $.ajax({
        url: '/room/getquestion/'+$('#this-event-id').val(),
        success: function(data){
            $('.popular-question').html('');
            $('.accept').html('');
            $('.total-question').html(''+data.length+' <?php echo e(trans('message.questions')); ?>');
            for (var i=0; i<data.length; i++){
                for(let j = i + 1; j < data.length; j++){
                    if(data[j].like > data[i].like){
                        let t = data[i];
                        data[i] = data[j];
                        data[j] = t;
                    }
                }
            }
            for (var i=0; i<data.length; i++){
                var date = moment.parseZone(data[i].date).format("YYYY-MM-DD HH:mm:ss");
                    $('.popular-question').append(
                        '<div class="question-container">'+
                            '<div class="question-info">'+
                                '<div class="question-username"><i class="fa fa-user"></i> '+data[i].name+'</div>'+
                                '<div class="question-date">'+date+'</div>'+
                                '<div class="question-content">'+data[i].content+'</div>'+
                            '</div>'+
                            '<div class="question-like">'+
                                '<button class="like-btn'+data[i].id+' like-btn is-not-liked" value="'+data[i].id+'">'+data[i].like+' <i class="fa fa-thumbs-up"></i></button>'+
                            '</div>'+
                            '<button class="btn reply-btn" type="button" data-id="'+data[i].id+'" data-name="'+data[i].content+'" data-toggle="modal" data-target="#replyQuestion">'+
                            '<i class="fa fa-reply" aria-hidden="true"></i> <?php echo e(trans('message.reply')); ?></button>'+
                        '</div>'
                    );
                }

            likeQuestion();
            getReplies();
            loadLike();

        },
        error: function(data){
            alert('fail'+data);
        }
    })

}

//live question
Pusher.logToConsole = true;

var pusher = new Pusher('9ca3866fa2e26a25d235', {
    cluster: 'ap1',
    forceTLS: true
});
var channel = pusher.subscribe('my-channel');
channel.bind('form-submitted', function (data) {
    getReplies();
    if ($(".popular-btn").hasClass("is-selected")) {
        getQuestion();
    }
    if ($(".recent-btn").hasClass("is-selected")) {
        getPopularQuestion();
    }
});
// }


</script>
@endsection
