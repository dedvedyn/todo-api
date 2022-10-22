<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::get('/tasks',          [TaskController::class, 'index']);
Route::get('/task',           [TaskController::class, 'show']);
Route::post('/task/add',      [TaskController::class, 'store']);
Route::put('/task/update',    [TaskController::class, 'update']);
Route::delete('/task/delete', [TaskController::class, 'destroy']);

Route::get('/users',          [UserController::class, 'index']);
Route::post('/user/add',      [UserController::class, 'store']);
Route::put('/user/update',    [UserController::class, 'update']);
Route::delete('/user/delete', [UserController::class, 'destroy']);
