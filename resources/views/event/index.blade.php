@extends('layouts.app')

@section('content')
<div class="table-responsive" style="padding: 0px 50px;">
    <div style="float:right; padding: 10px 0px;">
        <form action="/search" method="get">
            <input type="text" name="search">
            <button type="submit">Search</button>
        </form>
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createEvent">
            Create Event
        </button>
    </div>

    <table class="table table-sm table-hover table-striped table-dark" id="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Event Name</th>
                <th scope="col">Event Code</th>
                <th scope="col">Join</th>
                <th scope="col">Question</th>
                <th scope="col">Reply</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col" width="20%">Action</th>
            </tr>
        </thead>
        <tbody>
            {{ csrf_field() }}
            @foreach($event as $value)
            <tr class="event_{{$value->id}}">
                <th scope="row" class="demo" data-id="{{$value->id}}">{{$value->id}}</th>
                <td>{{$value->event_name}}</td>
                <td>{{$value->event_code}}</td>
                @if($value->setting_join == 1)
                    <td>Yes</td>
                @else
                    <td>No</td>
                @endif
                @if($value->setting_question == 1)
                    <td>Yes</td>
                @else
                    <td>No</td>
                @endif
                @if($value->setting_reply == 1)
                    <td>Yes</td>
                @else
                    <td>No</td>
                @endif
                <td>{{$value->start_date}}</td>
                <td>{{$value->end_date}}</td>
                <td>
                <button type="button" class="btn btn-outline-info"><a
                            href="/qr/{{$value->event_code}}">QR</a></button>
                    <button type="button" class="btn btn-outline-info"><a
                            href="event/{{$value->event_code}}">Info</a></button>
                    <button type="button" class="btn btn-outline-warning" data-id="{{$value->id}}"
                        data-name="{{$value->event_name}}" data-start="{{$value->start_date}}"
                        data-end="{{$value->end_date}}" data-join="{{$value->setting_join}}"
                        data-question="{{$value->setting_question}}" data-reply="{{$value->setting_reply}}"
                        data-toggle="modal" data-target="#edit">Edit</button>
                    <button type="button" class="btn btn-outline-danger" data-id="{{$value->id}}" data-toggle="modal"
                        data-target="#delete">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal For Creat Event -->
<div class="modal fade" id="createEvent" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Create Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                        <label class="col-sm-3 col-form-label">Event Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="event_code" name="event_code"
                                placeholder="Event Code" required>
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
                <form role="form" method="post">
                    <div class="form-group row" hidden>
                        <label class="col-sm-3 col-form-label">ID</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ei" name="ei">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Event Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="en" name="en" required>
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
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Join</label>
                        <div class="col-sm-2">
                            <input type="checkbox" class="form-control" id="ji" name="ji">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Questions</label>
                        <div class="col-sm-2">
                            <input type="checkbox" class="form-control" id="qt" name="qt">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Reply</label>
                        <div class="col-sm-2">
                            <input type="checkbox" class="form-control" id="rl" name="rl">
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
                <h5 class="modal-title" id="title">Delete Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to delete ?

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" id="del">Delete</button>
            </div>
        </div>
    </div>
</div>


@endsection
