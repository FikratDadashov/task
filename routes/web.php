<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\RightController;
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

//User
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/create', [UserController::class, 'create']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/{id}/edit', [UserController::class, 'edit']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

//Module
Route::get('/module', [ModuleController::class, 'index']);
Route::get('/module/create', [ModuleController::class, 'create']);
Route::post('/module', [ModuleController::class, 'store']);
Route::get('/module/{id}/edit', [ModuleController::class, 'edit']);
Route::put('/module/{id}', [ModuleController::class, 'update']);
Route::delete('/module/{id}', [ModuleController::class, 'destroy']);

//Function
Route::get('/function', [FunctionController::class, 'index']);
Route::get('/function/create', [FunctionController::class, 'create']);
Route::post('/function', [FunctionController::class, 'store']);
Route::get('/function/{id}/edit', [FunctionController::class, 'edit']);
Route::put('/function/{id}', [FunctionController::class, 'update']);
Route::delete('/function/{id}', [FunctionController::class, 'destroy']);

//Group
Route::get('/group', [GroupController::class, 'index']);
Route::get('/group/create', [GroupController::class, 'create']);
Route::post('/group', [GroupController::class, 'store']);
Route::get('/group/{id}/edit', [GroupController::class, 'edit']);
Route::put('/group/{id}', [GroupController::class, 'update']);
Route::delete('/group/{id}', [GroupController::class, 'destroy']);
Route::get('group/{id}/users', [GroupController::class, 'users']);
Route::post('group/{id}/attach_users', [GroupController::class, 'attach_users']);
Route::post('group/{id}/detach_users', [GroupController::class, 'detach_users']);

//Right
Route::get('/right', [RightController::class, 'index']);
Route::get('/right/edit', [RightController::class, 'edit']);
Route::post('/right/update', [RightController::class, 'update']);
Route::get('right/ajax/fetch-rights', [RightController::class, 'fetch_rights']);
Route::get('/right/ajax/delete_right', [RightController::class, 'delete_right']);
