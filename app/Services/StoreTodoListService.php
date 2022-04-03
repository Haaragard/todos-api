<?php

namespace App\Services;

use App\Models\TodoList;

class StoreTodoListService
{
    public function execute(array $todoListData): TodoList
    {
        return auth()->user()->todoLists()->create($todoListData);
    }
}
