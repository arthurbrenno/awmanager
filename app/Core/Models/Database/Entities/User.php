<?php

namespace App\Core\Models\Database\Entities;

use AllowDynamicProperties;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];
    public $timestamps = true;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'user_id');
    }
}