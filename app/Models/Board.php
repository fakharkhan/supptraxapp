<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Board extends Model
{
    protected $fillable = [
        'board_id',
        'name',
    ];

    protected $casts = [
        'board_id' => 'integer',
    ];

    public function claimComments(): HasMany
    {
        return $this->hasMany(ClaimComment::class);
    }
}
