@extends('layouts.app')

@section('content')
<main class="main">
<div class="container">
    <div class="create-event-btn">
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createEvent"
            id="create-event-btn">
            Create Event
        </button>
    </div>
    {{ csrf_field() }}
    @if($event == '[]' && isset($_GET['search']))
    <div>No result found</div>
    @else
    @foreach($event as $value)
    <!-- dẫn link event-container vô room -->
    <div class="event-container">
        <div class="event-short-info">
            <div class="event-icon"></div>
            <div class="event-namecode">
                <div class="event-name"><i class="fa fa-calendar" aria-hidden="true"></i><a
                        href="/admin/event/{{$value->event_code}}">{{$value->event_name}}</a></div>
                <div class="event-code">#{{$value->event_code}}</div>
            </div>
            <div class="event-startend-date">
            {{Carbon\Carbon::parse($value->start_date)->format('d-m-Y')}} to {{Carbon\Carbon::parse($value->end_date)->format('d-m-Y')}}
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

            <button type="button" class="btn btn-outline-danger desktop-btn" data-id="{{$value->id}}"
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
            <div class="modal-header">
                <h5 class="modal-title" id="title">Create Event</h5>
                
            </div>
            <div class="modal-body">
                <form role="form" method="post">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Event Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="event_name" name="event_name"
                                placeholder="Event Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="event_description" name="event_description"
                                placeholder="Write desciption here" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Start Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">End Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" id="add">Create Event</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal For Edit Event -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Edit Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" id="edit_form">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Event Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="en" name="en" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Event Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ec" name="ec" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ds" name="ds" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Start Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="sd" name="sd" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">End Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="ed" name="ed" required>
                        </div>
                    </div>
                    <div class="form-event-optional">
                        <label class="col-form-label">Options: </label>
                        <div class="form-group row">
                            <label for="ji" class="checkbox-label">
                                <input type="checkbox" class="form-control" id="ji" name="ji">
                                <span> Join</span>
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="qt" class="checkbox-label">
                                <input type="checkbox" class="form-control" id="qt" name="qt">
                                <span> Ask</span>
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="rl" class="checkbox-label">
                                <input type="checkbox" class="form-control" id="rl" name="rl">
                                <span> Reply</span>
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="rl" class="checkbox-label">
                                <input type="checkbox" class="form-control" id="md" name="md">
                                <span> Moderation</span>
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="rl" class="checkbox-label">
                                <input type="checkbox" class="form-control" id="an" name="an">
                                <span> Anonymous</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Link</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="li" name="li" readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" id="update">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal For Delete Event -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="delete_title">Warning !!!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure that you want to delete this event?

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" id="del">Delete</button>
            </div>
        </div>
    </div>
</div>
</main>

@endsection