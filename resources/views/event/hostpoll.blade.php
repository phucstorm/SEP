@extends('layouts.eventlayout')
@push('head')
<!-- Scripts -->
<script src="{{ asset('js/host-poll.js') }}" defer></script>
@endpush


@section('content')
<div class="container">
    <div class="create-poll mt-3 mb-3">
        <button class="btn btn-success create-poll-btn" data-toggle="modal" data-target="#createPollModal">Create Poll</button>
    </div>
    <div class="row">
        <div class="poll-section col-md-6 col-sm-12">
            <div class="poll-container">
                @foreach ($event->polls as $poll)
                    <div class="poll-item p-3 d-flex justify-content-between">
                        <div class="poll-detail">
                            <div style="opacity: 0.5">
                                @if($poll->mul_choice == 1)    
                                    Multiple Choice
                                @else
                                    Single Choice
                                @endif
                            </div>
                            <div class="poll-votes">Votes: {{ $poll->total_votes }}</div>
                            <div class="poll-content">{{ $poll->poll_question_content }}</div>
                        </div>
                        <div class="poll-action">
                            <form action="/admin/event/poll/status/{{$poll->id}}"  enctype="multipart/form-data" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="text" name="event_id" value="{{ $event->id }}" hidden>                  

                                @if($poll->status==1)
                                    <input type="text" name="status-poll" value="stop" hidden>
                                    <button class="stop-poll-btn">
                                        <i class="fa fa-stop-circle" aria-hidden="true"></i>
                                    </button>
                                @else
                                    <input type="text" name="status-poll" value="play" hidden>
                                    <button class="play-poll-btn">
                                        <i class="fa fa-play-circle" aria-hidden="true"></i>
                                    </button>
                                @endif
                            </form>
                            <button type="button" class="btn edit-poll-btn" data-toggle="modal" data-target="#edit{{$poll->id}}">
                                <i class="fa fa-edit"></i>
                            </button>
                            
                            <button class="delete-poll-btn" data-id="{{$poll->id}}" data-toggle="modal" data-target="#deletePol{{$poll->id}}">
                                <i class="fa fa-trash"></i>
                            </button>
                            
                        </div>
                    </div>  
                        <!-- Modal For Delete Poll -->
                    <div class="modal fade" id="deletePol{{$poll->id}}" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form action="/admin/event/poll/delete/{{$poll->id}}"  enctype="multipart/form-data" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="modal-header">
                                    <h4 class="modal-title" id="delete_title">{{$poll->poll_question_content}}</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure that you want to delete this poll?

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-danger" id="del">Delete</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Poll Modal -->
                        
                    <div class="modal fade" id="edit{{$poll->id}}" role="dialog">
                        <div class="modal-dialog">
                        
                        <!-- Modal content-->
                        <div class="modal-content">
                            <form action="/admin/event/poll/edit/{{$poll->id}}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="modal-header">
                            <h4 class="modal-title">Edit Poll</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                            </div>
                            <div class="modal-body">

                                    <div class="row">
                                        <div class="col-10 offset-1">     
                                            <input type="text" name="event_id" value="{{ $event->id }}" hidden>                  
                                            <div class="form-group row">
                                                <label for="poll_question_content">Poll Content</label>
                                                <input id="poll_question_content" 
                                                    type="text" 
                                                    class="form-control @error('poll_question_content') is-invalid @enderror" 
                                                    name="poll_question_content" 
                                                    value="{{$poll->poll_question_content}}" 
                                                    autocomplete="poll_question_content" 
                                                    autofocus required>
                                                @error('poll_question_content')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group row poll-answer">
                                                <label for="poll_answer">Poll Answer</label>
                                                @foreach ($poll->answers as $answer)
                                                <div class="w-100 position-relative">
                                                <input id="poll_answer" 
                                                    type="text" 
                                                    class="form-control @error('poll_answer') is-invalid @enderror mt-2" 
                                                    name="poll_answer[{{$answer->id}}]" 
                                                    value="{{$answer -> poll_answer_content}}" 
                                                    autocomplete="poll_answer" 
                                                    autofocus required>
                                                    <button type="button" class="delete-poll-answer-btn"><i class="fa fa-trash"></i></button>
                                                </div>
                                                @endforeach
                                            </div>
                                            <div class="form-group-row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <button type="button" class="btn plus-new-answer w-100 add-answer">
                                                    <i class="fa fa-plus" aria-hidden="true"></i> Answer
                                                </button>
                                            </div>
                                            <div class="form-group row">
                                                <label class='multiple-answer-label' for='multiple-answer'>
                                                    <input id='multiple-answer' name='mul_choice' type='checkbox' value='1' 
                                                    @if($poll->mul_choice==1)
                                                    checked
                                                    @endif
                                                    />
                                                    Multiple Answers
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    
                                
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button class="btn btn-success">Save</button>
                                </div>
                                </form>
                            </div>
                        
                        </div>
                    </div>      
                @endforeach
            </div>
        </div>
        <div class="poll-section col-md-6 col-sm-12">
            <div class="poll-container p-3">
                @if($event->polls()->where('status',1)->first()!=[])
                    @php $runningPoll = $event->polls()->where('status',1)->first(); @endphp
                    <div class="poll-title p-2">
                    {{$runningPoll->poll_question_content}}
                    </div>
                    <div class="poll-result">
                    @php
                        $sum=0;
                        foreach($runningPoll->answers as $answer){
                            $sum+=$answer->votes;
                        }
                    @endphp
                    @if($sum!=0)
                        @foreach($runningPoll->answers as $answer)
                            <div class="poll-result-item p-1">
                                <div class="poll-result-answer">
                                    {{$answer->poll_answer_content}} <span class="percent">({{round(($answer->votes/$sum)*100)}}%)</span>
                                </div>
                                <!-- width là (số lượt vote answers/tổng số vote) * 100 -->
                                <div class="poll-result-bar" data-width="{{($answer->votes/$sum)*100}}%"></div>
                            </div>
                        @endforeach
                    @else
                        @foreach($runningPoll->answers as $answer)
                            <div class="poll-result-item p-3">
                                <div class="poll-result-answer">
                                    {{$answer->poll_answer_content}} <span class="percent">(0%)</span>
                                </div>
                                <!-- width là (số lượt vote answers/tổng số vote) * 100 -->
                                <div class="poll-result-bar" data-width="0%"></div>
                            </div>
                        @endforeach
                    @endif
                    </div>
                @else
                    There is no poll running now!
                @endif
            </div>
        </div>
    </div>
    <!-- Create Poll Modal -->
         
    <div class="modal fade" id="createPollModal" role="dialog">
        <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <form action="/admin/event/poll/create" enctype="multipart/form-data" method="post">
                @csrf
                <div class="modal-header">
                <h4 class="modal-title">Create Poll</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-10 offset-1">     
                                <input type="text" name="event_id" value="{{ $event->id }}" hidden>                  
                                <div class="form-group row">
                                    <label for="poll_question_content">Poll Content</label>
                                    <input id="poll_question_content" 
                                        type="text" 
                                        class="form-control @error('poll_question_content') is-invalid @enderror" 
                                        name="poll_question_content" 
                                        value="{{ old('poll_question_content') }}" 
                                        autocomplete="poll_question_content" 
                                        autofocus required>
                                    @error('poll_question_content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row poll-answer">
                                    <label for="poll_answer">Poll Answer</label>
                                    <input id="poll_answer" 
                                        type="text" 
                                        class="form-control @error('poll_answer') is-invalid @enderror" 
                                        name="poll_answer[]" 
                                        value="{{ old('poll_answer') }}" 
                                        autocomplete="poll_answer" 
                                        autofocus required>
                                    @error('poll_answer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group-row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <button type="button" class="btn plus-answer w-100 add-answer">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Answer
                                    </button>
                                </div>
                                <div class="form-group row">
                                    <label class='multiple-answer-label' for='multiple-answer'>
                                        <input id='multiple-answer' name='mul_choice' type='checkbox' value='1' />
                                        Multiple Answers
                                    </label>
                                </div>
                            </div>
                        </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>   
        </div>
    </div>    
</div>
@endsection