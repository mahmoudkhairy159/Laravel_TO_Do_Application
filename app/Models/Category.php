<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Filterable;
    protected $fillable = [
        'name',
        'user_id',
    ];

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with Task model (if tasks belong to categories)
    public function tasks()
    {
        return $this->hasMany(Task::class, 'category_id');
    }
}
