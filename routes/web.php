<?php

use App\Http\Controllers\MainPageController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome',[
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('results',[MainPageController::class,'index']);
Route::get('results/{id}',[MainPageController::class,'getResults'])->name('results');
Route::get('all_results/{id}',[MainPageController::class,'getPolls']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix'=>'polls'],function (){
        Route::get('/', [PollController::class, 'index'])->name('polls.index');
        Route::get('/create', [PollController::class, 'create'])->name('polls.create');
        Route::post('/store', [PollController::class, 'store'])->name('polls.store');
        Route::get('/view/{id}', [PollController::class, 'view'])->name('polls.view');
    });
    Route::group(['prefix'=>'votes'],function (){
        Route::post('/store',[VoteController::class,'store']);
    });
});

require __DIR__.'/auth.php';
