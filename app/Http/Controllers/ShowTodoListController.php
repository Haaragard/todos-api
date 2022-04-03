<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowTodoListRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;

class ShowTodoListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(TodoList $todoList)
    {
        return response($todoList);
    }
}
