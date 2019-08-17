<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\FormSubmitted;
use App\Events\VoteSubmitted;
use App\Events\LikeQuestion;
use App\Events\SubmitQuestion;
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
        return view('room', compact('event' ,$event,'question',$question, 'count',$count));     
    }
    public function getQuestion($event_id){
        $event = Event::find($event_id);
        $data = array();
        $i = 0;
        foreach($event->questions as $question){
            if($question->status == 1){
                $data[$i] = [
                    'name' => $question->user_name,
                    'date' => $question->created_at,
                    'content' => $question->content,
                    'like' => $question->like,
                    'id' => $question->id
                ];
                $i += 1;
            }
        }
        return response()->json($data);
    }
    //Attendee input question and submit
    public function postQuestion()
    {
        $eventId = $_POST['event_id'];
        $event = Event::find($eventId);
        $content = $_POST['question'];
        $name = $_POST['user_name'];
        if($event->setting_anonymous == 0 && $name == ""){
            return 'error anonymous';
        }else if($content==""){
            return 'empty';
        }else{
            if($name == ""){
                $name = 'Anonymous';
            }
            if($event->setting_moderation==0){
                $status = 1;
            }else{
                $status = 0;
            }
            $event->questions()->create([
                'event_id' => $eventId,
                'content' => $content,
                'user_name' => $name,
                'like' => 0,
                'status' => $status
            ]);
            event(new FormSubmitted());
        }
    }

    public function poll_question($event){
        $event = Event::where('event_code', '=', $event)->firstOrFail();
        $poll = $event->polls->where('status', 1)->first();
        return view('pollguest', compact('event','poll'));
    }

    public function getRunningPoll($event_id){
        $event = Event::find($event_id);
        $poll = $event->polls->where('status', 1)->first();
        if($poll==[]){
            return "nopollrunning";
        }
        $data = array();
        $multi = $poll->mul_choice;
        $votes = $poll->total_votes;
        $content = $poll->poll_question_content;
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
        return response()->json(array($data,$multi,$votes,$content,$poll->id));

    }

    public function vote()
    {
        $poll_id = $_POST['poll-id'];
        if(!isset($_POST['poll_answer'])){
            return "emptyvote";
        }
        $poll_answer = $_POST['poll_answer'];
        $poll = Poll_Question::find($poll_id);
        $votes = 0;

        if($poll_answer!=null){
            $votes=($poll->total_votes)+1;
            $poll->update(['total_votes'=>$votes]);

            if(is_array($poll_answer))
            {
                foreach ($poll_answer as $id) {
                    $answer = Poll_Answer::where('id', $id)->first();
                    $voteAnswer = ($answer->votes)+1;
                    $answer->update(['votes'=>$voteAnswer]); 
                }
            }else{
                $answer = Poll_Answer::where('id', $poll_answer)->first();
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
        }else{
            return "emptyvote";
        }
    }

    public function revote()
    {
        $poll_id = $_POST['poll-id'];
        $poll_answer = $_POST['poll_answer'];
        $poll = Poll_Question::find($poll_id);

        $votes = 0;
        if($poll_answer!=[]){
            $votes=($poll->total_votes)-1;
            $poll->update(['total_votes'=>$votes]);

            if(is_array($poll_answer))
            {
                foreach ($poll_answer as $id) {
                    $answer = Poll_Answer::where('id', $id)->first();
                    $voteAnswer = ($answer->votes)-1;
                    $answer->update(['votes'=>$voteAnswer]); 
                }
            }else{
                $answer = Poll_Answer::where('id', $poll_answer)->first();
                $voteAnswer = ($answer->votes)-1;
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
        }
    }
    public function like_question($question_id){
        $ques = Question::find($question_id);
        $ques->like += 1;
        $ques->save();

        $likes = $ques->like;
        event(new FormSubmitted());
        return response()->json($question_id);
    }

    public function unlike_question($question_id){
        $ques = Question::find($question_id);
        $ques->like -= 1;
        $ques->save();
        $likes = $ques->like;
        event(new FormSubmitted());
    }
    public function showReplies($question_id){
        // $questionId = $request->question_id;
        $question = Question::find($question_id);
        $data = array();
        $i=0;
        foreach($question->replies as $reply){
            $data[$i] = [
                'name' => $reply->user_name,
                'date' => $reply->created_at,
                'host' => $reply->user_id,
                'content' => $reply->rep_content
            ];
            $i += 1;
        };
        $content = $question->content;
        return response()->json($data);

    }

    public function reply_question(){
        $question = Question::find(request()->get('question-id'));
        $username = request()->get('username');
        $event = $question->event;
        if($event->setting_anonymous==0 && $username==""){
            return "error anonymous";
        }else if(request()->get('reply')==""){
            return "empty";
        }else{
            if($username==""){
                $username = "Anonymous";
            }
            $question->replies()->create([
                'question_id' => $question->id,
                'rep_content' => request()->get('reply'),
                'user_name' => $username
            ]);
        }
        return response()->json($event->id);
    }
    
}
