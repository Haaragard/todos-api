<?php

namespace Tests;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn()
    {
        $this->actingAs($this->createUser());
    }

    public function createUser(?int $quantity = null): User|Collection
    {
        return User::factory($quantity)->create();
    }

    public function createTodoList(?int $quantity = null, ?User $user = null): TodoList|Collection
    {
        $user = $user ?? $this->createUser();

        if (is_null($quantity)) {
            return $user->todoLists()
                ->create(TodoList::factory()->raw());
        }

        return $user->todoLists()
            ->createMany(TodoList::factory($quantity)->raw());
    }
}
