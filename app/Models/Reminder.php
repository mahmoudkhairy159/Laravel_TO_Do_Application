<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;
    // Define fillable fields
    protected $fillable = [
        'task_id',
        'reminder_time',
    ];

    // Define relationship with Task model
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
