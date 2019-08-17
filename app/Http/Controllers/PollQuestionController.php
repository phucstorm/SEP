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

    public function create(){
        $event = Event::find(request()->get('event-id'));
        $mul_choice = request()->get('mul_choice');
        if(isset($mul_choice))
        {
            $mul_choice=1;
        }else {
            $mul_choice=0;
        }
        $content = request()->get('poll_question_content');
        $answers = request()->get('poll_answer');
        if($content==""){
            return "emptycontent";
        }else if(in_array("", $answers)){
            return "emptyanswer";
        }else{
            $event->polls()->create([
                'poll_question_content' => $content,
                'event_id' => $event->id,
                'total_votes' => 0,
                'mul_choice' => $mul_choice,
                'status' => 0,
            ]);
            foreach ($answers as $answer){
                Poll_Question::latest()->first()->answers()->create([
                    'poll_answer_content' => $answer,
                    'votes' => 0
                ]);
            }
        }

        // return redirect("/admin/event/poll/".$event->event_code);
    }

    public function update($poll_id){
        $get = Input::all();
        $poll = Poll_Question::find($poll_id);
        $mul_choice=0;
        if(isset($_POST['multi_choice']))
        {
            if($_POST['multi_choice'] == 1){
                $mul_choice=1;
            }
            
        }
        $pollContent = $_POST['poll_question_content'];
        $answers = $_POST['poll_answer'];
        if($pollContent == ""){
            return "emptycontent";
        }else if(in_array("", $answers)){
            return "emptyanswer";
        }else{
            $poll->update(['mul_choice'=>$mul_choice, 'poll_question_content' => $pollContent]);
            foreach (array_keys($answers) as $answer_id){ 
                Poll_Answer::where('id', $answer_id)->update(['poll_answer_content' => $answers[$answer_id]]);
            }
            $poll->answers()->whereNotIn('id', array_keys($answers))->delete();
        }
        if(isset($_POST['new_poll_answer']))
        {
            $newAnswers = $_POST['new_poll_answer'];
            if ($newAnswers!=[])
            {
                foreach ($newAnswers as $answer){
                    if($answer!=""){
                        $poll->answers()->create([
                            'poll_answer_content' => $answer,
                            'poll__question_id' => $poll->id,
                            'votes' => 0
                        ]);
                    }
                }
            }
        }
        // return response()->json(array_keys($answers));
        return response()->json($get);
    }

    public function getPollAnswer($poll_id){
        $poll = Poll_Question::find($poll_id);
        $data = array();
        $i = 0;
        foreach($poll->answers as $answer){
            $data[$i] = [
                'content' => $answer->poll_answer_content,
                'votes' => $answer->votes,
                'id' => $answer->id,
                'status' => $poll->status
            ];
            $i += 1;
        }
        return response()->json($data);
    }

    public function getRunningPoll(){
        
    }

    public function updateStatus($poll_id){
        $poll = Poll_Question::find($poll_id);
        if($poll->status==0){
            $poll->event->polls()->where('status', 1)->update(['status'=>0]);
            $poll->update(['status'=>1]);
        }else{
            $poll->update(['status'=>0]);
        }
        return response()->json($poll_id);

        //live
        // event(new PlayPoll($event->id));

        // $pollGo = Poll_Question::where('status', 1)->first();
        // if($pollGo!=[])
        // {
        //     $answerId = array();
        //     $answerContent = array();
        //     $mulChoice = $pollGo->mul_choice;
        //     foreach($pollGo->answers as $answer)
        //     {
        //         array_push($answerId,$answer->id);
        //         array_push($answerContent,$answer->poll_answer_content);
        //     }
        //     event(new PlayPoll($pollGo->id,$answerId,$answerContent, $mulChoice, $poll->poll_question_content));
        // }


        $event = Event::findOrfail($data['event_id']);
        return redirect("/admin/event/poll/".$event->event_code);
    }

    public function delete($poll_id){
        $poll = Poll_Question::find($poll_id);
        $poll->answers()->delete();
        $poll->delete();
        // return redirect()->back();
    }
}
