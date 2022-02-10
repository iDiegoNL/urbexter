<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image_path',
        'country',
        'build_year',
        'abandoned_year',
        'demolished_year',
        'reconverted_year',
        'location_status_id'
    ];

    /**
     * Get the aliases for the location.
     */
    public function aliases(): HasMany
    {
        return $this->hasMany(LocationAlias::class);
    }

    /**
     * Get the status that the location has.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(LocationStatus::class, 'location_status_id');
    }

    public function getImageUrl(): string
    {
        if (!$this->image_path) {
            return 'https://via.placeholder.com/397x223?text=No+image+available';
        }

        return Storage::url($this->image_path);
    }
}
