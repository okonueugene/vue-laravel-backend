<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTask extends Model
{
    use HasFactory ;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'task_id',
        'status_id',
        'remarks',
        'due_date',
        'start_time',
        'end_time',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
