<?php

namespace App\Models;

use App\Traits\HasNextPreviousTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Report extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasNextPreviousTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'location_id',
        'user_id',
        'visited_at',
        'visit_duration',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'visited_at' => 'datetime',
    ];

    /**
     * Get the location that the report belongs to.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the user that the report belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plainTextDescription(): string
    {
        $html = app(MarkdownRenderer::class)->toHtml($this->description);

        return strip_tags($html);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('card-thumb')
            ->crop('crop-center', 381, 214)
            ->format('jpg');

        $this->addMediaConversion('carousel-thumb')
            ->crop('crop-center', 286, 200)
            ->format('jpg');
    }
}
