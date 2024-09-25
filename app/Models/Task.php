<?php

namespace App\Models;

use Carbon\Carbon;
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
    public function getDueDateAttribute($value)
    {
        // Convert the date from Y-m-d to m/d/Y
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format('m/d/Y') : null;
    }
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
