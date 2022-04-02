<?php

namespace Database\Seeders;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function (User $user) {
            $user->todoLists()
                ->createMany(
                    TodoList::factory(10)->raw()
                );
        });
    }
}
