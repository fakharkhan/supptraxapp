<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesRepresentative extends Model
{
    /** @use HasFactory<\Database\Factories\SalesRepresentativeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'number_of_leads',
        'trial_period',
        'link',
    ];

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
}
