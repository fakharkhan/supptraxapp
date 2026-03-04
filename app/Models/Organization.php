<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'sales_representative_id',
        'status',
        'date_of_registration',
        'organization_address',
        'organization_zip',
        'organization_state',
        'billing_address',
        'billing_zip',
        'billing_state',
        'contact_full_name',
        'contact_phone',
        'contact_email',
    ];

    protected $casts = [
        'date_of_registration' => 'date',
    ];

    public function salesRepresentative(): BelongsTo
    {
        return $this->belongsTo(SalesRepresentative::class);
    }

    public function organizationUsers(): HasMany
    {
        return $this->hasMany(OrganizationUser::class);
    }
}
