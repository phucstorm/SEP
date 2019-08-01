<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll_Question;
use App\Poll_Answer;
use App\Event;
use App\Events\PlayPoll;
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

    public function index($event){
        $event = Event::where('event_code', '=', $event)->firstOrFail();
        return view('event.hostpoll', compact('event'));
    }

    public function create(Request $request){
        // $rules = array(
        //     'poll_name' => 'required',
        //     'poll_answer' => 'required',
        //     'event_id' => 'required',
        // );
        // $validator = Validator::make ( Input::all(), $rules);
        // if($validator->fails()){
        //     return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
        // }else{
        //     $set_default_status = DB::table('poll__questions')->update(['status' => 0]);
        //     $poll_question = new Poll_Question;
        //     $poll_question->event_id = $request->event_id;
        //     $poll_question->poll_question_content = $request->poll_name;
        //     if($request->option == 1){
        //         $poll_question->mul_choice = 1;
        //         $poll_question->one_choice = 0;
        //         $poll_question->status = 1;
        //         $poll_question->save();
        //     }else{
        //         $poll_question->mul_choice = 0;
        //         $poll_question->one_choice = 1;
        //         $poll_question->status = 1;
        //         $poll_question->save();
        //     }
            
        //     foreach($request->poll_answer as $key => $value){
        //         $poll_answer = new Poll_Answer;
        //         if($value['value'] != ''){
        //             $poll_answer->poll_question_id = $poll_question->id;
        //             $poll_answer->poll_answer_content = $value['value'];
        //             $poll_answer->votes = 0;
        //             $poll_answer->save();
        //         }
        //     }
        //     return response()->json();
        // }

        
        // echo $selectedOption."\n";
        // $answer = array(request()->validate([
        //     'poll_answer' => ''
        // ]));


        $event = Event::findOrfail($request->event_id);
        $data = request()->validate([
            'poll_question_content' => 'required',
            'poll_answer' =>'',
            'event_id' =>'',
            'mul_choice' =>''
        ]);
        if(!empty($_POST['mul_choice']))
        {
            $mul_choice=1;
        }else {
            $mul_choice=0;
        }
        

        $event->polls()->create([
            'poll_question_content' => $data['poll_question_content'],
            'event_id' => $data['event_id'],
            'total_votes' => 0,
            'mul_choice' => $mul_choice,
            'status' => 0,
        ]);
        foreach ($data['poll_answer'] as $answer){
            Poll_Question::latest()->first()->answers()->create([
                'poll_answer_content' => $answer,
                'votes' => 0
            ]);
        }
        // return response()->json($request);
        return redirect("/admin/event/poll/".$event->event_code);
    }

    // public function update_poll_question_content(Request $request){
    //     $poll_question = Poll_Question::find($request->id);
    //     $rules = array(
    //         'poll_name' => 'required',
    //         'poll_answer' => 'required',
    //         'event_id' => 'required',
    //     );
    //     $validator = Validator::make ( Input::all(), $rules);
    //     if($validator->fails()){
    //         return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));
    //     }else{
    //         $poll_question->poll_question_content = $request->poll_question_content;
    //         $poll_question->mul_choice = $request->mul_choice;
    //         $poll_question->one_choice = $request->one_choice;
    //         $poll_question->status = $request->status;
    //         $poll_question-save();
    //         return response()->json($poll_question);
    //     }
    // }

    public function update(Poll_Question $poll){
        // $ans = Poll_Answer::find($request->id);
        
        // edit old answer and add new answer 

    //     return response()->json($request);

    // }

    // public function delete_poll_question(Request $request){
    //     $answer = Poll_Answer::where('poll_question_id', '=', Poll_Question::find($request->id)->id)->delete();
    //     $poll = Poll_Question::find($request->id)->delete();
    //     $get_old_poll = Poll_Question::max('id');
    //     $set_status = Poll_Question::find($get_old_poll)->firstOrFail();
    //     $set_status->status = 1;
    //     $set_status->save();
    //     return response()->json($set_status);
    // }

    // public function static_poll_result(){
        
    // }
        $data = request()->validate([
            'poll_question_content' => 'required',
            'event_id' =>'',
            'total_votes' => '',
            'mul_choice' =>'',
            'status' => '',
            'event_id' =>''
        ]);
        if(!empty($_POST['mul_choice']))
        {
            $mul_choice=1;
        }else {
            $mul_choice=0;
        }
        $event = Event::findOrfail($data['event_id']);
        $answers = request()->input([
            'poll_answer'
        ]);
        $newAnswers = request()->validate([
            'new_poll_answer' => '',
        ]);
        // dd(array_keys($answers));
        $poll->update($data);
        $poll->update(['mul_choice'=>$mul_choice]);
        foreach (array_keys($answers) as $answer_id){
            
            Poll_Answer::where('id', $answer_id)->update(['poll_answer_content' => $answers[$answer_id]]);
        }
        $poll->answers()->whereNotIn('id', array_keys($answers))->delete();
        if ($newAnswers!=[])
        {
            foreach ($newAnswers['new_poll_answer'] as $answer){
                $poll->answers()->create([
                    'poll_answer_content' => $answer,
                    'poll__question_id' => $poll->id,
                    'votes' => 0
                ]);
            }
        }

        return redirect("/admin/event/poll/".$event->event_code);
    }

    public function updateStatus(Poll_Question $poll){
        $data = request()->validate([
            'status-poll' => '',
            'event_id' =>''
        ]);
        if($data['status-poll']=='play')
        {
            Poll_Question::where('status', 1)->update(['status'=>0]);
            $poll->update(['status'=>1]);         
        }else{
            $poll->update(['status'=>0]);
        }
        //live
        $pollGo = Poll_Question::where('status', 1)->first();
        if($pollGo!=[])
        {
            $answerId = array();
            $answerContent = array();
            $mulChoice = $pollGo->mul_choice;
            foreach($pollGo->answers as $answer)
            {
                array_push($answerId,$answer->id);
                array_push($answerContent,$answer->poll_answer_content);
            }
            event(new PlayPoll($pollGo->id,$answerId,$answerContent, $mulChoice, $poll->poll_question_content));
        }


        $event = Event::findOrfail($data['event_id']);
        return redirect("/admin/event/poll/".$event->event_code);
    }

    public function delete(Poll_Question $poll){
        $poll->answers()->delete();
        $poll->delete();
        return redirect()->back();
    }
}
