<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'board_id',
        'title',
        'description',
        'due_date'
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);
    }

    public function workspace()
    {
        return $this->board->workspace();
    }
}
