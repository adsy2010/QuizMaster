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

Route::prefix('auth/api')->middleware('auth')->group(function() {
    Route::resource('quiz', App\Http\Controllers\Api\QuizController::class)->except('create', 'edit');
    Route::resource('question', App\Http\Controllers\Api\QuestionController::class)->except('index', 'create', 'edit');
    Route::get('my-questions',[App\Http\Controllers\Api\QuestionController::class, 'myIndex'])->name('my.question.index');
    Route::resource('quizQuestion', App\Http\Controllers\Api\QuizQuestionController::class)->only('store', 'destroy');
});
