<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::where('active', true)
            ->orderBy('featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('tours', compact('tours'));
    }

    public function show(Tour $tour)
    {
        if (!$tour->active) {
            abort(404);
        }

        return view('tours.show', compact('tour'));
    }
}
