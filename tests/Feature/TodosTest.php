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
    public function can_view_todos()
    {
        $this->get(route('todos'))
            ->assertOk();
    }

    /** @test */
    public function can_register_a_todo()
    {
        $todo = Todo::factory()->raw();

        $this->post(route('todos.store'), $todo)
            ->assertCreated()
            ->assertJson($todo);

        $this->assertDatabaseHas(Todo::class, $todo);
    }

    /** @test */
    public function cannot_register_a_todo_without_title()
    {
        $todo = Todo::factory()->raw(['title' => '']);

        $this->post(route('todos.store'), $todo)
            ->assertSessionHasErrors(['title']);
    }

    /** @test */
    public function cannot_register_a_todo_without_description()
    {
        $todo = Todo::factory()->raw(['description' => '']);

        $this->post(route('todos.store'), $todo)
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
