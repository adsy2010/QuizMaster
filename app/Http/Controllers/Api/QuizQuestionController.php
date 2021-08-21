<?php

namespace App\Http\Controllers\Api;

use App\Models\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends ApiController
{

    /**
     * @param Request $request
     * @return QuizQuestion
     */
    public function store(Request $request)
    {
        $quizQuestion = new QuizQuestion();
        $quizQuestion->fill($request->all());
        $quizQuestion->save();
        return response()->json($quizQuestion);
    }

    /**
     * @param QuizQuestion $quizQuestion
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $quizQuestion = QuizQuestion::find($request->quizQuestion);
        if(!empty($quizQuestion)) {
            $result = $quizQuestion->delete();
        } else {
            $result = false;
        }
        return response()->json($result);
    }
}
