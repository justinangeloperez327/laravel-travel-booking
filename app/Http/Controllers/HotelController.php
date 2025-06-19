<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::with('location');
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%");
        }

        $hotels = $query->orderByDesc('created_at')->paginate(15);

        return Inertia::render('hotels/index', [
            'hotels' => $hotels,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function show(Hotel $hotel)
    {
        $hotel->load('location', 'rooms');
        return Inertia::render('hotels/Show', [
            'hotel' => $hotel,
        ]);
    }

    public function create()
    {
        return Inertia::render('hotels/create');
    }

    public function store(StoreHotelRequest $request)
    {
        $hotel = Hotel::create($request->validated());
        return redirect()->route('hotels.index')->with('success', 'Hotel created!');
    }

    public function edit(Hotel $hotel)
    {
        return Inertia::render('hotels/edit', [
            'hotel' => $hotel,
        ]);
    }

    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        $hotel->update($request->validated());
        return redirect()->route('hotels.index')->with('success', 'Hotel updated!');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotels.index')->with('success', 'Hotel deleted!');
    }
}
