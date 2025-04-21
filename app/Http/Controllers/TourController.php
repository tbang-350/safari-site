<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Services\PexelsService;
use Illuminate\Http\Request;

class TourController extends Controller
{
    protected $pexelsService;

    public function __construct(PexelsService $pexelsService)
    {
        $this->pexelsService = $pexelsService;
    }

    /**
     * Display a listing of the tours.
     */
    public function index(Request $request)
    {
        $query = Tour::where('active', true);

        // Apply duration filter
        if ($request->has('duration')) {
            $query->where(function($q) use ($request) {
                foreach ($request->duration as $range) {
                    if ($range === '1-3') {
                        $q->orWhereBetween('duration', [1, 3]);
                    } elseif ($range === '4-7') {
                        $q->orWhereBetween('duration', [4, 7]);
                    } elseif ($range === '8+') {
                        $q->orWhere('duration', '>=', 8);
                    }
                }
            });
        }

        // Apply difficulty filter
        if ($request->has('difficulty')) {
            $query->whereIn('difficulty_level', $request->difficulty);
        }

        // Apply price range filter
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Apply sorting
        switch ($request->input('sort')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'duration_asc':
                $query->orderBy('duration', 'asc');
                break;
            case 'duration_desc':
                $query->orderBy('duration', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        $tours = $query->paginate(12)->withQueryString();

        return view('tours.index', compact('tours'));
    }

    /**
     * Display the specified tour.
     */
    public function show(Tour $tour)
    {
        if (!$tour->active) {
            abort(404);
        }

        // Get tour images from Pexels based on tour title and location
        $searchQuery = "{$tour->title} {$tour->location} safari landscape";
        $pexelsResponse = $this->pexelsService->searchPhotos($searchQuery, 5);

        $tourImages = collect($pexelsResponse['photos'])->map(function($photo) {
            return (object)[
                'url' => $photo['src']['landscape'],
                'photographer' => $photo['photographer'],
                'photographer_url' => $photo['photographer_url'],
                'alt_text' => $photo['alt'] ?? 'Tour image'
            ];
        });

        // Get related tours
        $relatedTours = Tour::where('active', true)
            ->where('id', '!=', $tour->id)
            ->where(function($query) use ($tour) {
                $query->where('difficulty_level', $tour->difficulty_level)
                    ->orWhereBetween('duration', [$tour->duration - 1, $tour->duration + 1]);
            })
            ->take(3)
            ->get();

        return view('tours.show', compact('tour', 'tourImages', 'relatedTours'));
    }
}
