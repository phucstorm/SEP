@extends('layouts.eventlayout')
@push('head')
<!-- Scripts -->
<script src="{{ asset('js/host-question.js') }}" defer></script>
@endpush
@section('content')
<div class="container">
    <div class="question-nav">
        <div class="title-part live">Live</div>
        <div class="title-part incoming">Incoming</div>
    </div>
    <div class="row question">
        <div class="question-item-reviewing">
            <div class="moderation-title">
                <div class="title-part">
                    Incoming
                </div>
                <div class="flex-item">
                    Moderation
                </div>
            </div>
            <div class="content">
                @foreach($question as $key => $value)
                @if($value->status == 0)
                <div class="question-item">
                    <div class="question-username"><i class="fa fa-user"></i> {{$value->user_name}}</div>
                    <div class="question-date">{{$value->created_at}}</div>
                    <div class="question-content">{{$value->content}}</div>
                    <div class="check-question">
                        <a href="/room/question/accept/{{$value->id}}"><i class="fa fa-check-circle-o text-success"
                                aria-hidden="true"></i></a>
                        <a href="/room/question/denied/{{$value->id}}"><i class="fa fa-times-circle-o text-success"
                                aria-hidden="true"></i></a>
                    </div>
                </div>

                @endif
                @endforeach
            </div>
        </div>
        <div class="question-item-accepted">
            <div class="title-part">Live</div>
            <div class="accept">
                @foreach($question as $key => $value)
                @if($value->status == 1)
                <div class="question-item">
                    <div class="question-like"><button class="like-btn" value="{{$value->id}}">{{$value->like}} <i
                                class="fa fa-thumbs-up"></i></button>
                                <button class="dislike-btn" value="{{$value->id}}">{{$value->like}} <i class="fa fa-thumbs-down" aria-hidden="true"></i></button></div>
                    <div class="question-username"><i class="fa fa-user"></i> {{$value->user_name}} </div>
                    <div class="question-date">{{$value->created_at}}</div>
                    <div class="question-content">{{$value->content}}</div>
                    <div style="display: flex; justify-content: space-between;">
                        <div class="left-action">

                        </div>
                        <div style="float:right; display: flex">
                            <div style="margin-right:1em">
                                <button class="reply-btn" type="button" data-id="{{$value->id}}"
                                    data-content="{{$value->content}}" data-toggle="modal" data-target="#reply"><i
                                        class="fa fa-reply" aria-hidden="true"></i>Reply</button>
                            </div>

                        </div>
                    </div>
                    <div class="delete-question-btn">
                        <button class="item-action delete-item" data-toggle="modal" data-target="#delete_question"
                            data-id="{{$value->id}}">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                @endif
                @endforeach
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
                                Would you like to permanently delete this question?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="del_ques">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal For Reply Quest -->
                <div class="modal fade" id="reply" tabindex="-1" role="dialog" aria-labelledby="reply"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="">
                                @foreach($result as $key => $item)
                                <div class="reply-item">
                                    <div class="user"><i class="fa fa-user"></i> {{Auth::user()->email}} -
                                        {{$value->id}}</div>
                                    <div>{{$item->rep_content}}</div>
                                    <div class="delete-question-btn">
                                        <button class="item-action delete-item delete-answer" data-toggle="modal"
                                            data-target="#deleteQuestion">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                            <div class="footer">
                                <textarea placeholder="Type your answer here..." class="input-answer"
                                    type="text"></textarea>

                                <button class="reply-btn send-reply-btn" type="submit"><i class="fa fa-paper-plane"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

@endsection
