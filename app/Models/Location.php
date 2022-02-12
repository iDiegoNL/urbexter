<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Location extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
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

    /**
     * Get the reports of this location.
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->crop('crop-center', 397, 223)
            ->format('jpg');

        $this->addMediaConversion('small')
            ->quality(90)
            ->format('jpg');
    }
}
