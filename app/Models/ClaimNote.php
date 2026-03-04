<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClaimNote extends Model
{
    protected $fillable = [
        'claim_id',
        'author',
        'text',
        'commented_at',
    ];

    protected $casts = [
        'commented_at' => 'datetime',
    ];

    public function claim(): BelongsTo
    {
        return $this->belongsTo(Claim::class);
    }
}
