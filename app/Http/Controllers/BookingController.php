<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('user', 'currency');
        if ($search = $request->input('search')) {
            $query->where('id', $search);
        }
        $bookings = $query->orderByDesc('created_at')->paginate(15);

        return Inertia::render('bookings/index', [
            'bookings' => $bookings,
            'filters' => [
                'search' => $search ?? null,
            ]
        ]);
    }

    public function show(Booking $booking)
    {
        $booking->load('user', 'items', 'payment', 'currency');
        return Inertia::render('bookings/show', [
            'booking' => $booking,
        ]);
    }

    public function create()
    {
        return Inertia::render('bookings/create');
    }

    public function store(StoreBookingRequest $request)
    {
        $booking = Booking::create($request->validated());
        return redirect()->route('bookings.index')->with('success', 'Booking created!');
    }

    public function edit(Booking $booking)
    {
        return Inertia::render('bookings/edit', [
            'booking' => $booking,
        ]);
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $booking->update($request->validated());
        return redirect()->route('bookings.index')->with('success', 'Booking updated!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted!');
    }
}
