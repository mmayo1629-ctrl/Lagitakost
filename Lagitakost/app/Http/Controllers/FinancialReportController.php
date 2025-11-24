<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class FinancialReportController extends Controller
{
    public function index()
    {
        // Hitung total pendapatan bulan ini
        $totalRevenue = Booking::where('status', 'confirmed')
            ->whereMonth('created_at', now()->month)
            ->sum('price');

        // Hitung jumlah booking dikonfirmasi bulan ini
        $monthlyBookings = Booking::where('status', 'confirmed')
            ->whereMonth('created_at', now()->month)
            ->count();

        // Hitung jumlah booking menunggu pembayaran
        $pendingPayments = Booking::where('status', 'confirmed')
            ->where('price', '>', 0)
            ->count();

        // Hitung pendapatan per bulan untuk 6 bulan terakhir
        $monthlyRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $revenue = Booking::where('status', 'confirmed')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('price');
            $monthlyRevenue[] = [
                'month' => $date->format('M Y'),
                'revenue' => $revenue
            ];
        }

        // Hitung rata-rata pendapatan per booking
        $averageRevenuePerBooking = $monthlyBookings > 0 ? $totalRevenue / $monthlyBookings : 0;

        return view('financial-report', compact(
            'totalRevenue',
            'monthlyBookings',
            'pendingPayments',
            'monthlyRevenue',
            'averageRevenuePerBooking'
        ));
    }
}
