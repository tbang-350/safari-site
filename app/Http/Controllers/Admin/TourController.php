<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'difficulty' => 'required|in:easy,moderate,challenging',
            'featured' => 'boolean',
            'active' => 'boolean',
            'highlights' => 'nullable|string',
            'itinerary' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('tours', 'public');
            $data['image'] = $path;
        }

        $tour = Tour::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Tour created successfully',
            'tour' => $tour
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'difficulty' => 'required|in:easy,moderate,challenging',
            'featured' => 'boolean',
            'active' => 'boolean',
            'highlights' => 'nullable|string',
            'itinerary' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->name);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($tour->image) {
                Storage::disk('public')->delete($tour->image);
            }

            $path = $request->file('image')->store('tours', 'public');
            $data['image'] = $path;
        }

        $tour->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Tour updated successfully',
            'tour' => $tour
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        // Delete image if exists
        if ($tour->image) {
            Storage::disk('public')->delete($tour->image);
        }

        $tour->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tour deleted successfully'
        ]);
    }
}
