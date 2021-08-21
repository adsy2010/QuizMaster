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
        return $quizQuestion;
    }

    /**
     * @param QuizQuestion $quizQuestion
     * @return bool|null
     */
    public function destroy(QuizQuestion $quizQuestion)
    {
        return $quizQuestion->delete();
    }
}
