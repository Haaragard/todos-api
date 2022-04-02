<?php

namespace Tests\Unit;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_register_a_todo()
    {
        $todo = Todo::factory()->create();

        $this->assertDatabaseHas(Todo::class, $todo->toArray());
    }
}
