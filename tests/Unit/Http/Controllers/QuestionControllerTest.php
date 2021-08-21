<?php

namespace Http\Controllers;

use App\Http\Controllers\QuestionController;
use App\Models\User;
//use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
{

    public function testLoginAndSeed()
    {

        $this->seed();

        $user = User::first();
        auth()->loginUsingId($user->id);

        $this->assertNotNull(auth()->id());

    }

    public function testShow()
    {
        $this->testLoginAndSeed();
    }

    public function testEdit()
    {
        $this->testLoginAndSeed();
    }

    public function testCreate()
    {
        $this->testLoginAndSeed();
    }

    public function testIndex()
    {
        $this->testLoginAndSeed();
    }
}
