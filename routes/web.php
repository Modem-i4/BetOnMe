<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\BetController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
Auth::routes();

App::setLocale('uk-ua');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {return redirect('/bets');});
    Route::get('/bets', [EventController::class, 'index']);
    Route::get('/achievements', [AchievementController::class, 'index']);
    Route::get('/my-events', [EventController::class, 'myEventsIndex']);

    Route::prefix('api')->group(function () {
        Route::get('events', [EventController::class, 'all']);
        Route::get('events/own', [EventController::class, 'own']);
        Route::post('events', [EventController::class, 'add']);
        Route::post('bets', [BetController::class, 'add']);
        Route::get('user/achievements', [UserController::class, 'achievements']);
        Route::patch('user/achievement/progress', [UserController::class, 'progress']);
        Route::get('achievements', [AchievementController::class, 'all']);
    });
});
