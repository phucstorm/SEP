<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll_Question;
use App\Poll_Answer;
class PollQuestionController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($event_id){
        $poll = Poll_Question::where('event_id', '=',$event_id)->get();
        return view('event.poll',compact('poll'));
    }

    public function create(Request $request){
        $rules = array(
            'poll_question_content' => 'required',
        );
        $validator = Validator::make ( Input::all(), $rules);
        if($validator->fails()){
            return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        }else{
            $poll_question = new Poll_Question;
            $poll_question->event_id = $request->event_id;
            $poll_question->poll_question_content = $request->poll_question_content;
            $poll_question->mul_choice = $request->mul_choice;
            $poll_question->one_choice = $request->one_choice;
            $poll_question->status = $request->status;
            $poll_answer = new Poll_Answer;
            foreach($request->except(['event_id', 'poll_question_content','mul_choice','one_choice','status']) as $item){
                $poll_answer->$item;
                $poll_answer->save();
            }
            $poll_question->save();
            return response()->json($poll_answer,$poll_question);
        }
    }

    public function update_poll_question_content(Request $request){
        $poll_question = Poll_Question::find($request->id);
        $rules = array(
            'poll_question_content' => 'required',
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

    public function update_poll_answer(Request $request){
        $ans = Poll_Answer::find($request->id);
        
        // edit old answer and add new answer 

        return response()->json($ans);

    }

    public function delete_poll_question(Request $request){
        $poll = Poll_Question::find($request->id)->delete();
        return response()->json();
    }

    public function static_poll_result(){
        
    }
}
