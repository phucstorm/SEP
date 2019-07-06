@extends('layouts.event')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">Incoming</div>
        <div class="col-6">Live</div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="content">
            @foreach($question as $key => $value)
            @if($value->status == 0)
                <div>Question: {{$value->content}} by {{$value->user_name}}</div>
                <div>ID: {{$value->id}} by {{$value->user_name}}</div>
                <div>
                    <button><a href="/room/question/accept/{{$value->id}}">Yes</a></button>
                    <button><a href="/room/question/denied/{{$value->id}}">No</a></button>
                </div>
            @endif
            @endforeach
            </div>
        </div>
        <div class="col-6">
            <div class="accept">
            @foreach($question as $key => $value)
            @if($value->status == 1)
                <div>{{$value->content}}</div>
                <div>{{$value->user_name}}</div>
                <button><a href="/room/question/denied/{{$value->id}}">Delete</a></button>
            @endif
            @endforeach
            </div>
            
        </div>
    </div>
</div>


@endsection