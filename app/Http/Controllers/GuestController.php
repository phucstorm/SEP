<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\FormSubmitted;
use App\Events\VoteSubmitted;
use App\Event;
use App\Question;
use App\Poll_Question;
use App\Poll_Answer;
class GuestController extends Controller
{
    //
    public function __construct(){
        $this->middleware('guest');
    }

    // Attendee input event code to join event room
    public function search(Request $request)
    {
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
    public function postQuestion(Request $request)
    {
        $question = request()->question;
        if($question == ""){
            return redirect()->back()->with('alert','You must type question'); 
            
        }else{
            if(request()->user_name != ""){
                $user_name = request()->user_name;
            }else{
                $user_name = "Anonymous";
            }
            $qt = new Question;
            $qt->event_id = request()->event_id;
            $qt->content = $question;
            $qt->user_name = $user_name;
            $qt->status = 0;
            $qt->like = 0;
            $qt->unlike = 0;
            $qt->save();
            event(new FormSubmitted($qt->id,$qt->content, $user_name, request()->event_id, $qt->created_at));
            return redirect()->back();
        } 
    }

    public function poll_question($event){
        // $event = Event::where('event_code', '=', $event_code)->firstOrFail();
        // $poll_question = Poll_Question::where('event_id', '=', $event->id)->where('status', '=', 1)->firstOrFail();
        // $poll_answer = Poll_Answer::where('poll_question_id', '=', $poll_question->id)->get();
        // return view('pollguest', compact('event' ,'poll_question', 'poll_answer'));
        // return response()->json($poll_answer);
        $event = Event::where('event_code', '=', $event)->firstOrFail();
        $poll = $event->polls->where('status', 1)->first();
        return view('pollguest', compact('event','poll'));
    }

    public function vote($poll_id)
    {
        
        $poll = Poll_Question::find($poll_id);
        $answers = request()->input([
            'poll_answer'
        ]);
        return response()->json($poll);
        if(!empty($_POST['poll_answer']))
        {
            
            $votes=($poll->total_votes)+1;
            foreach($answers as $id)
            {
                $answer = Poll_Answer::where('id', $id)->first();
                $voteAnswer = ($answer->votes)+1;
                $answer->update(['votes'=>$voteAnswer]);          
            }
            $answerArray = array();
            $answerContent = array();
            $sumVotes = 0;
            foreach($poll->answers as $answer){
                array_push($answerArray,$answer->votes);
                array_push($answerContent,$answer->poll_answer_content);
                $sumVotes+=$answer->votes;
            }
            event(new VoteSubmitted($answerArray,$sumVotes,$votes,$answerContent));
            $poll->update(['total_votes'=>$votes]);
            
        }else {
            return back()->withErrors('Please vote for an answer!');
        }
        return redirect()->back();
        


    }
    
}
