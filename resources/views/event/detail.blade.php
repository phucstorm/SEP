@extends('layouts.demo')
<style>
    html,
    body {
        height: 100%;
        margin: 0;
    }

    body {
        background-color: #f7f7f7 !important;
    }

    #app {
        height: 100%;
    }

    .main-panel{
        margin-top: 2em;
        margin-bottom: 1em;
    }

    .col-6 {
        padding: 0 2em;
    }

    .flex {
        display: flex;
        justify-content: space-between;
    }

    .question {
        height: 80%;
    }

    .title-part {
        opacity: 0.5;
    }

    .content,
    .accept {
        height: 100%;
        border: 2px solid #f7f7f7;
        border-radius: 4px;
        -webkit-box-shadow: 0px 0px 0px 1px rgba(194, 194, 194, 1);
        -moz-box-shadow: 0px 0px 0px 1px rgba(194, 194, 194, 1);
        box-shadow: 0px 0px 0px 1px rgba(194, 194, 194, 1);
    }

    .content {
        background-color: #faf9f9;
    }

    .accept {
        background-color: white;
    }

    .question-item {
        padding: 12px 16px 12px 24px;
        border-bottom: 1px solid rgba(0, 0, 0, .1);
        background-color: #fff;
        -webkit-transition: background-color .1s;
        -o-transition: background-color .1s;
        transition: background-color .1s;
    }

    .main-reply-item {
        padding: 12px 16px 12px 16px;
        border-bottom: 1px solid rgba(0, 0, 0, .1);
        background-color: #fff;
        -webkit-transition: background-color .1s;
        -o-transition: background-color .1s;
        transition: background-color .1s;
    }

    .reply-item {
        padding: 12px 16px 12px 24px;
        border-bottom: 1px solid rgba(0, 0, 0, .1);
        background-color: #fff;
        -webkit-transition: background-color .1s;
        -o-transition: background-color .1s;
        transition: background-color .1s;
    }

    /* Button CSS */

    .reply-btn {
        background: white;
        border: none;
        cursor: pointer;
        color: gray;
    }

    .expan {
        font-size: 1.4em;
        background: white;
        border: none;
        cursor: pointer;
        color: gray;
    }

    /* Dropdown CSS */
    .dropdown-menu {
        left: -70px !important;
    }

    .item-action {
        width: 100%;
        background: white;
        border: none;
        cursor: pointer;
    }

    /* Modal CSS */
    .modal-content {
        width: 40em !important;
        position: absolute;
        top: 20em;
    }

    .footer {
        padding: 16px 16px 12px 24px;
    }

    /* Moderator CSS */

    .question-item:hover {
        background: lightgray;
        transition: lightgray 1s;
    }

    .check-question {
        display: none;
        position: absolute;
        right: 5%;
        top: 2%;
        font-size: 2em;
    }

    .question-item:hover .check-question {
        display: block;
    }

    .check-question i:hover {
        color: darkgreen !important;
    }

    /* Live CSS */

    .question-item:hover .reply-btn {
        background: lightgray;
    }

    .delete-item {
        color: gray;
        font-size: 1.5em;
    }

    .question-item:hover .delete-item {
        background: lightgray;
    }

    /* Left Action */

    .left-action {
        float: left;
        font-size: 1.2em
    }

    .left-action i {
        margin-right: 1em;
    }

    /* Up Question */

    .up-question {
        display: none;
        position: absolute;
        right: 6%;
        top: 2%;
        font-size: 2em;
    }

    .up-question i {
        color: #38c172;
    }

    .question-item:hover .up-question {
        display: block;
    }

    .up-question i:hover {
        color: darkgreen !important;
    }
</style>
@section('content')
<div class="container">
    <div class="row main-panel">
        <div class="col-6 flex">
            <div class="title-part">
                Incoming
            </div>
            <div class="flex-item">
                Moderation
            </div>
        </div>
        <div class="col-6 title-part">Live</div>
    </div>
    <div class="row question">
        <div class="col-6">
            <div class="content">
                @foreach($question as $key => $value)
                @if($value->status == 1)
                <div class="question-item">
                    <div>Question: {{$value->content}} by {{$value->user_name}}</div>
                    <div>ID: {{$value->id}} by {{$value->user_name}}</div>
                    <div class="check-question">
                        <a href="/room/question/accept/{{$value->id}}"><i class="fa fa-check-circle-o text-success" aria-hidden="true"></i></a>
                        <a href="/room/question/denied/{{$value->id}}"><i class="fa fa-times-circle-o text-success" aria-hidden="true"></i></a>
                    </div>
                </div>

                @endif
                @endforeach
            </div>
        </div>
        <div class="col-6">
            <div class="accept">
                @foreach($question as $key => $value)
                @if($value->status == 1)
                <div class="question-item">
                    <div>{{$value->content}}</div>
                    <div>{{$value->user_name}}</div>
                    <div style="display: flex; justify-content: space-between;">
                        <div class="left-action">
                            <a href=""><i class="fa fa-star-o text-warning" aria-hidden="true"></i></a>
                            <a href=""><i class="fa fa-thumbs-o-up text-primary" aria-hidden="true"></i></a>
                        </div>
                        <div style="float:right; display: flex">
                            <div style="margin-right:1em">
                                <button class="reply-btn" type="button" data-id="{{$value->id}}" data-toggle="modal" data-target="#reply"><i class="fa fa-reply" aria-hidden="true"></i>Trả lời</button>
                            </div>
                            <div>
                                <button class="item-action delete-item" data-toggle="modal" data-target="#deleteQuestion" data-id="{{$value->id}}" data-name="{{$value->content}}">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="up-question">
                        <a href=""><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i></a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteQuestion" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xóa câu hỏi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post">
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Bạn có thật sự muốn xóa câu hỏi: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="dl_question_name" name="dl_question_name" placeholder="Question Name" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="delete">Xóa</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
<!-- End modal delete -->

<!-- Modal For Reply Quest -->
<div class="modal fade" id="reply" tabindex="-1" role="dialog" aria-labelledby="reply" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Các câu trả lời</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="">
                @foreach($question as $key => $value)
                @if($value->status == 1)
                <div class="main-reply-item">
                    <div>{{$value->content}}</div>
                    <div>{{$value->user_name}}</div>
                    <div style="display: flex; justify-content: space-between;">
                        <div style="float:left;padding-top:0.5em">
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                        <div style="float:right; display: flex">
                            <div>
                                <button class="item-action delete-item" data-toggle="modal" data-target="#deleteQuestion" data-id="{{$value->id}}" data-name="{{$value->content}}">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                <div class="reply-item">
                    <div>ABCD</div>
                    <div>ABC</div>
                    <div style="display: flex; justify-content: space-between;">
                        <div style="float:left;padding-top:0.5em">
                        </div>
                        <div style="float:right; display: flex">
                            <div>
                                <button class="item-action delete-item" data-toggle="modal" data-target="#deleteQuestion" data-id="{{$value->id}}" data-name="{{$value->content}}">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer" style="display: flex;justify-content: space-between;">
                <div style="display: flex;">
                    <div>
                        <i class="fa fa-user-circle-o" aria-hidden="true" style="font-size: 2em; padding-top: 0.3em;padding-right: 0.5em;"></i>
                    </div>
                    <div>
                        <input placeholder="Câu trả lời của bạn" class="w3-input" type="text" style="width: 30em;">
                    </div>
                </div>
                <div style="float: right;">
                    <i class="fa fa-paper-plane" aria-hidden="true" style="font-size: 1.5em;padding-top: 0.5em;"></i>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection