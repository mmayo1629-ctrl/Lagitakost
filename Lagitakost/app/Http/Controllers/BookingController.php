<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        // Get bookings for current month
        $bookings = Booking::with('user')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->latest()
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_type' => 'required|string',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'notes' => 'nullable|string|max:500',
            'payment_method' => 'required|in:transfer_bank,e_wallet,cash'
        ]);

        // Check for room booking overlap
        if (Booking::isRoomBooked($request->room_type, $request->check_in_date, $request->check_out_date)) {
            $errorMessage = 'Kamar sudah dibooking untuk tanggal yang dipilih. Silakan pilih tanggal lain.';
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $errorMessage], 422);
            }
            return redirect()->back()->withErrors(['check_in_date' => $errorMessage])->withInput();
        }

        $totalPrice = Booking::calculatePrice(
            $request->room_type,
            $request->check_in_date,
            $request->check_out_date
        );

        $checkIn = \Carbon\Carbon::parse($request->check_in_date);
        $checkOut = \Carbon\Carbon::parse($request->check_out_date);
        $days = $checkIn->diffInDays($checkOut);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_type' => $request->room_type,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'status' => 'pending',
            'notes' => $request->notes,
            'price' => $totalPrice,
            'payment_method' => $request->payment_method
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibuat! Silakan lakukan pembayaran sesuai metode yang dipilih.',
                'total_price' => $totalPrice,
                'days' => $days,
                'payment_method' => $request->payment_method,
                'booking_id' => $booking->id
            ]);
        }

        return redirect()->back()->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran sesuai metode yang dipilih.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $oldStatus = $booking->status;
        $newStatus = $request->status;

        $booking->update([
            'status' => $newStatus,
            'notification_read' => false
        ]);

        // If status changed to confirmed, automatically assign a room and create tenant
        if ($oldStatus !== 'confirmed' && $newStatus === 'confirmed') {
            $this->assignRoomToBooking($booking);
        }

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
    }

    /**
     * Automatically assign an available room to a confirmed booking
     */
    private function assignRoomToBooking(Booking $booking)
    {
        // Find an available room of the requested type
        $availableRoom = \App\Models\Room::where('type', $booking->room_type)
            ->where('is_available', true)
            ->first();

        if ($availableRoom) {
            // Mark the room as occupied
            $availableRoom->update(['is_available' => false]);

            // The tenant will automatically appear in the tenants list
            // since confirmed bookings with current dates are shown as tenants
        }
        // If no room is available, the booking is still confirmed but no room is assigned
        // This allows the owner to manually manage room assignments later
    }

    public function markNotificationRead(Request $request, Booking $booking)
    {
        // Pastikan booking milik user yang sedang login
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $booking->update(['notification_read' => true]);

        return redirect()->back()->with('success', 'Notifikasi berhasil ditandai sebagai dibaca.');
    }

    public function tenants()
    {
        // Get current tenants (confirmed bookings)
        $currentTenants = Booking::with('user')
            ->where('status', 'confirmed')
            ->orderBy('check_in_date')
            ->get();

        return view('tenants.index', compact('currentTenants'));
    }

    public function updateTenant(Request $request, Booking $booking)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'room_type' => 'required|string',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'notes' => 'nullable|string|max:500'
        ]);

        // Update user information
        $booking->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update booking information
        $booking->update([
            'room_type' => $request->room_type,
            'check_in_date' => $request->check_in_date,
            'check_out_date' => $request->check_out_date,
            'notes' => $request->notes,
            'price' => Booking::calculatePrice($request->room_type, $request->check_in_date, $request->check_out_date)
        ]);

        return redirect()->back()->with('success', 'Data penghuni berhasil diperbarui.');
    }

    public function deleteTenant(Booking $booking)
    {
        // Before deleting the booking, make sure to free up the room if it was assigned
        if ($booking->status === 'confirmed') {
            // Find a room that matches the booking type and is currently unavailable
            // This is a simple approach - in a more complex system, you might want to track room assignments explicitly
            $occupiedRoom = \App\Models\Room::where('type', $booking->room_type)
                ->where('is_available', false)
                ->first();

            if ($occupiedRoom) {
                // Mark the room as available again
                $occupiedRoom->update(['is_available' => true]);
            }
        }

        // Delete the booking (which effectively removes the tenant)
        $booking->delete();

        return redirect()->back()->with('success', 'Data penghuni berhasil dihapus.');
    }

    public function getLatestBooking(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401, ['Content-Type' => 'application/json']);
        }

        // Get the latest booking for the current user
        $latestBooking = Booking::where('user_id', $user->id)
            ->latest('created_at')
            ->first();

        if ($latestBooking) {
            return response()->json([
                'booking_id' => $latestBooking->id,
                'room_type' => $latestBooking->room_type,
                'status' => $latestBooking->status,
                'check_in_date' => $latestBooking->check_in_date,
                'check_out_date' => $latestBooking->check_out_date,
                'price' => $latestBooking->price
            ], 200, ['Content-Type' => 'application/json']);
        }

        return response()->json(['booking_id' => null, 'message' => 'No booking found'], 200, ['Content-Type' => 'application/json']);
    }

    public function getBookedDates(Request $request)
    {
        $roomType = $request->query('room_type');
        if (!$roomType) {
            return response()->json(['error' => 'room_type parameter is required'], 400);
        }

        $bookings = Booking::where('room_type', $roomType)
                ->where('status', 'confirmed')
                ->get(['check_in_date', 'check_out_date']);

        $bookedDates = [];

        foreach ($bookings as $booking) {
            $start = $booking->check_in_date;
            $end = $booking->check_out_date;
            $period = new \DatePeriod(
                new \DateTime($start),
                new \DateInterval('P1D'),
                (new \DateTime($end))->modify('+1 day')
            );
            foreach ($period as $date) {
                $bookedDates[] = $date->format('Y-m-d');
            }
        }

        return response()->json(['booked_dates' => array_unique($bookedDates)]);
    }
}
