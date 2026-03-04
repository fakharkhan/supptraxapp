<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganizationUser extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationUserFactory> */
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'user_name',
        'user_email',
        'type',
        'is_chaser',
        'is_closer',
        'claims_count',
    ];

    protected function casts(): array
    {
        return [
            'is_chaser' => 'boolean',
            'is_closer' => 'boolean',
            'claims_count' => 'integer',
        ];
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
