<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_view_todos()
    {
        $todoList = $this->createTodoList();

        $this->get($todoList->todosPath())
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_cannot_create_a_todo()
    {
        $todoList = $this->createTodoList();
        $todo = $this->createTodo(null, $todoList);

        $this->get(route('todo-lists.show.todos.store', ['todoList' => $todoList->id]), $todo->toArray())
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function can_view_todos()
    {
        $this->signIn();

        $todoList = $this->createTodoList(null, auth()->user());
        $todos = $this->createTodo(10, $todoList);

        $this->get($todoList->todosPath())
            ->assertOk()
            ->assertJson($todos->toArray());
    }

    /** @test */
    public function can_register_a_todo()
    {
        $this->signIn();

        $todoList = $this->createTodoList(null, auth()->user());

        $todo = Todo::factory()->raw();

        $this->post(route('todo-lists.show.todos.store', ['todoList' => $todoList->id]), $todo)
            ->assertCreated()
            ->assertJson($todo);

        $this->assertDatabaseHas(Todo::class, $todo);
    }

    /** @test */
    public function cannot_register_a_todo_without_title()
    {
        $this->signIn();

        $todoList = $this->createTodoList(null, auth()->user());

        $todo = Todo::factory()->raw(['title' => '']);

        $this->post(route('todo-lists.show.todos.store', ['todoList' => $todoList->id]), $todo)
            ->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function cannot_register_a_todo_without_description()
    {
        $this->signIn();

        $todoList = $this->createTodoList(null, auth()->user());

        $todo = Todo::factory()->raw(['description' => '']);

        $this->post(route('todo-lists.show.todos.store', ['todoList' => $todoList->id]), $todo)
            ->assertSessionHasErrors(['description']);
    }

    /** @test */
    public function can_view_a_todo()
    {
        $todo = Todo::factory()->create();

        $this->get($todo->path())
            ->assertExactJson($todo->toArray());
    }

    /** @test */
    public function cannot_view_an_unnexistent_todo()
    {
        $todo = Todo::factory()->makeOne(['id' => 1]);

        $this->get($todo->path())
            ->assertNotFound();
    }
}
