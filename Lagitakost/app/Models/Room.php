<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price',
        'capacity',
        'size',
        'facilities',
        'is_available',
        'is_popular',
        'image',
        'description'
    ];

    protected $casts = [
        'facilities' => 'array',
        'is_available' => 'boolean',
        'is_popular' => 'boolean',
    ];

    /**
     * Scope to get only available rooms
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope to filter by room type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get facilities as comma-separated string
     */
    public function getFacilitiesListAttribute()
    {
        return is_array($this->facilities) ? implode(', ', $this->facilities) : '';
    }

    /**
     * Get display type attribute
     */
    public function getDisplayTypeAttribute(): string
    {
        $mapping = [
            'Tipe A' => 'Kamar Tipe A',
            'Tipe B' => 'Kamar Tipe B',
            'Tipe C' => 'Kamar Tipe C',
            'Tipe D' => 'Kamar Tipe D',
            'Tipe E' => 'Kamar Tipe E',
            'Tipe F' => 'Kamar Tipe F',
        ];

        return $mapping[$this->type] ?? $this->type;
    }

    /**
     * Get image url with cache busting based on last modified time
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            // Return null or a default placeholder URL if no image is set
            return null;
        }

        $path = $this->image;

        // If path already has full URL or starts with http
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Use Laravel Str helper to check startsWith
        if (Str::startsWith($path, 'storage/')) {
            $path = substr($path, strlen('storage/'));
        }

        // Check if file exists on public disk
        if (Storage::disk('public')->exists($path)) {
            $timestamp = Storage::disk('public')->lastModified($path);
            return asset('storage/' . $path) . '?v=' . $timestamp;
        }

        // Fallback if file not exists
        return null;
    }
}
