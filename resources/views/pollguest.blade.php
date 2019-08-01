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
                There is no poll available at the moment!
            </div>
            <div class="poll-form-body">
                <div class="poll-answers">

                </div>
            </div>
            <!-- <button id="submit-btn" class="submit-poll-btn poll-btn">Send</button> -->
        </form>
    @else
        <h1 class="h1-content total-answer">
            {{$poll->total_votes}} <i class="fa fa-user" aria-hidden="true"></i>
        </h1>
        <form action="/room/poll/vote/{{$poll->id}}" enctype="multipart/form-data" method="post" class="poll-form">
        @csrf
            @method('PATCH')
            <div class="poll-form-header">
                {{$poll->poll_question_content}}
            </div>
            <div class="poll-form-body">
                @if($errors->any())
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                    </ul>
                @endif
                @if($poll->mul_choice == 0)
                    <!-- non-multiple choice thì hiển thị dạng radio button -->
                    <fieldset class='poll-answers'>
                        <legend hidden>id</legend>
                        @foreach($poll->answers as $answer)
                            <input id='talk-type-{{$answer->id}}'
                                    name='poll_answer[]'
                                    type='radio'
                                    value='{{$answer->id}}' 
                                    hidden/>
                            <label for='talk-type-{{$answer->id}}' class='radio-label poll-label'>
                                <span class="styled-radio-btn"></span>
                                {{$answer->poll_answer_content}}
                            </label>
                        @endforeach
                    </fieldset>
                @else
                    <!-- multiple choice thì hiển thị dạng checkbox -->
                    <div class='poll-answers'>
                        @foreach($poll->answers as $answer)
                            <label class='checkbox-label poll-label' for='available-{{$answer->id}}'>
                            <input id='available-{{$answer->id}}'
                                    name='poll_answer[{{$answer->id}}]'
                                    type='checkbox'
                                    value='{{$answer->id}}'
                                        hidden/>
                                        <span class="styled-checkbox"></span>
                                    {{$answer->poll_answer_content}}
                            </label>
                        @endforeach 
                    </div>
                @endif            
            </div> 
            <button id="submit-btn-poll" class="submit-poll-btn poll-btn" value="{{$poll->id}}">Send</button>
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

        </div> 

        <div class="question-form__footer poll-form-footer">
            <button type="button" id="submit-btn" class="submit-poll-btn poll-btn show-result">Show Result</button>
            <button type="button" id="edit-btn" class="edit-poll-btn poll-btn">Edit Response</button>
        </div>       
    @endif
    </div>



</div>
@endsection