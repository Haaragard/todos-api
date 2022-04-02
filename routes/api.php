<?php

use App\Http\Controllers\ListTodosController;
use App\Http\Controllers\RegisterTodoController;
use App\Http\Controllers\ShowTodoController;
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

Route::get('/todos', ListTodosController::class)
    ->name('todos');

Route::post('/todos', RegisterTodoController::class)
    ->name('todos.store');

Route::get('/todos/{todo}', ShowTodoController::class)
    ->name('todos.show');
