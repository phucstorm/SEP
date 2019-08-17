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
        event(new FormSubmitted());
        return redirect()->back();
    }

    public function denied($id){
        $qt = Question::find($id)->delete();
        event(new FormSubmitted());
        return redirect()->back();
    }

    public function getQuestion(){
        
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

        $question_id = request()->get('question-id');
        $reply = request()->get('reply');
        $question = Question::find($question_id);
        $username = Auth::user()->name;
        $userid = Auth::user()->id;
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
        event(new FormSubmitted());
        // return redirect()->back();
    }

    public function unlike_question($question_id){
        $ques = Question::find($question_id);
        $ques->like -= 1;
        $ques->save();
        $likes = $ques->like;
        // return response()->json($likes);
        event(new FormSubmitted());
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
