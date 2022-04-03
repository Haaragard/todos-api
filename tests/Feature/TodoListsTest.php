<?php

namespace Tests\Feature;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_view_todo_lists()
    {
        $this->get(route('todo-lists'))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guests_cannot_view_a_todo_list()
    {
        $user = User::factory()->create();

        $todoList = $user->todoLists()
            ->create(TodoList::factory()->raw());

        $this->get($todoList->path())
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guests_cannot_create_a_todo_list()
    {
        $todoListData = TodoList::factory()->raw();

        $this->post('api/todo-lists', $todoListData)
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

    /** @test */
    public function can_register_a_todo_list()
    {
        $this->signIn();

        $todoListData = TodoList::factory()->raw();

        $this->post('api/todo-lists', $todoListData)
            ->assertCreated()
            ->assertJson($todoListData);

        $this->assertDatabaseHas(TodoList::class, $todoListData);
    }

    /** @test */
    public function cannot_register_a_todo_list_without_name()
    {
        $this->signIn();

        $todoListData = TodoList::factory()->raw(['name' => '']);

        $this->post('api/todo-lists', $todoListData)
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing(TodoList::class, $todoListData);
    }

    /** @test */
    public function can_view_a_todo_list()
    {
        $this->signIn();

        $todoList = auth()->user()
            ->todoLists()
            ->create(TodoList::factory()->raw());

        $this->get($todoList->path())
            ->assertOk()
            ->assertJson($todoList->toArray());
    }

    /** @test */
    public function cannot_view_other_users_todo_list()
    {
        $this->signIn();

        $otherUser = User::factory()->create();

        $todoList = $otherUser->todoLists()
            ->create(TodoList::factory()->raw());

        $this->get($todoList->path())
            ->assertForbidden();
    }
}
