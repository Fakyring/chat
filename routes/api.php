<?php

use App\Http\Controllers\Api\V1\ConversationsController;
use App\Http\Controllers\Api\V1\MessagesController;
use App\Http\Controllers\Api\V1\UsersController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1\UserConversController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::apiResource('users', UsersController::class);
    Route::apiResource('messages', MessagesController::class);
    Route::apiResource('conversations', ConversationsController::class);
    Route::apiResource('userconvers', UserConversController::class);
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
