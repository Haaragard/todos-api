<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\TodoList;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models from a specific todoList.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user, TodoList $todoList)
    {
        return $user->id === $todoList->user_id;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Todo $todo)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, TodoList $todoList)
    {
        return $user->id === $todoList->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Todo $todo)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Todo $todo)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Todo $todo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Todo $todo)
    {
        //
    }
}
