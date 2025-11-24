<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)
            ->with('room')
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung notifikasi untuk customer
        $notificationCount = \App\Models\Booking::where('user_id', auth()->id())
            ->whereIn('status', ['confirmed', 'cancelled'])
            ->where('notification_read', false)
            ->count();

        return view('payments.index', compact('bookings', 'notificationCount'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:transfer_bank,e_wallet,cash',
            'payment_amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date|before_or_equal:today',
            'payment_proof' => 'required|file|mimes:jpeg,jpg,png,pdf|max:5120', // 5MB max
            'payment_notes' => 'nullable|string|max:500'
        ]);

        // Get the latest booking for the current user
        $booking = Booking::where('user_id', Auth::id())
            ->latest()
            ->first();

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada booking yang ditemukan.'
            ], 404);
        }

        // Store the payment proof file
        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Update booking with payment information
        $booking->update([
            'payment_method' => $request->payment_method,
            'payment_amount' => $request->payment_amount,
            'payment_date' => $request->payment_date,
            'payment_proof' => $proofPath,
            'payment_notes' => $request->payment_notes,
            'payment_status' => 'pending_verification' // Add this field to track payment status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Konfirmasi pembayaran berhasil dikirim! Kami akan memverifikasi pembayaran Anda dalam 1-2 hari kerja.'
        ]);
    }
}
