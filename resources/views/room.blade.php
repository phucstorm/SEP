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
                        <button class="content-nav-tabs-item popular-btn  is-selected">Popular</button>
                    </li> 
                </ul>
                <ul class="content-nav-tabs">
                    <li role="presentation">
                        <button class="content-nav-tabs-item recent-btn">Recent</button> 
                    </li> 
                </ul>
            </div>
            <h1 class="h1-content total-question">
                {{$count}}
            </h1>
        </div>
        <div class="question-list popular-question">
        @foreach($question as $key => $value)
        @if($value->status == 1)
            <div class="question-container">
                <div class="question-info">
                    <div class="question-username"><i class="fa fa-user"></i>{{$value->user_name}}</div>
                    <div class="question-date">{{$value->created_at}}</div>
                    <div class="question-content">{{$value->content}}</div>
                </div>
                <div class="question-like"><button class="like-btn"><i class="fa fa-thumbs-up"></i></button></div>
            </div>
        @endif
        @endforeach
        </div>
        <div class="question-list recent-question">
            <div class="question-container">
                <div class="question-info">
                    <div class="question-username"><i class="fa fa-user"></i> Đây là các câu hỏi recent aaaaaaaaaaaaaaa</div>
                    <div class="question-date">Date goes here...</div>
                    <div class="question-content">Content goes here...</div>
                </div>
                <div class="question-like"><button class="like-btn"><i class="fa fa-thumbs-up"></i></button></div>
            </div>
            <div class="question-container">
                <div class="question-info">
                    <div class="question-username"><i class="fa fa-user"></i> Name goes here...</div>
                    <div class="question-date">Date goes here...</div>
                    <div class="question-content">Content goes here...</div>
                </div>
                <div class="question-like"><button class="like-btn"><i class="fa fa-thumbs-up"></i></button></div>
            </div>
            <div class="question-container">
                <div class="question-info">
                    <div class="question-username"><i class="fa fa-user"></i> Name goes here...</div>
                    <div class="question-date">Date goes here...</div>
                    <div class="question-content">Content goes here...</div>
                </div>
                <div class="question-like"><button class="like-btn"><i class="fa fa-thumbs-up"></i></button></div>
            </div>
        </div>
    </div>
@endsection
