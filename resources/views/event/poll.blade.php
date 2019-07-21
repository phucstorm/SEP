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
                <div class="poll-item">
                    <div class="poll-detail">
                        <div style="opacity: 0.5">
                            Multiple Choice
                        </div>
                        <div>
                            Vote: 2
                        </div>
                        <div>
                            Do you like it?
                        </div>
                    </div>
                    <div class="poll-action">
                        <button class="play-poll-btn"><i class="fa fa fa-play-circle" aria-hidden="true"></i></button>
                        <button class="edit-poll-btn" data-toggle="modal" data-target="#editPoll"><i class="fa fa-edit"></i></button>
                        <button class="delete-poll-btn" data-toggle="modal" data-target="#deletePoll"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div class="poll-item">
                    <div class="poll-detail">
                        <div style="opacity: 0.5">
                            Multiple Choice
                        </div>
                        <div>
                            Vote: 2
                        </div>
                        <div>
                            Do you like it?
                        </div>
                    </div>
                    <div class="poll-action">
                        <button class="stop-poll-btn"><i class="fa fa-stop-circle" aria-hidden="true"></i></button>
                        <button class="edit-poll-btn" data-toggle="modal" data-target="#editPoll"><i class="fa fa-edit"></i></button>
                        <button class="delete-poll-btn" data-toggle="modal" data-target="#deletePoll"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="question-item-accepted">
            <div class="title-part">Live</div>
            <div class="accept">
                <div class="poll-item">
                    <div class="poll-title">
                        Do you like it?
                    </div>
                </div>
                <div class="poll-selected">
                    <div class="poll-answer">
                        Drinking <span class="poll-votes">(0)</span>
                    </div>
                    <div class="poll-bar" style="display: flex;">
                        <div class="poll-fill" style="width: 1em;">
                        </div>
                        <div class="poll-value">
                            0%
                        </div>
                    </div>
                    <div class="poll-answer">
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
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal For Creat Poll -->
    <div class="modal fade" id="createPoll" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Create Poll</h5>

                </div>
                <div class="modal-body">
                    <form role="form" method="post">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Question</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="poll-name" name="poll_name"
                                    placeholder="Poll Question" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Answer</label>
                            <div class="col-sm-8 poll-answers">
                                <div>
                                <input type="text" class="form-control" id="poll-answer" name="poll-answer"
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
                    <button type="submit" class="btn btn-success" id="add">Create Poll</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection