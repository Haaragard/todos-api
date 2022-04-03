<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\TodoList;
use Illuminate\Http\Request;

class ListTodosController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(TodoList $todoList)
    {
        return response($todoList->todos);
    }
}
