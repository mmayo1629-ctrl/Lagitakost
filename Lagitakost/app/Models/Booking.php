<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_type',
        'check_in_date',
        'check_out_date',
        'status',
        'notes',
        'notification_read',
        'price',
        'payment_method',
        'payment_amount',
        'payment_date',
        'payment_proof',
        'payment_notes',
        'payment_status'
    ];

    protected $casts = [
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'notification_read' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate the total price for a booking based on room type and dates.
     *
     * @param string $roomType
     * @param string $checkInDate
     * @param string $checkOutDate
     * @return float
     */
    public static function calculatePrice(string $roomType, string $checkInDate, string $checkOutDate): float
    {
        $checkIn = Carbon::parse($checkInDate);
        $checkOut = Carbon::parse($checkOutDate);
        $days = $checkIn->diffInDays($checkOut);

        $roomTypes = config('booking.room_types');
        $monthlyPrice = $roomTypes[$roomType] ?? $roomTypes['Tipe A']; // Default to Tipe A if not found
        $daysInMonth = config('booking.days_in_month', 30);

        $pricePerDay = $monthlyPrice / $daysInMonth;

        return $days * $pricePerDay;
    }

    /**
     * Get display room type attribute
     */
    public function getDisplayRoomTypeAttribute(): string
    {
        $mapping = [
            'Tipe A' => 'Kamar Tipe E',
            'Tipe B' => 'Kamar F',
            'Tipe C' => 'Kamar Standar',
            'Tipe D' => 'Kamar Deluxe',
            'Tipe E' => 'Kamar E',
            'Tipe F' => 'Kamar F',
        ];

        return $mapping[$this->room_type] ?? $this->room_type;
    }

    /**
     * Check if a room type is already booked in the given date range.
     *
     * @param string $roomType
     * @param string $checkInDate
     * @param string $checkOutDate
     * @return bool
     */
    public static function isRoomBooked(string $roomType, string $checkInDate, string $checkOutDate): bool
    {
        return self::where('room_type', $roomType)
            ->where('status', 'confirmed')
            ->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->whereBetween('check_in_date', [$checkInDate, $checkOutDate])
                      ->orWhereBetween('check_out_date', [$checkInDate, $checkOutDate])
                      ->orWhere(function ($query) use ($checkInDate, $checkOutDate) {
                          $query->where('check_in_date', '<=', $checkInDate)
                                ->where('check_out_date', '>=', $checkOutDate);
                      });
            })
            ->exists();
    }
}
