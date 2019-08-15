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
        if($event->setting_join == 1){
            return view('room', compact('event' ,$event,'question',$question, 'count',$count));
        }else{
            return "You don't have a permission to join this room";
        }     
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
        // return '1234';
        // $question = request()->question;
        // if($question == ""){
        //     return redirect()->back()->with('alert','You must type question'); 
            
        // }else{
        //     if(request()->user_name != ""){
        //         $user_name = request()->user_name;
        //     }else{
        //         $user_name = "Anonymous";
        //     }
        //     $event = Event::find(request()->event_id);
        //     $qt = new Question;
        //     $qt->event_id = request()->event_id;
        //     $qt->content = $question;
        //     $qt->user_name = $user_name;
        //     if($event->setting_moderation==0){
        //         $qt->status = 1;
        //     }else{
        //         $qt->status = 0;
        //     }
        //     $qt->like = 0;
        //     $qt->save();

           

        //     return redirect()->back();
        // } 
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

    public function vote()
    {
        $poll_id = $_POST['poll-id'];
        $poll_answer = $_POST['poll_answer'];
        $poll = Poll_Question::find($poll_id);

        $votes = 0;
        if($poll_answer!=[]){
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
        event(new LikeQuestion($question_id, $likes));
        return response()->json($question_id);
    }

    public function unlike_question($question_id){
        $ques = Question::find($question_id);
        $ques->like -= 1;
        $ques->save();
        $likes = $ques->like;
        event(new LikeQuestion($question_id, $likes));
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
        $question_id = $_POST['question-id'];
        $reply = $_POST['reply'];
        $question = Question::find($question_id);
        $username = $_POST['username'];
        $event = $question->event;
        if($event->setting_anonymous==0 && $username==""){
            return "error anonymous";
        }else if($reply==""){
            return "empty";
        }else{
            if($username==""){
                $username = "Anonymous";
            }
            $question->replies()->create([
                'question_id' => $question_id,
                'rep_content' => $reply,
                'user_name' => $username
            ]);
        }
        return response()->json($event->id);
        return redirect()->back();
    }
    
}
