<?php

namespace App\Core\Models\Database\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';

    protected $fillable = ['title', 'description', 'status', 'priority', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}