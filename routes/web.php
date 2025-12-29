<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Admin\QuestionController;
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

Route::get('/', [QuizController::class, 'index'])->name('home');
Route::post('/start', [QuizController::class, 'start'])->name('quiz.start');
Route::get('/quiz', [QuizController::class, 'quiz'])->name('quiz.show');
Route::post('/submit', [QuizController::class, 'submit'])->name('quiz.submit');

Route::middleware(['admin.basic'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.questions.index');
    })->name('dashboard');
    Route::resource('questions', QuestionController::class)->except(['show']);
});
