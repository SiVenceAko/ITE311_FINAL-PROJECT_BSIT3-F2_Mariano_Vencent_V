<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barangay extends Model
{
    protected $fillable = ['name'];

    public function crimes(): HasMany
    {
        return $this->hasMany(Crime::class);
    }
}
