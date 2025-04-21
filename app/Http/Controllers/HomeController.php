<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Services\PexelsService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $pexelsService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PexelsService $pexelsService)
    {
        // Remove auth middleware since this is the landing page
        // $this->middleware('auth');
        $this->pexelsService = $pexelsService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $featuredTours = Tour::where('active', true)
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $heroImages = $this->pexelsService->getHeroImages();

        return view('landing', compact('featuredTours', 'heroImages'));
    }
}
