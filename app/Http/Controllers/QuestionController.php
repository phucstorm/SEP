<?php

namespace App\Http\Controllers;

use App\Question;
use App\Event;
use App\Reply;
use App\Events\LikeQuestion;
use App\Events\UnlikeQuestion;
use Illuminate\Http\Request;
use App\Events\FormSubmitted;
use Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function accept($id){
        $qt = Question::find($id);
        $qt->status = 1;
        $qt->save();
        event(new FormSubmitted($qt->id,$qt->content, $qt->user_name, $qt->event_id,$qt->created_at));
        return redirect()->back();
    }

    public function denied($id){
        $qt = Question::find($id)->delete();
        return redirect()->back();
    }

    public function reply_question(){

        $question_id = $_POST['question-id'];
        $reply = $_POST['reply'];
        $question = Question::find($question_id);
        $username = $_POST['username'];
        $userid = $_POST['userid'];
        $question->replies()->create([
            'question_id' => $question_id,
            'rep_content' => $reply,
            'user_name' => $username,
            'user_id' => $userid
        ]);

        
        return redirect()->back();
    }

    public function like_question($question_id){
        $ques = Question::find($question_id);
        $ques->like += 1;
        $ques->save();

        $likes = $ques->like;
        // return response()->json($likes);
        event(new LikeQuestion($question_id, $likes));
        // return redirect()->back();
    }

    public function unlike_question($question_id){
        $ques = Question::find($question_id);
        $ques->like -= 1;
        $ques->save();
        $likes = $ques->like;
        // return response()->json($likes);
        event(new LikeQuestion($question_id, $likes));
        // return redirect()->back();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // $room = Question::where('event_id', '=', $request->event_id);

        // return "show room";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
