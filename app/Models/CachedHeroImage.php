<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CachedHeroImage extends Model
{
    protected $fillable = [
        'pexels_id',
        'url',
        'photographer',
        'photographer_url',
        'alt_text',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime'
    ];

    public function isExpired()
    {
        return $this->expires_at->isPast();
    }
}
