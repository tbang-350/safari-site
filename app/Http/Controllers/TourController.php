<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the tours.
     */
    public function index()
    {
        $tours = Tour::where('active', true)
            ->orderBy('featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('tours', compact('tours'));
    }

    /**
     * Display the specified tour.
     */
    public function show(Tour $tour)
    {
        if (!$tour->active) {
            abort(404);
        }

        // Get related tours
        $relatedTours = Tour::where('active', true)
            ->where('id', '!=', $tour->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('tours.show', compact('tour', 'relatedTours'));
    }
}
