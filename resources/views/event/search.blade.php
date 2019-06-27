@extends('layouts.app')

@section('content')
@if($event == '[]')
    <div>No result found</div>
@else  
    @foreach($event as $key => $value)
        <div>{{$value->event_name}}</div>
    @endforeach
@endif

@endsection