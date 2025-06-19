<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $query = Location::query();
        if ($search = $request->input('search')) {
            $query->where('city', 'like', "%$search%")->orWhere('country', 'like', "%$search%");
        }
        $locations = $query->orderByDesc('created_at')->paginate(15);

        return Inertia::render('locations/index', [
            'locations' => $locations,
            'filters' => [
                'search' => $search ?? null,
            ]
        ]);
    }

    public function show(Location $location)
    {
        return Inertia::render('locations/show', [
            'location' => $location,
        ]);
    }

    public function create()
    {
        return Inertia::render('locations/create');
    }

    public function store(StoreLocationRequest $request)
    {
        $location = Location::create($request->validated());
        return redirect()->route('locations.index')->with('success', 'Location created!');
    }

    public function edit(Location $location)
    {
        return Inertia::render('locations/edit', [
            'location' => $location,
        ]);
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->validated());
        return redirect()->route('locations.index')->with('success', 'Location updated!');
    }

    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')->with('success', 'Location deleted!');
    }
}
