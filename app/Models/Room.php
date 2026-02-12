<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    // Permitem salvarea datelor
    protected $guarded = [];

    /**
     * Legătura dintre Cameră și Sediu
     * O cameră aparține de UN SINGUR sediu.
     */
    public function headquarter(): BelongsTo
    {
        return $this->belongsTo(Headquarter::class);
    }
}