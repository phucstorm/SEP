@extends('layouts.eventlayout')
@push('head')
<!-- Scripts -->
<script src="{{ asset('js/host-poll.js') }}" defer></script>
@endpush


@section('content')
<div class="container">
    <div class="create-poll mt-3 mb-3">
        <button class="btn btn-success create-poll-btn" data-toggle="modal" data-target="#createPollModal">{{ trans('message.create-poll') }}</button>
    </div>
    <div class="row">
        <div class="poll-section col-md-6 col-sm-12">
            <span>{{ trans('message.poll-list') }}</span>
            <div class="poll-container poll-list">

            </div>
        </div>
        <div class="poll-section col-md-6 col-sm-12">
            <span>{{ trans('message.live') }}</span>
            <div class="poll-container poll-live position-relative p-3">
                
                @if($event->polls()->where('status',1)->first()!=[])
                    @php $runningPoll = $event->polls()->where('status',1)->first(); @endphp
                    <span class="position-absolute voted-person">
                    <!-- total votes -->
                    </span>

                    <div class="poll-title p-2">
                    <!-- running poll content -->
                    </div>
                    <div class="poll-result">

                    </div>
                @else
                    {{ trans('message.no-poll-running') }}
                @endif
            </div>
        </div>
    </div>
    <!-- Create Poll Modal -->
         
    <div class="modal fade" id="createPollModal" role="dialog">
        <div class="modal-dialog">
        
        <!-- Modal content-->
        <div class="modal-content">
            <form action="/admin/event/poll/create" class="create-poll-form" enctype="multipart/form-data" method="post">
                @csrf
                <input type="text" name="event-id" value="{{$event->id}}" hidden>
                <div class="modal-header">
                <h4 class="modal-title">{{ trans('message.create-poll') }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-10 offset-1">     
                                <input type="text" name="event_id" value="{{ $event->id }}" hidden>                  
                                <div class="form-group row">
                                    <label for="poll_question_content">{{ trans('message.poll-content') }}</label>
                                    <input id="poll_question_content" 
                                        type="text" 
                                        class="form-control @error('poll_question_content') is-invalid @enderror" 
                                        name="poll_question_content" 
                                        value="{{ old('poll_question_content') }}" 
                                        autocomplete="poll_question_content" 
                                        autofocus required maxlength="200">
                                    @error('poll_question_content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row poll-answer">
                                    <label for="poll_answer">{{ trans('message.poll-answer') }}</label>
                                    <input id="poll_answer" 
                                        type="text" 
                                        class="form-control @error('poll_answer') is-invalid @enderror" 
                                        name="poll_answer[]" 
                                        value="{{ old('poll_answer') }}" 
                                        autocomplete="poll_answer" 
                                        autofocus required maxlength="160">
                                    @error('poll_answer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <input id="poll_answer" 
                                        type="text" 
                                        class="form-control @error('poll_answer') is-invalid @enderror mt-2" 
                                        name="poll_answer[]" 
                                        value="{{ old('poll_answer') }}" 
                                        autocomplete="poll_answer" 
                                        autofocus required maxlength="160">
                                    @error('poll_answer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group-row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <button type="button" class="btn plus-answer w-100 add-answer">
                                        <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('message.answer-btn') }}
                                    </button>
                                </div>
                                <div class="form-group row">
                                    <label class='multiple-answer-label' for='multiple-answer'>
                                        <input id='multiple-answer' name='mul_choice' type='checkbox' value='1' />
                                        {{ trans('message.multiple-answer-check') }}
                                    </label>
                                </div>
                                <div class="text-danger error-create-poll"></div>
                            </div>
                        </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('message.cancel-btn') }}</button>
                        <button type="button" id="create-poll" class="btn btn-success">{{ trans('message.save-btn') }}</button>
                    </div>
                </form>
            </div>   
        </div>
    </div>    
</div>

<!-- Edit Poll Modal -->
    
<div class="modal fade" id="editPoll" role="dialog">
    <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
        <form action="" class="edit-poll-form" enctype="multipart/form-data" method="post">
        @csrf
        <input type="text" id="upoll-id" hidden>
        <div class="modal-header">
        <h4 class="modal-title">{{ trans('message.edit-poll') }}</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body">

                <div class="row">
                    <div class="col-10 offset-1">     
                        <input type="text" name="event_id" value="{{ $event->id }}" hidden>                  
                        <div class="form-group row">
                            <label for="poll_question_content">{{ trans('message.poll-content') }}</label>
                            <input id="poll-content-input" 
                                type="text" 
                                class="form-control" 
                                name="poll_question_content" 
                                value="" 
                                autocomplete="poll_question_content" 
                                required>
                            @error('poll_question_content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row poll-answer poll-answer-list">
                            <label for="poll_answer">{{ trans('message.poll-answer') }}</label>
                            <div class="w-100 position-relative single-answer">
                    
                            </div>
                        </div>
                        <div class="form-group-row">
                            <label class="col-sm-3 col-form-label"></label>
                            <button type="button" class="btn plus-new-answer w-100 add-answer">
                                <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('message.answer-btn') }}
                            </button>
                        </div>
                        <div class="form-group row">
                            <label class='multiple-answer-label' for='multiple-answer'>
                                <input id='multiple-answer-edit' name='multi_choice' type='checkbox' value='1'
                                
                                />
                                {{ trans('message.multiple-answer-check') }}
                            </label>
                        </div>
                        <div class="text-danger error-update-poll"></div>

                    </div>
                </div>
                
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('message.cancel-btn') }}</button>
                <button type="button" class="btn btn-success update-poll" >{{ trans('message.save-btn') }}</button>
            </div>
            </form>
        </div>
    
    </div>
