<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Question;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class SearchController extends Controller
{
    //

    // public function search(Request $request){
    //     $event = Event::where('event_code', '=', $request->get('room') )->firstOrFail();
    //     $question = Question::where('event_id','=',$event->id)->get();
    //     $count = $question->where('status', 1)->count();
    //     if($event->setting_join == 1){
    //         return view('room', compact('event' ,$event,'question',$question, 'count',$count));
    //     }else{
    //         return "You don't have a permission to join this room";
    //     }     
    // }

    // public function getQR(Request $request){
    //     $code = $request->event_code;
    //     $link = 'http://localhost:8000/room?room=';
    //     $total =  $link.''.$code;
    //     return view('event.index')-> with('total', $total);
    // }
}
