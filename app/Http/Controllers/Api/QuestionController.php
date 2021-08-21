<?php

namespace App\Http\Controllers\Api;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends ApiController
{
    /**
     * @return mixed
     */
    public function myIndex()
    {
        return Question::where('user_id', '=', Auth::id())->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question;
        $question->fill($request->all());
        $question->user_id = Auth::id();
        $question->save();
        return  $question;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return $question;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->fill($request->all());
        $question->save();
        return  $question;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //TODO: Delete all related quiz questions
        $question->delete();
    }
}
