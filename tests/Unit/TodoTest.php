<?php

namespace Tests\Unit;

use App\Models\Todo;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_register_a_todo()
    {
        $user = User::factory()->create();
        $todoList = $user->todoLists()->create(TodoList::factory()->raw());
        $todo = $todoList->todos()->create(Todo::factory()->raw());

        $this->assertDatabaseHas(Todo::class, $todo->toArray());
    }
}
