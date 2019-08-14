@extends('layouts.app')

@section('content')
<main class="main">
    <div class="container">
        <div class="create-event-btn">
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createEvent"
                id="create-event-btn">
                {{ trans('message.create-event') }}
            </button>
        </div>
        {{ csrf_field() }}
        @if($event == '[]' && isset($_GET['search']))
        <div>{{ trans('message.noresult-found') }}</div>
        @else
        @foreach($event as $value)
        <!-- dẫn link event-container vô room -->
        <div class="event-container">
            <div class="event-short-info" onclick="window.location.href='/admin/event/{{$value->event_code}}'">
                <div class="event-icon"></div>
                <div class="event-namecode">
                    <div class="event-name"><i class="fa fa-calendar" aria-hidden="true"></i><a
                            href="/admin/event/{{$value->event_code}}">{{$value->event_name}}</a></div>
                    <div class="event-code">#{{$value->event_code}}</div>
                </div>
                <div class="event-description mb-2">{{ $value->event_description }}</div>
                <div class="event-startend-date">
                <span class="time">{{Carbon\Carbon::parse($value->start_date)->format('h:iA')}}</span>
                        <span class="date">{{Carbon\Carbon::parse($value->start_date)->format('dM Y')}}</span> - 
                        <span class="time">{{Carbon\Carbon::parse($value->end_date)->format('h:iA')}}</span>
                        <span class="date">{{Carbon\Carbon::parse($value->end_date)->format('dM Y')}}</span>
                </div>
            </div>
            <div class="event-action">
                <i class="fa fa-ellipsis-v toggle-action"></i>
                <ul class="event-action-mobile">
                    <li><button class="btn btn-outline-info qr-btn-mobile" data-toggle="modal" data-target=".qrcode">{{ trans('message.qrcode') }}</button></li>
                    <li><button class="btn btn-outline-success edit-event-btn" data-id="{{$value->id}}"
                            data-code="{{$value->event_code}}" 
                            data-name="{{$value->event_name}}"
                            data-description="{{$value->event_description}}" 
                            data-link="{{$value->event_link}}"
                            data-mod="{{$value->setting_moderation}}" 
                            data-start="{{Carbon\Carbon::parse($value->start_date)->format('Y-m-d\TH:i')}}"
                            data-end="{{Carbon\Carbon::parse($value->end_date)->format('Y-m-d\TH:i')}}" 
                            data-join="{{$value->setting_join}}"
                            data-question="{{$value->setting_question}}" 
                            data-reply="{{$value->setting_reply}}"
                            data-anonymous="{{$value->setting_anonymous}}" 
                            data-toggle="modal"
                            data-target="#edit">{{ trans('message.edit') }}</button></li>
                    <li><button type="button" class="btn btn-outline-danger" 
                        data-id="{{$value->id}}"
                        data-name="{{$value->event_name}}"
                            data-toggle="modal" data-target="#delete">{{ trans('message.delete-btn') }}</button></li>
                </ul>
                <button type="button" class="btn btn-outline-success desktop-btn edit-event-btn" data-id="{{$value->id}}"
                    data-code="{{$value->event_code}}" 
                    data-name="{{$value->event_name}}"
                    data-description="{{$value->event_description}}" 
                    data-link="{{$value->event_link}}"
                    data-mod="{{$value->setting_moderation}}" 
                    data-start="{{Carbon\Carbon::parse($value->start_date)->format('Y-m-d\TH:i')}}"
                    data-end="{{Carbon\Carbon::parse($value->end_date)->format('Y-m-d\TH:i')}}"  
                    data-join="{{$value->setting_join}}"
                    data-question="{{$value->setting_question}}" 
                    data-reply="{{$value->setting_reply}}"
                    data-anonymous="{{$value->setting_anonymous}}" 
                    data-toggle="modal" 
                    data-target="#edit"><i
                        class="fa fa-edit"></i>
                </button>
                <button type="button" class="btn btn-outline-info qr-btn desktop-btn" data-toggle="modal"
                    data-target=".qrcode">
                    <i class="fa fa-qrcode"></i></button>
                <div class="modal fade qrcode" tabindex="-1" role="dialog" aria-labelledby="qrcode" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="title">{{$value->event_name}}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="margin:0 auto;">
                                {!! QrCode::size(600)->generate($value->event_link); !!}
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-danger desktop-btn" data-id="{{$value->id}}"  data-name="{{$value->event_name}}"
                    data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i></button>
            </div>
        </div>
        @endforeach
        @endif
    </div>

    <!-- Modal For Creat Event -->
    <div class="modal fade" id="createEvent" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" method="post" class="submit-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">{{ trans('message.create-event') }}</h5>

                </div>
                <div class="modal-body">
                    
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.event-name') }}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="event_name" name="event_name" maxlength="100"
                                    placeholder="Event Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.description') }}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="event_description" name="event_description" maxlength="200"
                                    placeholder="Write desciption here" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.start-date') }}</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control create-start-date" id="start_date" name="start_date" required
                                value="{{Carbon\Carbon::parse(date('Y-m-d\TH:i', time() + 3600))->setTimezone('Asia/Phnom_Penh')->format('Y-m-d\TH:i')}}"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.end-date') }}</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date" required
                                value="{{Carbon\Carbon::parse(date('Y-m-d\TH:i', time() + 90000))->setTimezone('Asia/Phnom_Penh')->format('Y-m-d\TH:i')}}"
                                >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12  text-center date-error-message">
                                <span class="text-danger">{{ trans('message.error-end-time') }}</span>
                            </div>
                            <div class="col-sm-12  text-center startdate-error-message">
                                <span class="text-danger">{{ trans('message.error-start-time') }}</span>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ trans('message.cancel-btn') }}</button>
                    <button type="submit" class="btn btn-success" id="add-new-event-btn">{{ trans('message.save-btn') }}</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal For Edit Event -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form role="form" method="post" id="edit_form" class="submit-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">{{ trans('message.edit-event') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.event-name') }}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="en" name="en" maxlength="100" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.event-code') }}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ec" name="ec" maxlength="5" required>
                            </div>
                            <div class="col-sm-12  text-center event-code-error-message">
                                <span class="text-danger">{{ trans('message.eventcode-error') }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.description') }}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ds" name="ds" maxlength="200" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.start-date') }}</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="sd" name="sd" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ trans('message.end-date') }}</label>
                            <div class="col-sm-8">
                                <input type="datetime-local" class="form-control" id="ed" name="ed" required>
                            </div>
                        </div>
                        <div class="form-event-optional">
                            <label class="col-form-label">{{ trans('message.options') }}: </label>
                            <div class="form-group row">
                                <label for="ji" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="ji" name="ji">
                                    <span> {{ trans('message.join-check') }}</span>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label for="qt" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="qt" name="qt">
                                    <span> {{ trans('message.ask-check') }}</span>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label for="rl" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="rl" name="rl">
                                    <span> {{ trans('message.reply-check') }}</span>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label for="md" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="md" name="md">
                                    <span> {{ trans('message.moderation-check') }}</span>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label for="an" class="checkbox-label">
                                    <input type="checkbox" class="form-control" id="an" name="an">
                                    <span> {{ trans('message.anonymous-check') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Link</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="li" name="li" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12  text-center date-error-message">
                                <span class="text-danger">{{ trans('message.error-end-time') }}</span>
                            </div>
                            <div class="col-sm-12  text-center data-error-message">
                                <span class="text-danger">Please check the information you have entered, we do not accept incorrect dates</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">{{ trans('message.cancel-btn') }}</button>
                        <button type="submit" class="btn btn-success" id="update">{{ trans('message.save-btn') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal For Delete Event -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="delete_title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                {{ trans('message.message-del') }}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">{{ trans('message.cancel-btn') }}</button>
                    <button type="submit" class="btn btn-danger" id="del">{{ trans('message.delete-btn') }}</button>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection