<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'status_id',
        'name',
        'description',
        'due_date',
    ];

    /**
     * Get the status that owns the task.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the user tasks for the task.
     */
    public function userTasks()
    {
        return $this->hasMany(UserTask::class);
    }
}
