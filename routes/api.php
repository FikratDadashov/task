<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LanguageController;

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

//News
Route::get('/', [NewsController::class, 'index']);
Route::get('news', [NewsController::class, 'index']);
Route::get('news/{id}', [NewsController::class, 'show']);
Route::post('news/store', [NewsController::class, 'store']);
Route::put('news/{id}/update', [NewsController::class, 'update']);
Route::delete('news/{id}/', [NewsController::class, 'destroy']);

//Language
Route::get('language', [LanguageController::class, 'index']);
Route::post('language/store', [LanguageController::class, 'store']);
Route::delete('language/{id}', [LanguageController::class, 'destroy']);
Route::put('language/{id}/update', [LanguageController::class, 'update']);

