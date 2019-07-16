<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\FormSubmitted;
use App\Event;
use App\Question;
class GuestController extends Controller
{
    //
    public function __construct(){
        $this->middleware('guest');
    }

    // Attendee input event code to join event room
    public function search(Request $request){
        $event = Event::where('event_code', '=', $request->get('room') )->firstOrFail();
        $question = Question::where('event_id','=',$event->id)->get();
        $count = $question->where('status', 1)->count();
        if($event->setting_join == 1){
            return view('room', compact('event' ,$event,'question',$question, 'count',$count));
        }else{
            return "You don't have a permission to join this room";
        }     
    }

    //Attendee input question and submit
    public function postQuestion(Request $request){
        $question = request()->question;
        if($question == ""){
            return redirect()->back()->with('alert','You must type question'); 
            
        }else{
            if(request()->user_name != ""){
                $user_name = request()->user_name;
            }else{
                $user_name = "Anonymus";
            }
            $qt = new Question;
            $qt->event_id = request()->event_id;
            $qt->content = $question;
            $qt->user_name = $user_name;
            $qt->status = 0;
            $qt->save();
            event(new FormSubmitted($qt->id,$qt->content, $user_name, request()->event_id, $qt->created_at));
            return redirect()->back();
        } 
    }
}
