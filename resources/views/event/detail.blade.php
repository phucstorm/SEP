@extends('layouts.eventlayout')
@push('head')
<!-- Scripts -->
<script src="{{ asset('js/host-question.js') }}" defer></script>
@endpush
@section('content')
<div class="container">
    <div class="question-nav">
        <div class="title-part live">{{ trans('message.live') }}</div>
        <div class="title-part incoming">{{ trans('message.incoming') }}</div>
    </div>
    <div class="row question">
        <div class="question-item-reviewing">
            <div class="moderation-title">
                <div class="title-part">
                {{ trans('message.incoming') }}
                </div>
                <div class="flex-item">
                    @if($event->setting_moderation==1)
                        {{ trans('message.moderation-on') }}
                    @else
                        {{ trans('message.moderation-off') }}
                    @endif
                
                </div>
            </div>
            <div class="content">
            
            
            </div>
        </div>
        <div class="question-item-accepted">
            <div class="title-part d-flex justify-content-between">
                <div>{{ trans('message.live') }}</div>
                <div class="d-flex justify-content-center">
                    <div class="sort-item is-selected recent-btn mr-3">{{ trans('message.recent-tab') }}</div>
                    <div class="sort-item popular-btn">{{ trans('message.popular-tab') }}</div>
                </div>
                <div class="total-question">{{$count}} {{ trans('message.questions') }}</div>
            </div>
            <div class="accept">
            
                
            </div>
        </div>
    </div>
</div>
<!-- Modal Delete Question -->
<div class="modal fade" id="delete_question" tabindex="-1" role="dialog" aria-labelledby="delete"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="delete_title">Warning !!!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            {{ trans('message.message-del-question') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ trans('message.cancel-btn') }}</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="del_ques">{{ trans('message.delete-btn') }}</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal For Reply Quest -->
<div class="modal fade reply-modal" id="replyQuestion" tabindex="-1" role="dialog" aria-labelledby="reply"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/room/reply/" class="reply-form" enctype="multipart/form-data" method="post">
                @csrf
                <input type="text" id="questionIdInput" name="question-id" hidden>

                <input type="text" name="username" value="{{ Auth::user()->name }}" hidden>
                <input type="text" name="userid" value="{{ Auth::user()->id }}" hidden>
                <div class="modal-header">
                    <h5 class="modal-title question-reply-title" id="title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-reply">
                    
                </div>
                <div class="footer">
                        <textarea placeholder="{{ trans('message.type-your-answer') }}" name="reply" class="input-answer"
                        type="text" required maxlength="300"></textarea>
                        <button class="reply-btn send-reply-btn" type="submit"><i class="fa fa-paper-plane"
                        aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
Pusher.logToConsole = true;

var pusher = new Pusher('9ca3866fa2e26a25d235', {
        cluster: 'ap1',
        forceTLS: true
    });

var channel = pusher.subscribe('my-channel');
    channel.bind('form-submitted', function (data) {
        getReplies();
        if ($(".popular-btn").hasClass("is-selected")) {
            getPopularQuestion();
        }
        if ($(".recent-btn").hasClass("is-selected")) {
            getQuestion();
        }
    });
    
//get question
getQuestion = function(){
    $.ajax({
        url: '/admin/getquestion/'+$('#this-event-id').val(),
        success: function(data){
            $('.content').html('');
            $('.accept').html('');
            $('.total-question').html(''+data.length+' <?php echo e(trans('message.questions')); ?>');

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
            deleteQuestion();
        },
        error: function(data){
            alert('fail'+data);
        }
    })

}

getPopularQuestion = function(){
    $.ajax({
        url: '/admin/getquestion/'+$('#this-event-id').val(),
        success: function(data){
            $('.content').html('');
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
</main>

@endsection
