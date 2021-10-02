<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')
    ->get('/projects/search', [\App\Http\Controllers\Api\ProjectController::class,'index'])
    ->name('api.projects.search');

//    function(Request $request) {
//    return response()->json($request->user());
////    return '<li role="option" class="autocomplete-item" data-autocomplete-value="bb8">BB-8 (astromech)</li>';
//})->name('api.projects.search');

Route::get('/pdp_indicators/{id}', function ($id) {
    return response()->json(\App\Models\RefPdpIndicator::with('children.children')
        ->where('ref_pdp_chapter_id', $id)
        ->first());
});

Route::get('/pdp_indicators', function () {
    return response()->json(\App\Models\RefPdpIndicator::with('children.children')
        ->whereNull('parent_id')
        ->get());
});
