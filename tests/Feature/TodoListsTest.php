<?php

namespace Tests\Feature;

use App\Models\TodoList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_view_todo_lists()
    {
        $this->get(route('todo-lists'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function can_view_todo_lists()
    {
        $this->signIn();

        $todoList = auth()->user()
            ->todoLists()
            ->create(
                TodoList::factory()->raw()
            );

        $this->get(route('todo-lists'))
            ->assertOk()
            ->assertJsonFragment($todoList->toArray());
    }
}
