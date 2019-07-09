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
                <!-- <button><a href="/room/question/denied/{{$value->id}}">Delete</a></button> -->
                <button type="button" class="btn btn-outline-danger delete_question" 
                        data-id="{{$value->id}}" data-toggle="modal" data-target="#delete_question">delete
                </button>
            @endif
            @endforeach
            </div>
            
        </div>
    </div>
</div>


<!-- Modal Delete Question -->
<div class="modal fade" id="delete_question" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="delete_title">Warning !!!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Would you like to permanently delete this question?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" id="del_ques">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection