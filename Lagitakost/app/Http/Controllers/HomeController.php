<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->is_admin) {
            $contactMessages = \App\Models\ContactMessage::latest()->take(5)->get();
            $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count();
            $recentBookings = \App\Models\Booking::with('user')->latest()->take(5)->get();

            // Hitung jumlah total kamar
            $totalRooms = \App\Models\Room::count();

            // Hitung jumlah kamar terisi (berdasarkan kamar yang tidak tersedia)
            $occupiedRooms = \App\Models\Room::where('is_available', false)->count();

            // Hitung laporan keuangan
            $totalRevenue = \App\Models\Booking::where('status', 'confirmed')
                ->whereMonth('created_at', now()->month)
                ->sum('price');

            $monthlyBookings = \App\Models\Booking::where('status', 'confirmed')
                ->whereMonth('created_at', now()->month)
                ->count();

            $pendingPayments = \App\Models\Booking::where('status', 'confirmed')
                ->where('price', '>', 0)
                ->count();

            // Hitung notifikasi untuk owner (pending payment verifications)
            $notificationCount = \App\Models\Booking::where('payment_status', 'pending_verification')->count();

            return view('owner-dashboard', compact(
                'contactMessages',
                'unreadCount',
                'recentBookings',
                'totalRooms',
                'occupiedRooms',
                'totalRevenue',
                'monthlyBookings',
                'pendingPayments',
                'notificationCount'
            ));
        }

        // Hitung notifikasi untuk customer
        $notificationCount = \App\Models\Booking::where('user_id', auth()->id())
            ->whereIn('status', ['confirmed', 'cancelled'])
            ->where('notification_read', false)
            ->count();

        return view('home', compact('notificationCount'));
    }

    /**
     * Show the customer dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function customerDashboard()
    {
        $bookings = \App\Models\Booking::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('customer-dashboard', compact('bookings'));
    }
}
