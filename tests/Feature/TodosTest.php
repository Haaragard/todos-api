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
        $todo = Todo::factory()->create();

        $this->assertDatabaseHas(Todo::class, $todo->toArray());
    }
}
