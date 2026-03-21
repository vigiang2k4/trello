<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'workspace_id',
        'task_id',
        'comment'
    ];

}
