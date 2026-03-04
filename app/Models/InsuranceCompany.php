<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InsuranceCompany extends Model
{
    protected $fillable = [
        'name',
        'location',
        'phone_number',
        'email',
        'adjusters_count',
    ];

    protected $casts = [
        'adjusters_count' => 'integer',
    ];

    public function adjusters(): HasMany
    {
        return $this->hasMany(Adjuster::class);
    }
}
