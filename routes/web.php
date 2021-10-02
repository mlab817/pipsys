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
    Route::get('/projects/{uuid}/restore', [\App\Http\Controllers\ProjectController::class,'restore'])->name('projects.restore');
    Route::resource('projects', \App\Http\Controllers\ProjectController::class);
});

Auth::routes();

Route::group(['middleware' => 'guest'], function() {
    Route::get('/auth/{driver}', [\App\Http\Controllers\Auth\SocialLoginController::class,'redirectTo'])->name('auth.redirectTo');
    Route::get('/auth/{driver}/callback', [\App\Http\Controllers\Auth\SocialLoginController::class,'handleCallback'])->name('auth.handleCallback');
});
