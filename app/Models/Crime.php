<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Crime extends Model
{
    protected $fillable = [
        'barangay_id',
        'type',
        'description',
        'date',
        'risk_level',
        'latitude',
        'longitude',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class);
    }
}
