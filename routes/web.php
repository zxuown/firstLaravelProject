<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/search', [HomeController::class, 'search'])->name('home.search');


Route::get('/test', [TestController::class, 'index'])->name('profile.edit');
Route::get('/dashboard', function () {

   return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/change-language/{language}', [\App\Http\Controllers\LanguageController::class, 'changeLanguage']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/questions', [\App\Http\Controllers\QuestionController::class, 'index'])->name('questions.index');
    Route::get('/question/{question}/edit', [\App\Http\Controllers\QuestionController::class, 'edit'])->name('questions.edit');
    Route::post('/question/{question}/update', [\App\Http\Controllers\QuestionController::class, 'update'])->name('questions.update');
    Route::get('/questions/create', [\App\Http\Controllers\QuestionController::class, 'create'])->name('questions.create');
    Route::post('/question/store', [\App\Http\Controllers\QuestionController::class, 'store'])->name('questions.store');
 });
 Route::middleware('auth')->group(function () {
    Route::get('/options/{question}', [\App\Http\Controllers\OptionsController::class, 'index'])->name('options.index');
    Route::get('/options/{options}/edit', [\App\Http\Controllers\OptionsController::class, 'edit'])->name('options.edit');
    Route::post('/options/{options}/update', [\App\Http\Controllers\OptionsController::class, 'update'])->name('options.update');
    Route::get('/options/{question}/create', [\App\Http\Controllers\OptionsController::class, 'create'])->name('options.create');
    Route::post('/options/store', [\App\Http\Controllers\OptionsController::class, 'store'])->name('options.store');
 });
 Route::middleware('auth')->group(function () {
   Route::get('/vote/{questionId}/res', [\App\Http\Controllers\VoteController::class, 'res'])->name('vote.res');
    Route::get('/vote/{question}/', [\App\Http\Controllers\VoteController::class, 'index'])->name('vote.index');
    Route::post('/vote/{question}/{options}', [\App\Http\Controllers\VoteController::class, 'store'])->name('vote.store');
    
 });
require __DIR__.'/auth.php';
