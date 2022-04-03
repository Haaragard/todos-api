<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Models\Todo;
use App\Models\TodoList;
use App\Services\StoreTodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreTodoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(
        StoreTodoRequest $request,
        TodoList $todoList,
        StoreTodoService $storeService
    ) {
        $this->authorize('create', [Todo::class, $todoList]);
        return $storeService->execute($todoList, $request->only('title', 'description'));
    }
}
