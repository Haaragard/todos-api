<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterTodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class RegisterTodoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterTodoRequest $request)
    {
        $todo = Todo::create($request->only(
            'title',
            'description'
        ));

        return response($todo, 201);
    }
}
