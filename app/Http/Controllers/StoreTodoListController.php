<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoListRequest;
use App\Services\StoreTodoListService;
use Illuminate\Http\Request;

class StoreTodoListController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreTodoListRequest $request, StoreTodoListService $storeService)
    {
        return $storeService->execute(
            $request->only('name')
        );
    }
}
