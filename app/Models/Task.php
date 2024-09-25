<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'reminder_time',
        'priority',
        'status',
        'user_id',
        'category_id',
    ];

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Define relationship with Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
