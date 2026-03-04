<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Adjuster extends Model
{
    protected $fillable = [
        'name',
        'company_name',
        'email',
        'phone_number',
        'insurance_company_id',
    ];

    public function insuranceCompany(): BelongsTo
    {
        return $this->belongsTo(InsuranceCompany::class);
    }
}
