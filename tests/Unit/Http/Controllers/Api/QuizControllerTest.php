<?php

namespace Http\Controllers\Api;

use App\Http\Controllers\Api\QuizController;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
//use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class QuizControllerTest extends TestCase
{
    use RefreshDatabase;


    public function testLoginAndSeed()
    {

        $this->seed();

        $user = User::first();
        auth()->loginUsingId($user->id);

        $this->assertNotNull(auth()->id());

    }

    public function testUpdate()
    {
        $this->testLoginAndSeed();

        $id = $this->testStore();

        $request = Request::create("/auth/api/quiz", 'PATCH', [
            'quiz' => $id,
            'name' => 'new name'
        ]);

        $controller = new QuizController();

        $response = $controller->update($request);

        $quiz = Quiz::find($id);

        $this->assertEquals('new name', $quiz->name);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testShow()
    {
        $this->testLoginAndSeed();

        $id = $this->testStore();

        $request = Request::create("/auth/api/quiz", 'GET', [
            'quiz' => $id
        ]);

        $controller = new QuizController();

        $response = $controller->show($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testIndex()
    {
        $this->testLoginAndSeed();

        $controller = new QuizController();

        $response = $controller->index();

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDestroy()
    {
        $this->testLoginAndSeed();

        $id = $this->testStore(); //insert

        $request = Request::create('/auth/api/quiz', 'DELETE', [
            'quiz' => $id
        ]);

        $controller = new QuizController();

        $expected = Quiz::find($id);

        $response = $controller->destroy($request);

        $this->assertEquals(200, $response->getStatusCode());

        $this->assertSoftDeleted($expected);
    }

    public function testStore()
    {
        $this->testLoginAndSeed();

        $request = Request::create('/auth/api/quiz', 'POST', [
            'user_id' => auth()->id(),
            'name' => 'Country quiz'
        ]);

        $controller = new QuizController();

        $response = $controller->store($request);

        $this->assertEquals(200, $response->getStatusCode());

        $expected = Quiz::where([
            ['user_id', '=', auth()->id()],
            ['name', '=', 'Country quiz']
            ])->first();
        $this->assertNotNull($expected);

        return $expected->id;
    }
}
