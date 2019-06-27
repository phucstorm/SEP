@extends('layouts.guest')

@section('content')
    <div class="input-group" style="padding: 0px 220px;">  
        <form action="/room" method="post">
        <input type="text" name="event_id" value="{{$event->id}}" hidden>
            <input type="text" name="question" placeholder="Type your question">
            <input type="text" name="user_name" placeholder="Your name (optional)">
            <input type="submit">
            {{csrf_field()}}
        </form>
    </div>
@endsection
