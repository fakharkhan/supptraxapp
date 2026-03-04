<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Claim extends Model
{
    protected $fillable = [
        'location_id',
        'claimant',
        'claim_date',
        'submission_date',
        'funding_date',
        'status_id',
        'insurance_company_id',
        'adjuster_id',
        'adjuster_phone',
        'claim_handler',
        'client',
    ];

    protected $casts = [
        'claim_date' => 'date',
        'submission_date' => 'date',
        'funding_date' => 'date',
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
}
