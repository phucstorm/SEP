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
        return redirect("/admin/event/poll/".$event->event_code);
    }

    public function update(Poll_Question $poll){
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
        $event = $poll->event;

        if($data['status-poll']=='play' )
        {
            $event->polls()->where('status', 1)->update(['status'=>0]);
            $poll->update(['status'=>1]);         
        }else{
            $poll->update(['status'=>0]);
        }

        //live
        event(new PlayPoll($event->id));

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

    public function delete(Poll_Question $poll){
        $poll->answers()->delete();
        $poll->delete();
        return redirect()->back();
    }
}
