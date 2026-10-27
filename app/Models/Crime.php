<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crime extends Model
{
    protected $fillable = ['barangay_id', 'type', 'description', 'date'];

    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
}