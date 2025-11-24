<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function __construct()
    {
        // No middleware here since we have a public customerIndex method
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function index()
    {
        $this->middleware('admin');
        $rooms = Room::latest()->paginate(10);
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Display rooms for customers (public view).
     */
    public function customerIndex()
    {
        $rooms = Room::available()->latest()->get();
        return view('room', compact('rooms'));
    }

    /**
     * Display room details for customers (public view).
     */
    public function customerShow($id)
    {
        $room = Room::findOrFail($id);
        return view('room-detail', compact('room'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->middleware('admin');
        $roomTypes = config('booking.room_types');
        return view('rooms.create', compact('roomTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->middleware('admin');
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:1',
            'size' => 'required|string|max:255',
            'facilities' => 'required|array',
            'facilities.*' => 'string|max:255',
            'is_available' => 'boolean',
            'is_popular' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
        ]);

        $data = $request->except('image', 'facilities');

        // Handle image upload and save relative path only
        if ($request->hasFile('image')) {
            $storedPath = $request->file('image')->store('rooms', 'public');
            $data['image'] = $storedPath; // storedPath is already relative to storage/app/public
        }

        // Convert facilities array to JSON
        $data['facilities'] = json_encode($request->facilities);

        Room::create($data);

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->middleware('admin');
        $room = Room::findOrFail($id);
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->middleware('admin');
        $room = Room::findOrFail($id);
        $roomTypes = config('booking.room_types');
        return view('rooms.edit', compact('room', 'roomTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->middleware('admin');
        $room = Room::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'capacity' => 'required|integer|min:1',
            'size' => 'required|string|max:255',
            'facilities' => 'required|array',
            'facilities.*' => 'string|max:255',
            'is_available' => 'boolean',
            'is_popular' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
        ]);

        $data = $request->except('image', 'facilities');

        // Handle image upload and save relative path only, delete old image
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($room->image && Storage::disk('public')->exists($room->image)) {
                Storage::disk('public')->delete($room->image);
            }

            $storedPath = $request->file('image')->store('rooms', 'public');
            $data['image'] = $storedPath; // relative storage path
        }

        // Convert facilities array to JSON
        $data['facilities'] = json_encode($request->facilities);

        $room->update($data);

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->middleware('admin');
        $room = Room::findOrFail($id);

        // Delete image if exists
        if ($room->image && Storage::disk('public')->exists($room->image)) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Kamar berhasil dihapus!');
    }

    /**
     * Toggle room availability
     */
    public function toggleAvailability(string $id)
    {
        $this->middleware('admin');
        $room = Room::findOrFail($id);
        $room->update(['is_available' => !$room->is_available]);

        $status = $room->is_available ? 'tersedia' : 'tidak tersedia';

        return redirect()->back()->with('success', "Status kamar {$room->name} berhasil diubah menjadi {$status}!");
    }
}
