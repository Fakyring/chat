<?php

use App\Http\Controllers\Api\V1\ConversationsController;
use App\Http\Controllers\Api\V1\MessagesController;
use App\Http\Controllers\Api\V1\UsersController;
use Illuminate\Support\Facades\Route;

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
});
