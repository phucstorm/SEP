<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll_Question;
use App\Poll_Answer;
use App\Event;
use Validator;
use DB;
use Illuminate\Support\Facades\Input;
class PollQuestionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($event_id){
        $event = Event::where('id', '=', $event_id)->firstOrFail();
        $poll = Poll_Question::where('event_id', '=',$event_id)->get();
        $vote_answer = Poll_Answer::select('poll_question_id',DB::raw('sum(votes) as sum_votes'))->groupBy('poll_question_id')->get();
        $answer = Poll_Answer::select('id','poll_question_id','poll_answer_content')->get();
        $live_question = Poll_Question::where('status', '=',1)->get();
        if($live_question != '[]'){
            foreach($live_question as $key => $item){
                $title = $item->poll_question_content;
                $live_answer = Poll_Answer::where('poll_question_id', '=', $item->id)->get();   
                $sum_votes = Poll_Answer::where('poll_question_id', '=', $item->id)->sum('votes');
                return view('event.poll',compact('poll','event', 'vote_answer', 'answer', 'live_question','title', 'live_answer', 'sum_votes'));
                // return response()->json($live_answer);  
            }
        }else{
            return view('event.poll',compact('poll','event', 'live_question'));
        }
        // return response()->json($poll);


        
        // return response()->json($answer);
    }

    public function create(Request $request){
        $rules = array(
            'poll_name' => 'required',
            'poll_answer' => 'required',
            'event_id' => 'required',
        );
        $validator = Validator::make ( Input::all(), $rules);
        if($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }else{
            $set_default_status = DB::table('poll__questions')->update(['status' => 0]);
            $poll_question = new Poll_Question;
            $poll_question->event_id = $request->event_id;
            $poll_question->poll_question_content = $request->poll_name;
            if($request->option == 1){
                $poll_question->mul_choice = 1;
                $poll_question->one_choice = 0;
                $poll_question->status = 1;
                $poll_question->save();
            }else{
                $poll_question->mul_choice = 0;
                $poll_question->one_choice = 1;
                $poll_question->status = 1;
                $poll_question->save();
            }
            
            foreach($request->poll_answer as $key => $value){
                $poll_answer = new Poll_Answer;
                if($value['value'] != ''){
                    $poll_answer->poll_question_id = $poll_question->id;
                    $poll_answer->poll_answer_content = $value['value'];
                    $poll_answer->votes = 0;
                    $poll_answer->save();
                }
            }
            return response()->json();
        }
        
    }

    public function update_poll_question_content(Request $request){
        $poll_question = Poll_Question::find($request->id);
        $rules = array(
            'poll_name' => 'required',
            'poll_answer' => 'required',
            'event_id' => 'required',
        );
        $validator = Validator::make ( Input::all(), $rules);
        if($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }else{
            $poll_question->poll_question_content = $request->poll_question_content;
            $poll_question->mul_choice = $request->mul_choice;
            $poll_question->one_choice = $request->one_choice;
            $poll_question->status = $request->status;
            $poll_question-save();
            return response()->json($poll_question);
        }
    }

    public function update_poll(Request $request){
        // $ans = Poll_Answer::find($request->id);
        
        // edit old answer and add new answer 

        return response()->json($request);

    }

    public function delete_poll_question(Request $request){
        $answer = Poll_Answer::where('poll_question_id', '=', Poll_Question::find($request->id)->id)->delete();
        $poll = Poll_Question::find($request->id)->delete();
        $get_old_poll = Poll_Question::max('id');
        $set_status = Poll_Question::find($get_old_poll)->firstOrFail();
        $set_status->status = 1;
        $set_status->save();
        return response()->json();
    }

    public function static_poll_result(){
        
    }
}
