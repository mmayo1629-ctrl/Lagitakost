<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Recalculate prices for existing bookings based on room type and duration
        DB::table('bookings')->get()->each(function ($booking) {
            $checkIn = Carbon::parse($booking->check_in_date);
            $checkOut = Carbon::parse($booking->check_out_date);
            $days = $checkIn->diffInDays($checkOut);

            // Harga per hari berdasarkan tipe kamar (dihitung dari harga bulanan / 30 hari)
            $pricePerDay = match($booking->room_type) {
                'Tipe A' => 500000 / 30, // Rp 500rb/bulan = Rp 16,667/hari
                'Tipe B' => 850000 / 30, // Rp 850rb/bulan = Rp 28,333/hari
                'Tipe C' => 650000 / 30, // Rp 650rb/bulan = Rp 21,667/hari
                'Tipe D' => 800000 / 30, // Rp 800rb/bulan = Rp 26,667/hari
                'Tipe E' => 700000 / 30, // Rp 700rb/bulan = Rp 23,333/hari
                'Tipe F' => 500000 / 30, // Rp 500rb/bulan = Rp 16,667/hari
                default => 500000 / 30
            };

            $totalPrice = $days * $pricePerDay;

            DB::table('bookings')
                ->where('id', $booking->id)
                ->update(['price' => $totalPrice]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reset prices to 0 or null if needed
        DB::table('bookings')->update(['price' => 0]);
    }
};
