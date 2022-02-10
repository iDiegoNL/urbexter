<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationAlias extends Model
{
    use HasFactory;

    /**
     * Get the location that the alias belongs to.
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
