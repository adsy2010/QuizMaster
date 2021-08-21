<?php

namespace Http\Controllers\Api;

use App\Http\Controllers\Api\QuizQuestionController;
use App\Models\QuizQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
//use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class QuizQuestionControllerTest extends TestCase
{

    use RefreshDatabase;

    private $loggedInAndSeeded = false;

    public function loginAndSeed()
    {
        if(!$this->loggedInAndSeeded) {
            $this->seed();

            Auth::loginUsingId(1);

            $this->loggedInAndSeeded = true;
        }
    }

    public function testStore()
    {
        $this->loginAndSeed();

        $request = Request::create('/auth/api/quizQuestion', 'POST', [
            'quiz_id' => 1,
            'question_id' => 1
        ]);

        $controller = new QuizQuestionController();

        $response = $controller->store($request);

        $this->assertEquals(200, $response->getStatusCode());

        $expected = QuizQuestion::where('quiz_id', '=', 1)->where('question_id', '=', 1)->first();
        $this->assertNotNull($expected);

        return $expected->id;
    }

    public function testDestroy()
    {
        $this->loginAndSeed();

        $id = $this->testStore(); //insert

        $request = Request::create('/auth/api/quizQuestion', 'DELETE', [
            'quizQuestion' => $id
        ]);

        $controller = new QuizQuestionController();

        $expected = QuizQuestion::find($id);

        $response = $controller->destroy($request);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertSoftDeleted($expected);
    }
}
