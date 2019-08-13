@extends('layouts.guest')
@push('head')
<!-- Scripts -->
    <script src="{{ asset('js/guest.js') }}" defer></script>
@endpush
@section('content')
    <div class="container">
        <div class="input-group">
            <h1 class="h1-content">Ask the host</h1>  
            <form action="/room" method="post">
                <div class="question-form-body">
                    <input type="text" name="event_id" value="{{$event->id}}" hidden>
                    <textarea type="text" name="question" maxlength='300' placeholder="Type your question..." id="input-question"></textarea>
                    <span id="characters">300</span>
                </div>   
                <div class="question-form__footer">

                    <input type="text" name="user_name" placeholder="Your name (optional)" id="input-name">
                    <button type="submit" id="submit-btn" class='question-btn'>Send</button>
                </div>
                {{csrf_field()}}
            </form>
        </div>
        <div class="content-header">
            <div>
                <ul class="content-nav-tabs">
                    <li role="presentation">
                        <button class="content-nav-tabs-item popular-btn  is-selected">Recent</button>
                    </li> 
                </ul>
                <ul class="content-nav-tabs">
                    <li role="presentation">
                        <button class="content-nav-tabs-item recent-btn">Popular</button> 
                    </li> 
                </ul>
            </div>
            <h1 class="h1-content total-question">
                {{$count}} questions
            </h1>
        </div>
        <div class="question-list popular-question">
        @foreach($question->sortByDesc('created_at') as $value)
        @if($value->status == 1)
            <div class="question-container">
                <div class="question-info">
                    <div class="question-username"><i class="fa fa-user"></i> {{$value->user_name}}</div>
                    <div class="question-date">{{$value->created_at}}</div>
                    <div class="question-content">{{$value->content}}</div>
                </div>
                <div class="question-like">
                    <button class="like-btn{{$value->id}} like-btn is-not-liked" value="{{$value->id}}">{{$value->like}} <i class="fa fa-thumbs-up"></i></button>
                </div>
                <button class="btn reply-btn" type="button" data-toggle="modal" data-target="#reply{{$value->id}}"><i
                                        class="fa fa-reply" aria-hidden="true"></i> Reply</button>
                <!-- Modal For Reply Quest -->
                <div class="modal fade" id="reply{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="reply"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="/guest/reply/{{$value->id}}" class="reply-form" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="text" name="question-id" value="{{$value->id}}" hidden>

                                <div class="modal-header">
                                    <h5 class="modal-title" id="title">{{$value->content}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach($value->replies as $reply)
                                    <div class="reply-item">
                                        <div class="user"><i class="fa fa-user"></i> {{$reply->user_name}}</div>
                                        <div class="reply-date">{{$reply->created_at}}</div>
                                        <div >{{$reply->rep_content}}</div>

                                    </div>
                                    @endforeach
                                </div>
                                <div class="footer">
                                    <div>
                                        <textarea placeholder="Type your answer here..." name="reply" class="input-answer"
                                        type="text" required></textarea>
                                        <input type="text" name="username" class="input-username" placeholder="Your name...">
                                    </div>
                                        <button class="btn send-reply-btn" type="submit"><i class="fa fa-paper-plane"
                                        aria-hidden="true"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
        </div>
        <div class="question-list recent-question">
        @foreach($question->sortByDesc('like') as $question)
        @if($question->status ==1)
            <div class="question-container">
                <div class="question-info">
                    <div class="question-username"><i class="fa fa-user"></i> {{$question->user_name}}</div>
                    <div class="question-date">{{$question->created_at}}</div>
                    <div class="question-content">{{$question->content}}</div>
                </div>
                <div class="question-like">
                    <button class="like-btn{{$question->id}} like-btn is-not-liked" value="{{$question->id}}">{{$question->like}} <i class="fa fa-thumbs-up"></i></button>
                </div>            
            </div>
        @endif
        @endforeach
        </div>
    </div>
@endsection
