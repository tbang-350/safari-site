<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Services\PexelsService;

class Tour extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'duration',
        'location',
        'image_type',
        'image_source',
        'is_featured',
        'max_people',
        'difficulty_level',
        'included_services',
        'excluded_services',
        'itinerary'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'duration' => 'integer',
        'max_people' => 'integer',
        'is_featured' => 'boolean',
        'included_services' => 'array',
        'excluded_services' => 'array',
        'itinerary' => 'array'
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tour) {
            if (empty($tour->slug)) {
                $tour->slug = Str::slug($tour->title);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the tour's image URL
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->image_type === 'pexels') {
            return $this->image_source;
        }

        return $this->image_source ? asset('storage/' . $this->image_source) : null;
    }

    /**
     * Get the tour's thumbnail URL
     *
     * @return string
     */
    public function getThumbnailUrlAttribute()
    {
        if ($this->image_type === 'pexels') {
            // For Pexels images, we'll use the same URL as they're already optimized
            return $this->image_source;
        }

        // For custom uploads, you might want to generate/store thumbnails separately
        return $this->image_source ? asset('storage/' . $this->image_source) : null;
    }
}
