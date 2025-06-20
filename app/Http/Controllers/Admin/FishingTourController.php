<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FishingTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class FishingTourController extends Controller
{    public function index()
    {
        $tours = FishingTour::latest()->paginate(10);
        return view('dashboard.tours.index', [
            'tours' => $tours,
            'page_title' => 'Manage Tours',
            'active_menu' => 'tours'
        ]);
    }

    public function create()
    {
        return view('dashboard.tours.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', Rule::in(['fishing', 'excursion'])],
            'duration' => ['nullable', 'string', 'max:50'],
            'capacity' => ['nullable', 'string', 'max:50'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'price_type' => ['nullable', Rule::in(['per_person', 'total'])],
            'image' => ['nullable', 'image', 'max:2048'],
            'features' => ['nullable', 'array'],
            'is_active' => ['boolean']
        ]);        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('tours', 'public');
            $validated['image'] = $path;
        }

        FishingTour::create($validated);

        return redirect()->route('admin.tours.index')
            ->with('success', __('tours.created_successfully'));
    }

    public function edit(FishingTour $tour)
    {
        return view('dashboard.tours.edit', compact('tour'));
    }

    public function update(Request $request, FishingTour $tour)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', Rule::in(['fishing', 'excursion'])],
            'duration' => ['nullable', 'string', 'max:50'],
            'capacity' => ['nullable', 'string', 'max:50'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'price_type' => ['nullable', Rule::in(['per_person', 'total'])],
            'image' => ['nullable', 'image', 'max:2048'],
            'features' => ['nullable', 'array'],
            'is_active' => ['boolean']
        ]);        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($tour->image && Storage::disk('public')->exists($tour->image)) {
                Storage::disk('public')->delete($tour->image);
            }
            
            $path = $request->file('image')->store('tours', 'public');
            $validated['image'] = $path;
        }

        $tour->update($validated);

        return redirect()->route('admin.tours.index')
            ->with('success', __('tours.updated_successfully'));
    }

    public function destroy(FishingTour $tour)
    {        if ($tour->image && Storage::disk('public')->exists($tour->image)) {
            Storage::disk('public')->delete($tour->image);
        }

        $tour->delete();

        return redirect()->route('admin.tours.index')
            ->with('success', __('tours.deleted_successfully'));
    }
}
