<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClaimFollowUp extends Model
{
    protected $fillable = [
        'claim_id',
        'follow_up_date',
        'note',
    ];

    protected $casts = [
        'follow_up_date' => 'date',
    ];

    public function claim(): BelongsTo
    {
        return $this->belongsTo(Claim::class);
    }
}
