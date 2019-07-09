@extends('layouts.app')

@section('content')
@if($event == '[]')
<div>No result found</div>
@else
<main class="main">
    <div class="container">
        @foreach($event as $key => $value)

        <div class="event-container">
            <div class="event-short-info">
                <div class="event-icon"></div>
                <div class="event-namecode">
                    <div class="event-name"><i class="fa fa-calendar" aria-hidden="true"></i><a
                            href="/admin/event/{{$value->event_code}}">{{$value->event_name}}</a></div>
                    <div class="event-code">#{{$value->event_code}}</div>
                </div>
                <div class="event-startend-date">
                    {{Carbon\Carbon::parse($value->start_date)->format('d-m-Y')}} to
                    {{Carbon\Carbon::parse($value->end_date)->format('d-m-Y')}}
                </div>
            </div>
            <div class="event-action">
            <i class="fa fa-ellipsis-v toggle-action"></i>
            <ul class="event-action-mobile">
                <li><button class="btn btn-outline-info qr-btn-mobile" data-toggle="modal"
                data-target=".qrcode">QR Code</button></li>
                <li><button class="btn btn-outline-success" data-id="{{$value->id}}"
                data-code="{{$value->event_code}}" data-name="{{$value->event_name}}"
                data-description="{{$value->event_description}}" data-link="{{$value->event_link}}"
                data-mod="{{$value->setting_moderation}}" data-start="{{$value->start_date}}"
                data-end="{{$value->end_date}}" data-join="{{$value->setting_join}}"
                data-question="{{$value->setting_question}}" data-reply="{{$value->setting_reply}}"
                data-anonymous="{{$value->setting_anonymous}}" data-toggle="modal" data-target="#edit">Edit</button></li>
                <li><button type="button" class="btn btn-outline-danger" data-id="{{$value->id}}"
                data-toggle="modal" data-target="#delete">Delete</button></li>
            </ul>
                <button type="button" class="btn btn-outline-success desktop-btn" data-id="{{$value->id}}"
                    data-code="{{$value->event_code}}" data-name="{{$value->event_name}}"
                    data-description="{{$value->event_description}}" data-link="{{$value->event_link}}"
                    data-mod="{{$value->setting_moderation}}" data-start="{{$value->start_date}}"
                    data-end="{{$value->end_date}}" data-join="{{$value->setting_join}}"
                    data-question="{{$value->setting_question}}" data-reply="{{$value->setting_reply}}"
                    data-anonymous="{{$value->setting_anonymous}}" data-toggle="modal" data-target="#edit"><i
                        class="fa fa-edit"></i>
                </button>
                <button type="button" class="btn btn-outline-info qr-btn desktop-btn" data-toggle="modal"
                    data-target=".qrcode">
                    <i class="fa fa-qrcode"></i></button>
                <div class="modal fade qrcode" tabindex="-1" role="dialog" aria-labelledby="qrcode" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="title">QR Code to join this event</h5>
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

                <button type="button" class="btn btn-outline-danger desktop-btn" data-id="{{$value->id}}"
                    data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i></button>

            </div>
        </div>
        @endforeach
    </div>
</main>
@endif

@endsection