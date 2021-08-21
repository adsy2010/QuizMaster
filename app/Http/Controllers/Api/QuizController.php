<?php

namespace App\Http\Controllers\Api;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Quiz::withCount('questions')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $quiz = new Quiz;
        $quiz->fill($request->all());
        $quiz->user_id = Auth::id();
        $quiz->save();
        return response()->json($quiz);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        $quiz = Quiz::find($request->quiz);
        return response()->json($quiz->load('questions'));
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
        $quiz = Quiz::find($request->quiz);
        $quiz->fill($request->all());
        $quiz->save();
        return response()->json($quiz);
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
        $quiz = Quiz::find($request->quiz);
        if(!empty($quiz)) {
            $result = $quiz->delete();
        } else {
            $result = false;
        }
        return response()->json($result);
    }
}
