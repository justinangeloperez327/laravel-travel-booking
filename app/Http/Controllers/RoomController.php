<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::with('hotel');
        if ($search = $request->input('search')) {
            $query->where('type', 'like', "%$search%");
        }
        $rooms = $query->orderByDesc('created_at')->paginate(15);

        return Inertia::render('rooms/index', [
            'rooms' => $rooms,
            'filters' => [
                'search' => $search ?? null,
            ]
        ]);
    }

    public function show(Room $room)
    {
        $room->load('hotel');
        return Inertia::render('rooms/show', [
            'room' => $room,
        ]);
    }

    public function create()
    {
        return Inertia::render('rooms/create');
    }

    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->validated());
        return redirect()->route('rooms.index')->with('success', 'Room created!');
    }

    public function edit(Room $room)
    {
        return Inertia::render('rooms/edit', [
            'room' => $room,
        ]);
    }

    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->validated());
        return redirect()->route('rooms.index')->with('success', 'Room updated!');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted!');
    }
}
