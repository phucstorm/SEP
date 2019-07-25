@extends('layouts.eventlayout')
@push('head')
<!-- Scripts -->
<script src="{{ asset('js/host-poll.js') }}" defer></script>
@endpush


@section('content')
<div class="container">
    <div class="question-nav">
        <div class="title-part live">Live</div>
        <div class="title-part incoming">List</div>
    </div>
    <div class="row question">
        <div class="question-item-reviewing">
            <div class="moderation-title">
                <div class="title-part">
                    List
                </div>
                <div class="flex-item">
                    <button class="create-poll-btn" data-toggle="modal" data-target="#createPoll">Create Poll</button>
                </div>
            </div>
            <div class="content">
            @if($poll != '[]')
                @foreach($poll as $key => $value)
                    <div class="poll-item">
                    <div class="poll-detail">
                        <div style="opacity: 0.5">
                        @if($value->mul_choice == 1)    
                            Multiple Choice
                        @else
                            One Choice
                        @endif
                        </div>
                        <div>
                       Votes : @foreach ($vote_answer as $key => $item)
                       @if($item->poll_question_id == $value->id)
                       {{ $item->sum_votes}}
                       @endif
                       @endforeach
                        
                        </div>
                        <div>
                           {{$value->poll_question_content}}
                        </div>
                    </div>
                    <div class="poll-action">
                        <button class="play-poll-btn"><i class="fa fa fa-play-circle" aria-hidden="true"></i></button>
                        <button class="edit-poll-btn" data-toggle="modal" data-target="#editPoll-{{$value->id}}"><i class="fa fa-edit"></i></button>
                        <button class="delete-poll-btn" data-id="{{$value->id}}" data-toggle="modal" data-target="#deletePoll"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <!-- Modal For Edit Poll -->
<div class="modal fade" id="editPoll-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Edit Poll - {{$value->id}}</h5>

            </div>

            <div class="modal-body">
                <form role="form" method="post" id="form-poll-edit">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Question</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="poll-name" name="poll-name" value="{{$value->poll_question_content}}" required>
                            <input type="text" class="form-control" id="event_id" name="event_id" value="{{$event->id}}" hidden>
                            <input type="text" class="form-control" id="poll_id" name="poll_id" value="{{$value->id}}" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Answer</label>
                        <div class="col-sm-8 poll-answers">
                            <div>
                            @foreach($answer as $key => $item)
                                @if($item->poll_question_id == $value->id)
                                <input type="text" class="form-control" id="poll-answer" name="poll-answer" placeholder="Answer" value="{{$item->poll_answer_content}}" required>
                                @endif
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group-row">
                        <label class="col-sm-3 col-form-label"></label>
                        <button class="col-sm-8 plus-answer">
                            <i class="fa fa-plus" aria-hidden="true"></i> Answer
                        </button>
                    </div>
                    <div class="form-group row">
                        <label class='multiple-answer-label' for='multiple-answer'>
                            <input id='multiple-answer' name='multiple-answer' type='checkbox' value='multiple-answer' />
                            Multiple Answers
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" id="edit-poll">Edit Poll</button>
            </div>
        </div>
    </div>
</div>         
                @endforeach
            @endif
            </div>
        </div>
        <div class="question-item-accepted">
            <div class="title-part">Live</div>
            <div class="accept">
            @if($live_question != '[]')
                <div class="poll-item">
                    <div class="poll-title">
                        {{$title}}
                    </div>
                </div>
                <div class="poll-selected">
                    @foreach($live_answer as $key => $item)
                    <div class="poll-answer">
                        {{$item->poll_answer_content}} <span class="poll-votes">({{$item->votes}})</span>
                    </div>
                    <div class="poll-bar" style="display: flex;">
                        <div class="poll-fill" style="width: 50%;">
                        </div>
                        <div class="poll-value">
                        @if($sum_votes != 0)
                            {{round(($item->votes/$sum_votes)*100,2)}} %
                        @else
                            0 %
                        @endif
                        </div>
                    </div>
                    @endforeach
                    <!-- <div class="poll-answer">
                        Eating <span class="poll-votes">(101)</span>
                    </div>
                    <div class="poll-bar" style="display: flex;">
                        <div class="poll-fill" style="width: 100%;">
                        </div>
                        <div class="poll-value">
                            50%
                        </div>
                    </div>
                    <div class="poll-answer">
                        Playing <span class="poll-votes">(50)</span>
                    </div>
                    <div class="poll-bar" style="display: flex;">
                        <div class="poll-fill" style="width: 50%;">
                        </div>
                        <div class="poll-value">
                            50%
                        </div>
                    </div> -->

                </div>
            @endif
            </div>
            
        </div>
    </div>
</div>
    <!-- Modal For Create Poll -->
    <div class="modal fade" id="createPoll" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Create Poll</h5>

                </div>
                <div class="modal-body">
                    <form role="form" method="post" id="form-poll-create">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Question</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="poll_name" name="poll_name"
                                    placeholder="Poll Question" required>
                                <input type="text" class="form-control" id="event_id" name="event_id" value="{{$event->id}}" hidden>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Answer</label>
                            <div class="col-sm-8 poll-answers">
                                <div>
                                <input type="text" class="form-control" id="poll_answer" name="poll_answer"
                                    placeholder="Answer" required>
                                    <input type="text" class="form-control" id="poll_answer" name="poll_answer"
                                    placeholder="Answer" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group-row">
                            <label class="col-sm-3 col-form-label"></label>
                            <button class="col-sm-8 plus-answer">
                                <i class="fa fa-plus" aria-hidden="true"></i> Answer
                            </button>
                        </div>                       
                        <div class="form-group row">
                            <label class='multiple-answer-label' for='multiple-answer'>
                            <input  id='multiple-answer'
                                    name='multiple-answer'
                                    type='checkbox'
                                    value='multiple-answer'/>
                            Multiple Answers
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" id="add-poll">Create Poll</button>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Modal For Delete Poll -->
<div class="modal fade" id="deletePoll" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Poll</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post">
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">Do you really want to delete it? </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="delete-poll">Xóa</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>
</main>
@endsection