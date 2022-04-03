<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TodoList extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path(): string
    {
        return route('todo-lists.show', ['todoList' => $this->id]);
    }

    public function todosPath(): string
    {
        return route('todo-lists.show.todos', ['todoList' => $this->id]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }
}
