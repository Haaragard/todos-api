<?php

namespace Tests\Unit;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_register_a_todo_list()
    {
        $user = User::factory()->create();

        $todoListData = TodoList::factory()->raw();

        $user->todoLists()->create($todoListData);

        $this->assertDatabaseHas(TodoList::class, $todoListData);
    }
}
