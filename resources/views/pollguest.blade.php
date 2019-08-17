@extends('layouts.guest')
@push('head')
<!-- Scripts -->
    <script src="{{ asset('js/pollguest.js') }}" defer></script>
@endpush
@section('content')
<div class="container">

    <div class="poll-container">
    @if($poll==null)
        <h1 class="h1-content total-answer">
            0 <i class="fa fa-user" aria-hidden="true"></i>
        </h1>
        <form action="" enctype="multipart/form-data" method="post" class="poll-form">
            <div class="poll-form-header">
            {{ trans('message.no-poll-available') }}
            </div>
        </form>
    @else
        <h1 class="h1-content total-answer">

        </h1>
        <form action="/room/poll/vote/" enctype="multipart/form-data" method="post" class="poll-form">
        @csrf
        <input type="text" name="poll-id" value="{{$poll->id}}" hidden>
            <div class="poll-form-header">

            </div>
            <div class="poll-form-body">
            <span class="text-danger vote-error"></span>

            </div> 
            <div class="form-footer">
                <button id="submit-btn-poll" class="submit-poll-btn poll-btn" value="{{$poll->id}}">{{ trans('message.send-btn') }}</button>          
            </div>
        </form>
        <div class="poll-result">
        @php
            $sum=0;
            foreach($poll->answers as $answer){
                $sum+=$answer->votes;
            }
        @endphp
        @if($sum!=0)
            @foreach($poll->answers as $answer)
            <div class="poll-result-item p-1">
                <div class="poll-result-answer">
                    {{$answer->poll_answer_content}} <span class="votes">({{$answer->votes}})</span>
                </div>
                <div class="result-bar">
                    <span class="poll-result-bar" data-width="{{($answer->votes/$sum)*90}}%"></span>
                    <span class="percent">{{round(($answer->votes/$sum)*100)}}%</span>
                </div>
            </div>
            @endforeach
        @else
            @foreach($poll->answers as $answer)
            <div class="poll-result-item p-1">
                <div class="poll-result-answer">
                    {{$answer->poll_answer_content}} <span class="votes">(0)</span>
                </div>
                <!-- width là (số lượt vote answers/tổng số vote) * 100 -->
                <div class="result-bar">
                    <span class="poll-result-bar" data-width="0%"></span>
                    <span class="percent">0%</span>
                </div>
            </div>
            @endforeach
        @endif
        <div class="question-form__footer poll-form-footer">
            <button type="button" id="edit-poll-btn" class="edit-poll-btn poll-btn">{{ trans('message.edit-response') }}</button>
        </div>   
        </div> 

    
    @endif
    </div>
</div>
<script>
getRunningPoll = function(){
    $.ajax({
        url: '/room/guest/getpoll/'+$('#this-event-id').val(),
        success: function(data){
            $('.total-answer').html(data[2]+' <i class="fa fa-user" aria-hidden="true"></i>')
            $('.poll-form-header').html(data[3])
            $('.poll-form').append(
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
        },
        error: function(data){
            alert('fail'+data)

        }
    })
}
</script>
@endsection