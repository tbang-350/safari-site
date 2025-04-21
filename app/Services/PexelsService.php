<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PexelsService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.pexels.com/v1';

    public function __construct()
    {
        $this->apiKey = env('PEXEL_API_KEY');
    }

    /**
     * Search for photos using the Pexels API
     *
     * @param string $query
     * @param int $perPage
     * @param int $page
     * @return array
     */
    public function searchPhotos($query, $perPage = 15, $page = 1)
    {
        $cacheKey = "pexels_search_{$query}_{$perPage}_{$page}";

        return Cache::remember($cacheKey, 3600, function () use ($query, $perPage, $page) {
            $response = Http::withHeaders([
                'Authorization' => $this->apiKey
            ])->get("{$this->baseUrl}/search", [
                'query' => $query,
                'per_page' => $perPage,
                'page' => $page
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return [
                'photos' => [],
                'total_results' => 0,
                'error' => 'Failed to fetch photos from Pexels'
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

        return Cache::remember($cacheKey, 3600, function () use ($perPage, $page) {
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

        return Cache::remember($cacheKey, 3600, function () use ($id) {
            $response = Http::withHeaders([
                'Authorization' => $this->apiKey
            ])->get("{$this->baseUrl}/photos/{$id}");

            if ($response->successful()) {
                return $response->json();
            }

            return null;
        });
    }
}
