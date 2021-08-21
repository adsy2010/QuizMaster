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
        return response()->json(Question::where('user_id', '=', Auth::id())->get());
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
        return response()->json($question);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $question = Question::find($request->question);
        return response()->json($question);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $question = Question::find($request->question);
        $question->fill($request->all());
        $question->save();
        return response()->json($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        //TODO: Delete all related quiz questions
        $question = Question::find($request->question);
        if(!empty($question)) {
            $result = $question->delete();
        } else {
            $result = false;
        }
        return response()->json($result);
    }
}
