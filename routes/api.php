<?php

use App\Http\Controllers\ListTodosController;
use App\Http\Controllers\ShowTodoController;
use App\Http\Controllers\StoreTodoController;
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

require 'api/TodoLists.php';

Route::prefix('/todos')->group(function () {
    Route::get('/{todo}', ShowTodoController::class)
        ->name('todos.show');
});

Route::get('/todo-lists/{todoList}/todos', ListTodosController::class)
    ->middleware('auth')
    ->name('todo-lists.show.todos');

Route::post('/todo-lists/{todoList}/todos', StoreTodoController::class)
    ->middleware('auth')
    ->name('todo-lists.show.todos.store');
