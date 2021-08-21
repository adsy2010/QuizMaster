<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('quiz', App\Http\Controllers\QuizController::class)->only('index', 'show', 'create', 'edit')->names([
    'index' => 'quiz.index.view',
    'show' => 'quiz.show.view',
    'create' => 'quiz.create.view',
    'edit' => 'quiz.edit.view'
]);
Route::resource('question', App\Http\Controllers\QuestionController::class)->only('index', 'edit', 'create')->names([
    'index' => 'question.index',
    'edit' => 'question.edit',
    'create' => 'question.create'
]);

Route::prefix('auth/api')->middleware('auth')->group(function() {
    Route::resource('quiz', App\Http\Controllers\Api\QuizController::class)->except('create', 'edit');
    Route::resource('question', App\Http\Controllers\Api\QuestionController::class)->except('index', 'create', 'edit');
    Route::get('my-questions',[App\Http\Controllers\Api\QuestionController::class, 'myIndex'])->name('my.question.index');
    Route::resource('quizQuestion', App\Http\Controllers\Api\QuizQuestionController::class)->only('store', 'destroy');
});
