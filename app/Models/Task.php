<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name',
        'is_completed',
        'due_date'
    ];

    protected $casts = [
        'due_date' => 'datetime', // Cast due_date to a Carbon instance
    ];
}
