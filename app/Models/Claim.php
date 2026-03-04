<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Claim extends Model
{
    protected $fillable = [
        'location_id',
        'claimant',
        'claim_number',
        'description',
        'claim_date',
        'submission_date',
        'funding_date',
        'status_id',
        'priority',
        'insurance_company_id',
        'adjuster_id',
        'adjuster_phone',
        'address',
        'claim_handler',
        'client',
        'settlement_amount',
        'original_cost_value',
        'supplement_increase',
    ];

    protected $casts = [
        'claim_date' => 'date',
        'submission_date' => 'date',
        'funding_date' => 'date',
        'settlement_amount' => 'decimal:2',
        'original_cost_value' => 'decimal:2',
        'supplement_increase' => 'decimal:2',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function insuranceCompany(): BelongsTo
    {
        return $this->belongsTo(InsuranceCompany::class);
    }

    public function adjuster(): BelongsTo
    {
        return $this->belongsTo(Adjuster::class);
    }

    public function followUps(): HasMany
    {
        return $this->hasMany(ClaimFollowUp::class)->orderBy('follow_up_date');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(ClaimNote::class)->orderByDesc('commented_at');
    }
}