</div>  

    <!-- Modal For Delete Poll -->
    <div class="modal fade" id="deletePollModal" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action=""  enctype="multipart/form-data" method="post">
            @csrf
            <input type="text" id="dpoll-id" hidden>
            <div class="modal-header">
                <h4 class="modal-title" id="delete-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ trans('message.message-del-poll') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{ trans('message.cancel-btn') }}</button>
                <button type="button" class="btn btn-danger" id="deletePoll">{{ trans('message.delete-btn') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
//get poll
getPolls = function(){
    $.ajax({
        url: '/admin/getpoll/'+$('#this-event-id').val(),
        success: function(data){
            $('.poll-list').html('')
            for (var i=0; i<data[0].length; i++){
                $('.poll-list').append(
                    '<div class="poll-item p-3 d-flex justify-content-between">'+
                        '<div class="poll-detail">'+
                            '<div style="opacity: 0.5">'+
                                (data[0][i].multiple == 0 ? '{{trans('message.singlechoice')}}' : '{{trans('message.multiplechoice')}}')+
                            '</div>'+
                            '<div class="poll-votes">{{ trans('message.votes') }}: '+data[0][i].votes+'</div>'+
                            '<div class="poll-content">'+data[0][i].content+'</div>'+
                        '</div>'+
                        '<div class="poll-action">'+
                            (data[0][i].status == 1 ? 
                            '<button class="stop-poll-btn update-status-btn" data-id="'+data[0][i].id+'" data-status="'+data[0][i].status+'">'+
                                '<i class="fa fa-stop-circle" aria-hidden="true"></i>'+
                            '</button>' : 
                            '<button class="play-poll-btn update-status-btn" data-id="'+data[0][i].id+'" data-status="'+data[0][i].status+'">'+
                                '<i class="fa fa-play-circle" aria-hidden="true"></i>'+
                            '</button>')+
                            '<button type="button" class="btn edit-poll-btn edit-poll-button" value="'+data[0][i].id+'" data-name="'+data[0][i].content+'" data-mulcheck="'+data[0][i].multiple+'" data-toggle="modal" data-target="#editPoll">'+
                                '<i class="fa fa-edit"></i>'+
                            '</button>'+
                            
                            '<button class="delete-poll-btn" data-id="'+data[0][i].id+'" data-content="'+data[0][i].content+'" data-toggle="modal" data-target="#deletePollModal">'+
                                '<i class="fa fa-trash"></i>'+
                            '</button>'+
                            
                        '</div>'+
                    '</div>'  
                )
                if(data[0][i].status==1){
                    $('.voted-person').html(
                        data[0][i].votes+ ' <i class="fa fa-user" aria-hidden="true"></i>'
                    )
                    $('.poll-live .poll-title').html(data[0][i].content)
                }
            }
            if(data[1].length>=2){
                $('.poll-result').html('')
                var sum=0;
                for (var i=0; i<data[1].length; i++){
                    sum+=data[1][i].votes;
                }
                if(sum > 0){
                    for (var i=0; i<data[1].length; i++){
                        $('.poll-result').append(
                            '<div class="poll-result-item p-1">'+
                                '<div class="poll-result-answer">'+
                                    ''+data[1][i].content+' <span class="votes">('+data[1][i].votes+')</span>'+
                                '</div>'+
                                '<div class="result-bar">'+
                                    '<span class="poll-result-bar" data-width="'+(data[1][i].votes/sum)*90+'%"></span>'+
                                    '<span class="percent">'+(Math.round((data[1][i].votes/sum)*100))+'%</span>'+
                                '</div>'+
                            '</div>'
                        )
                    }
                }else{
                    for (var i=0; i<data[1].length; i++){
                        $('.poll-result').append(
                            '<div class="poll-result-item p-1">'+
                                '<div class="poll-result-answer">'+
                                    ''+data[1][i].content+' <span class="votes">(0)</span>'+
                                '</div>'+
                                '<div class="result-bar">'+
                                    '<span class="poll-result-bar" data-width="0%"></span>'+
                                    '<span class="percent">0%</span>'+
                                '</div>'+
                            '</div>'
                        )
                    }
                }
            }else{
                $('.poll-result').html('')
                $('.voted-person').html(
                    '0 <i class="fa fa-user" aria-hidden="true"></i>'
                )
                $('.poll-live .poll-title').html('There is no poll running right now!')
            }

            getPollAnswers();
            deletePoll();
            updateStatus();
            pollResult();
        },error: function(data){
            alert('fail '+data[1].content)
        }
    })
}
</script>
@endsection