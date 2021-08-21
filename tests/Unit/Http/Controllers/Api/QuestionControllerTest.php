<?php

namespace Http\Controllers\Api;

use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuizController;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
//use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use function PHPUnit\Framework\assertNotNull;

class QuestionControllerTest extends TestCase
{

    public function testLoginAndSeed()
    {

        $this->seed();

        $user = User::first();
        auth()->loginUsingId($user->id);

        assertNotNull(auth()->id());

    }

    public function testShow()
    {
        $this->testLoginAndSeed();

        $id = $this->testStore();

        $request = Request::create("/auth/api/question", 'GET', [
            'question' => $id
        ]);

        $controller = new QuestionController();

        $response = $controller->show($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testMyIndex()
    {
        $this->testLoginAndSeed();

        $controller = new QuestionController();

        $response = $controller->myIndex();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $this->testLoginAndSeed();

        $id = $this->testStore();

        $request = Request::create("/auth/api/question", 'PATCH', [
            'question' => $id,
            'answer1' => 'Pakistan',
        ]);

        $controller = new QuestionController();

        $response = $controller->update($request);

        $question = Question::find($id);

        $this->assertEquals('Pakistan', $question->answer1);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDestroy()
    {
        $this->testLoginAndSeed();

        $id = $this->testStore(); //insert

        $request = Request::create('/auth/api/question', 'DELETE', [
            'question' => $id
        ]);

        $controller = new QuestionController();

        $expected = Question::find($id);

        $response = $controller->destroy($request);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertSoftDeleted($expected);
    }

    public function testStore()
    {
        $this->testLoginAndSeed();

        $request = Request::create('/auth/api/question', 'POST', [
            'user_id' => auth()->id(),
            'question' => 'Which country is New York in?',
            'answer1' => 'USA',
            'answer2' => 'Canada',
            'answer3' => null,
            'answer4' => null
        ]);

        $controller = new QuestionController();

        $response = $controller->store($request);

        $this->assertEquals(200, $response->getStatusCode());

        $expected = Question::where([
            ['user_id', '=', auth()->id()],
            ['question', '=', 'Which country is New York in?'],
            ['answer1', '=', 'USA'],
            ['answer2', '=', 'Canada'],
            ['answer3', '=', null],
            ['answer4', '=', null],
        ])->first();
        $this->assertNotNull($expected);

        return $expected->id;
    }
}
