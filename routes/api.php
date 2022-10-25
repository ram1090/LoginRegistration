<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\API\AuthenticateUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[AuthenticateUserController::class,'authenticate']);
Route::middleware(['auth:sanctum'])->post('logout',[AuthenticateUserController::class,'logout']);

Route::middleware(['auth:sanctum'])->prefix('todo')->group(function () {
    Route::post("add",[TaskController::class,'store']);
    Route::post("status",[TaskController::class,'status']);

    Route::put("update/{id}",[TaskController::class,'update']);
    Route::delete("delete/{id}",[TaskController::class,'delete']);
});