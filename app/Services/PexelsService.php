<?php

namespace App\Services;

use App\Models\CachedHeroImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PexelsService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.pexels.com/v1';
    private const CACHE_DURATION = 172800; // 48 hours in seconds
    private const HERO_CACHE_HOURS = 48;

    public function __construct()
    {
        $this->apiKey = config('services.pexels.api_key');
    }

    /**
     * Search for photos using the Pexels API
     *
     * @param string $query
     * @param int $perPage
     * @param int $page
     * @return array
     */
    public function searchPhotos($query, $perPage = 5, $page = 1)
    {
        $cacheKey = "pexels_search_{$query}_{$perPage}_{$page}";

        return Cache::remember($cacheKey, now()->addDays(7), function () use ($query, $perPage, $page) {
            $response = Http::withHeaders([
                'Authorization' => $this->apiKey,
            ])->get("{$this->baseUrl}/search", [
                'query' => $query,
                'per_page' => $perPage,
                'page' => $page,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return [
                'photos' => [],
                'total_results' => 0,
            ];
        });
    }

    /**
     * Get a curated list of photos
     *
     * @param int $perPage
     * @param int $page
     * @return array
     */
    public function getCuratedPhotos($perPage = 15, $page = 1)
    {
        $cacheKey = "pexels_curated_{$perPage}_{$page}";

        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($perPage, $page) {
            $response = Http::withHeaders([
                'Authorization' => $this->apiKey
            ])->get("{$this->baseUrl}/curated", [
                'per_page' => $perPage,
                'page' => $page
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return [
                'photos' => [],
                'total_results' => 0,
                'error' => 'Failed to fetch curated photos from Pexels'
            ];
        });
    }

    /**
     * Get a specific photo by ID
     *
     * @param string $id
     * @return array
     */
    public function getPhoto($id)
    {
        $cacheKey = "pexels_photo_{$id}";

        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($id) {
            $response = Http::withHeaders([
                'Authorization' => $this->apiKey
            ])->get("{$this->baseUrl}/photos/{$id}");

            if ($response->successful()) {
                return $response->json();
            }

            return null;
        });
    }

    public function refreshHeroImages()
    {
        $searches = [
            'african safari wildlife',
            'serengeti animals',
            'tanzania landscape',
            'kilimanjaro mountain'
        ];

        $images = [];
        foreach ($searches as $search) {
            $response = Http::withHeaders([
                'Authorization' => $this->apiKey
            ])->get("{$this->baseUrl}/search", [
                'query' => $search,
                'per_page' => 1,
                'orientation' => 'landscape',
                'size' => 'large' // Request large images for better quality
            ]);

            if ($response->successful()) {
                $photo = $response->json()['photos'][0];
                $images[] = [
                    'pexels_id' => $photo['id'],
                    'url' => $photo['src']['landscape'], // Use landscape format for consistent sizing
                    'photographer' => $photo['photographer'],
                    'photographer_url' => $photo['photographer_url'],
                    'alt_text' => $search,
                    'expires_at' => Carbon::now()->addHours(self::HERO_CACHE_HOURS)
                ];
            }
        }

        // Clear old images and save new ones
        CachedHeroImage::truncate();
        foreach ($images as $image) {
            CachedHeroImage::create($image);
        }

        return CachedHeroImage::all();
    }

    public function getHeroImages()
    {
        $images = CachedHeroImage::all();

        if ($images->isEmpty() || $images->first()->isExpired()) {
            $images = $this->refreshHeroImages();
        }

        return $images;
    }
}
