<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClaimComment extends Model
{
    protected $fillable = [
        'board_id',
        'page',
        'index',
        'author',
        'text',
        'commented_at',
        'source_file',
    ];

    protected $casts = [
        'board_id' => 'integer',
        'page' => 'integer',
        'index' => 'integer',
        'commented_at' => 'datetime',
    ];

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class);
    }
}
