@extends('layouts.eventlayout')
@push('head')
<!-- Scripts -->
<script src="{{ asset('js/host-question.js') }}" defer></script>
@endpush
@section('content')
<input id="this-event-id" value="{{$event->id}}" hidden>
<div class="container">
    <div class="question-nav">
        <div class="title-part live">{{ trans('message.live') }}</div>
        <div class="title-part incoming">{{ trans('message.incoming') }}</div>
    </div>
    <div class="row question">
        <div class="question-item-reviewing">
            <div class="moderation-title">
                <div class="title-part">
                {{ trans('message.incoming') }}
                </div>
                <div class="flex-item">
                    @if($event->setting_moderation==1)
                        {{ trans('message.moderation-on') }}
                    @else
                        {{ trans('message.moderation-off') }}
                    @endif
                
                </div>
            </div>
            <div class="content">
            
            
            </div>
        </div>
        <div class="question-item-accepted">
            <div class="title-part d-flex justify-content-between">
                <div>{{ trans('message.live') }}</div>
                <div class="d-flex justify-content-center">
                    <div class="sort-item is-selected recent-btn mr-3">Recent</div>
                    <div class="sort-item popular-btn">Popular</div>
                </div>
                <div>{{$count}} {{ trans('message.questions') }}</div>
            </div>
            <div class="accept">
            
                
            </div>
        </div>
    </div>
</div>
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
                            {{ trans('message.message-del-question') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">{{ trans('message.cancel-btn') }}</button>
                                <button type="button" class="btn btn-danger" id="del_ques">{{ trans('message.delete-btn') }}</button>
                            </div>
                        </div>
                    </div>
                </div>


                                <!-- Modal For Reply Quest -->
                                <div class="modal fade reply-modal" id="replyQuestion" tabindex="-1" role="dialog" aria-labelledby="reply"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="/room/reply/" class="reply-form" enctype="multipart/form-data" method="post">
                                                @csrf
                                                <input type="text" id="questionIdInput" name="question-id" hidden>

                                                <input type="text" name="username" value="{{ Auth::user()->name }}" hidden>
                                                <input type="text" name="userid" value="{{ Auth::user()->id }}" hidden>
                                                <div class="modal-header">
                                                    <h5 class="modal-title question-reply-title" id="title"></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body modal-reply">
                                                  
                                                </div>
                                                <div class="footer">
                                                        <textarea placeholder="{{ trans('message.type-your-answer') }}" name="reply" class="input-answer"
                                                        type="text" required maxlength="300"></textarea>
                                                        <button class="reply-btn send-reply-btn" type="submit"><i class="fa fa-paper-plane"
                                                        aria-hidden="true"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
<script>

</script>
</main>

@endsection
