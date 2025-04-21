<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PexelsService;
use Illuminate\Http\Request;

class PexelsController extends Controller
{
    protected $pexelsService;

    public function __construct(PexelsService $pexelsService)
    {
        $this->pexelsService = $pexelsService;
    }

    /**
     * Search for photos using the Pexels API
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = $request->input('query', '');
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 15);

        $results = $this->pexelsService->searchPhotos($query, $perPage, $page);

        return response()->json($results);
    }

    /**
     * Get curated photos from Pexels
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function curated(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 15);

        $results = $this->pexelsService->getCuratedPhotos($perPage, $page);

        return response()->json($results);
    }

    /**
     * Get a specific photo by ID
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $photo = $this->pexelsService->getPhoto($id);

        if (!$photo) {
            return response()->json(['error' => 'Photo not found'], 404);
        }

        return response()->json($photo);
    }
}
