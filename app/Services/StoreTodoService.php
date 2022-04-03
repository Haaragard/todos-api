<?php

namespace App\Services;

use App\Models\Todo;
use App\Models\TodoList;

class StoreTodoService
{
    public function execute(TodoList $todoList, array $todoData): Todo
    {
        return $todoList->todos()->create($todoData);
    }
}
