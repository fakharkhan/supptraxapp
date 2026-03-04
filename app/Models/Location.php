<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'total_claims',
        'show_board',
    ];

    protected $casts = [
        'total_claims' => 'integer',
        'show_board' => 'boolean',
    ];
}
