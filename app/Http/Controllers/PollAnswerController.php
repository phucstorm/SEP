<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
class PollAnswerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function index($event_code){
        $event = Event::where('event_code', '=', $event_code )->firstOrFail();
        if($event->setting_join == 1){
            return view('pollguest', compact('event' ,$event)); 
        }else{
            return "You don't have a permission to join this room";
        }
    }

}
