<?php

use App\Http\Controllers\TelegramUserController;
use App\Http\Controllers\TelegramUserTaskController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('telegram-users', TelegramUserController::class);

Route::prefix('telegram-user-tasks')->group(function () {
    Route::get('/user/{userId}', [TelegramUserTaskController::class, 'index']);
    Route::post('/', [TelegramUserTaskController::class, 'store']);
    Route::put('/{id}/status', [TelegramUserTaskController::class, 'updateStatus']);
});