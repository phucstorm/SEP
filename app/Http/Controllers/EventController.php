<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Response, Validator;
use App\http\Requests;
use App\Event;
use App\Question;
use Auth;
class EventController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $event = Event::where('user_id', '=',Auth::user()->id)->get();
        return view('event.index',compact('event'));
    }

    public function create(Request $request){
        $rules = array(
            'event_name' => 'required',
            'event_description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        );
        $validator = Validator::make ( Input::all(), $rules);
        if($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }else{
            $event = new Event;
            $event->event_name = $request->event_name;
            $event->event_code = str_random(5);
            $event->event_description = $request->event_description;
            $event->event_link = 'http://localhost:8000/room?room='.$event->event_code;
            $event->user_id = Auth::user()->id;
            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->setting_join = 1;
            $event->setting_question = 1;
            $event->setting_reply = 1;
            $event->setting_moderation = 1;
            $event->setting_anonymous = 1;
            $event->save();
            return response()->json($event);
        }
    }

    public function delete(Request $request){
        $event = Event::find($request->id)->delete();
        return response()->json();
    }

    public function edit(Request $request){
        $event = Event::find($request->id);
        $event->event_name = $request->event_name;
        $event->event_code = $request->event_code;
        $event->event_description = $request->event_description;
        $event->event_link = 'http://localhost:8000/room?room='.$event->event_code;
        $event->start_date = $request->event_start;
        $event->end_date = $request->event_end;
        $event->setting_join = $request->join;
        $event->setting_question = $request->question;
        $event->setting_reply = $request->reply;
        $event->setting_moderation = $request->moderation;
        $event->setting_anonymous = $request->anonymous;
        $event->save();
        return response()->json($event);
    }

    public function show(Request $request){
        
        $event = Event::where('event_code', '=', $request->event_code)->firstOrFail();
        if($event->setting_join == 1 ){
            $question = Question::all();
            return view('event.detail', compact('question',$question,'event' ,$event));
        }else{
            return "Hiển thị trang lỗi 404 hoặc thông báo cho người dùng phải cho phép vào room";
        }
        
    }

    public function search(Request $request){
        $event = Event::where('event_name','like', '%'.$request->get('search').'%')->where('user_id', '=', Auth::user()->id)->get();
        return view('event.search', compact('event', $event));
    }
}
