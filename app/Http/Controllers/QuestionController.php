<?php

namespace App\Http\Controllers;

use App\Question;
use App\Event;
use Illuminate\Http\Request;
use App\Events\FormSubmitted;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct(){
    //     $this->middleware('guest');
    // }
    public function postQuestion(Request $request){
        $question = request()->question;
        if($question == ""){
            return redirect()->back()->with('alert','You must type question'); 
            
        }else{
            if(request()->user_name != ""){
                $user_name = request()->user_name;
            }else{
                $user_name = "Anonymus";
            }
            $qt = new Question;
            $qt->event_id = request()->event_id;
            $qt->content = $question;
            $qt->user_name = $user_name;
            $qt->status = 0;
            $qt->save();
            event(new FormSubmitted($qt->id,$qt->content, $user_name, request()->event_id, $qt->created_at));
            return redirect()->back();
        } 
    }

    public function accept($id){
        $qt = Question::find($id);
        $qt->status = 1;
        $qt->save();
        event(new FormSubmitted($qt->id,$qt->content, $qt->user_name, $qt->event_id,$qt->created_at));
        return redirect()->back();
    }

    public function denied(Request $request){
        $qt = Question::find($request->id)->delete();
        return redirect()->back();
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
