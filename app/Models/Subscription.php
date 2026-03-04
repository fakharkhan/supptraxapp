<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriptionFactory> */
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'created_at_source',
        'subscription_start',
        'subscription_end',
        'subscription_model',
        'status',
    ];

    protected $casts = [
        'created_at_source' => 'date',
        'subscription_start' => 'date',
        'subscription_end' => 'date',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
