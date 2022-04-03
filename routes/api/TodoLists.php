<?php

use App\Http\Controllers\{
    ListTodoListsController,
    ShowTodoListController,
    StoreTodoListController
};
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '/todo-lists',
    'middleware' => 'auth'
], function () {
    Route::get('/', ListTodoListsController::class)
        ->name('todo-lists');

    Route::post('/', StoreTodoListController::class)
        ->name('todo-lists.store');

    Route::get('/{todoList}', ShowTodoListController::class)
        ->name('todo-lists.show')
        ->can('view', 'todoList');
});
