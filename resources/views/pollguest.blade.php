@extends('layouts.guest')
@push('head')
<!-- Scripts -->
    <script src="{{ asset('js/pollguest.js') }}" defer></script>
@endpush
@section('content')
<div class="container">

    <div class="poll-container">
        <h1 class="h1-content total-answer">
            
        </h1>
        <form action="/room/poll/vote/" enctype="multipart/form-data" method="post" class="poll-form">
        @csrf
            <div class="poll-form-content">

            </div>
        </form>
        <div class="poll-result">
  
        </div> 
    </div>
</div>
<script>
getRunningPoll = function(){
    $.ajax({
        url: '/room/guest/getpoll/'+$('#this-event-id').val(),
        success: function(data){
            $('.total-answer').html(data[2]+' <i class="fa fa-user" aria-hidden="true"></i>')
            $('.poll-form-content').html('')
            $('.poll-form-content').append(
                '<div class="poll-form-header">'+
                '</div>'+
                '<div class="poll-form-body">'+
                '<span class="text-danger vote-error"></span>'+
                '</div>'+
                '<div class="form-footer poll-form-footer">'+
                '</div>'
            )

            if(data[0].length>=2){
                $('.poll-form-header').html(data[3])
                $('.poll-form-content').append(
                    '<input type="text" name="poll-id" value="'+data[4]+'" hidden>'
                )
                if(data[1]==0){
                    $('.poll-form-body').append(
                        '<fieldset class="poll-answers">'+
                        '</fieldset>'
                    )
                    for(var i=0 ; i<data[0].length; i++){
                        $('.poll-answers').append(
                            '<input id="talk-type-'+data[0][i].id+'" '+
                                    'name="poll_answer" '+
                                    'type="radio" '+
                                    'value="'+data[0][i].id+'" '+
                                    'class="check-answer" '+
                                    'hidden/>'+
                            '<label for="talk-type-'+data[0][i].id+'" class="radio-label poll-label">'+
                                '<span class="styled-radio-btn"></span>'+
                                data[0][i].content+
                            '</label>'
                        )
                    }
                }else{
                    $('.poll-form-body').append(
                        '<div class="poll-answers">'+
                        '</div>'
                    )
                    for(var i=0 ; i<data[0].length; i++){
                        $('.poll-answers').append(
                            '<label class="checkbox-label poll-label" for="available-'+data[0][i].id+'">'+
                            '<input id="available-'+data[0][i].id+'" '+
                                        'name="poll_answer[]" '+
                                        'type="checkbox" '+
                                        'value="'+data[0][i].id+'" '+
                                        'class="check-answer" '+
                                            'hidden/>'+
                                        '<span class="styled-checkbox"></span>'+
                                        data[0][i].content+
                            '</label>'
                        )
                    }
                }
                $('.poll-form-content .poll-form-footer').append(
                    '<button id="submit-btn-poll" class="submit-poll-btn poll-btn" value="'+data[4]+'">{{ trans('message.send-btn') }}</button>'          
                )
            }else{
                $('.poll-form-header').html('{{ trans('message.no-poll-available') }}')
            }
        votePoll();  
        isVoted();
        answerIsVoted();
        },
        error: function(data){
        }
    })
}
getResultRunningPoll = function(){
    $.ajax({
        url: '/room/guest/getpoll/'+$('#this-event-id').val(),
        success: function(data){
            if(data[0].length>=2){
                $('.total-answer').html(data[2]+' <i class="fa fa-user" aria-hidden="true"></i>')
                $('.poll-result').html('');
                $('.poll-result').append(
                    '<div class="poll-form-header">'+
                    '</div>'
                )
                if(data[2]!=0){
                    $('.poll-form-header').html(data[3])
                    for(var i=0 ; i<data[0].length; i++){
                        $('.poll-result').append(
                        '<div class="poll-result-item p-1">'+
                            '<div class="poll-result-answer">'+
                                ''+data[0][i].content+' <span class="votes">('+data[0][i].votes+')</span>'+
                            '</div>'+
                            '<div class="result-bar">'+
                                '<span class="poll-result-bar" data-width="'+(data[0][i].votes/data[2])*90+'%"></span>'+
                                '<span class="percent">'+Math.round((data[0][i].votes/data[2])*100)+'%</span>'+
                            '</div>'+
                        '</div>'
                        )
                    }

                }else{
                    for(var i=0 ; i<data[0].length; i++){
                        $('.poll-result').append(
                            '<div class="poll-result-item p-1">'+
                                '<div class="poll-result-answer">'+
                                    ''+data[0][i].content+' <span class="votes">(0)</span>'+
                                '</div>'+
                                '<div class="result-bar">'+
                                    '<span class="poll-result-bar" data-width="0%"></span>'+
                                    '<span class="percent">0%</span>'+
                                '</div>'+
                            '</div>'
                        )
                    }
                }
                $('.poll-result').append(
                    '<div class="question-form__footer poll-form-footer">'+
                        '<button type="button" id="edit-poll-btn" class="edit-poll-btn poll-btn">{{ trans('message.edit-response') }}</button>'+
                    '</div>'+  
                    '</div>' 
                )
            }else{
                $('.poll-form-header').html('{{ trans('message.no-poll-available') }}')
                $('.total-answer').html('0 <i class="fa fa-user" aria-hidden="true"></i>')
            }
            reVote();
        },error: function(data){
            alert('fail')
        }
    })
}
</script>
@endsection