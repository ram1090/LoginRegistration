<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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
    return view('home');
});
Route::middleware(['guest'])->group(function () {
    Route::get('/register',[UserController::class,'registerForm'])->name("registerForm");
    Route::post('/register',[UserController::class,'registerStore'])->name("registerStore");

    Route::get('/login',[UserController::class,'loginForm'])->name("loginForm");
    Route::post('/login',[UserController::class,'loginCheck'])->name("loginCheck");
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/user-profile',[UserController::class,'userProfile'])->name("profile");
    Route::get('/logout',[UserController::class,'logout'])->name("logout");
});