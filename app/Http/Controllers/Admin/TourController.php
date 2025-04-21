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
        return view('admin.tours.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'image_type' => 'required|in:custom,pexels',
            'image' => 'required_if:image_type,custom|image|max:2048',
            'image_source' => 'required_if:image_type,pexels|url',
            'difficulty_level' => 'required|in:easy,moderate,challenging',
            'is_featured' => 'boolean',
            'max_people' => 'nullable|integer|min:1',
            'included_services' => 'nullable|string',
            'excluded_services' => 'nullable|string',
            'itinerary' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->title);

        // Handle image upload
        if ($request->image_type === 'custom' && $request->hasFile('image')) {
            $path = $request->file('image')->store('tours', 'public');
            $data['image_source'] = $path;
        }

        // Convert newline-separated text to JSON arrays
        foreach (['included_services', 'excluded_services', 'itinerary'] as $field) {
            if ($request->has($field)) {
                $data[$field] = array_filter(explode("\n", $request->$field), 'trim');
            }
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'image_type' => 'required|in:custom,pexels',
            'image' => 'nullable|image|max:2048',
            'image_source' => 'required_if:image_type,pexels|url',
            'difficulty_level' => 'required|in:easy,moderate,challenging',
            'is_featured' => 'boolean',
            'max_people' => 'nullable|integer|min:1',
            'included_services' => 'nullable|string',
            'excluded_services' => 'nullable|string',
            'itinerary' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->title);

        // Handle image upload
        if ($request->image_type === 'custom' && $request->hasFile('image')) {
            // Delete old image if it exists
            if ($tour->image_type === 'custom' && $tour->image_source) {
                Storage::disk('public')->delete($tour->image_source);
            }

            $path = $request->file('image')->store('tours', 'public');
            $data['image_source'] = $path;
        }

        // Convert newline-separated text to JSON arrays
        foreach (['included_services', 'excluded_services', 'itinerary'] as $field) {
            if ($request->has($field)) {
                $data[$field] = array_filter(explode("\n", $request->$field), 'trim');
            }
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
        // Delete image if it exists and is a custom upload
        if ($tour->image_type === 'custom' && $tour->image_source) {
            Storage::disk('public')->delete($tour->image_source);
        }

        $tour->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tour deleted successfully'
        ]);
    }
}
