<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    /**
     * Get the aliases for the location.
     */
    public function aliases(): HasMany
    {
        return $this->hasMany(LocationAlias::class);
    }
}
