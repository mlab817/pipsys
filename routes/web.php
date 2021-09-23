<?php

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

Route::redirect('/','/login');

Route::group(['middleware' => ['auth','activated']], function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class,'index'])->name('home');
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('projects', \App\Http\Controllers\ProjectController::class);
});

Auth::routes();
