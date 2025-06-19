<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Flight;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::query();

        if ($search = $request->input('search')) {
            $query->where('flight_number', 'like', "%$search%")
                  ->orWhere('airline', 'like', "%$search%");
        }

        $flights = $query->orderByDesc('departure_time')->paginate(15);

        return Inertia::render('flights/index', [
            'flights' => $flights,
            'filters' => [
                'search' => $search,
            ]
        ]);
    }

    public function show(Flight $flight)
    {
        return Inertia::render('flights/show', [
            'flight' => $flight,
        ]);
    }

    public function create()
    {
        return Inertia::render('flights/create');
    }

    public function store(StoreFlightRequest $request)
    {
        $flight = Flight::create($request->validated());

        return redirect()->route('flights.index')->with('success', 'Flight created!');
    }

    public function edit(Flight $flight)
    {
        return Inertia::render('flights/edit', [
            'flight' => $flight,
        ]);
    }

    public function update(UpdateFlightRequest $request, Flight $flight)
    {
        $flight->update($request->validated());

        return redirect()->route('flights.index')->with('success', 'Flight updated!');
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();

        return redirect()->route('flights.index')->with('success', 'Flight deleted!');
    }
}
