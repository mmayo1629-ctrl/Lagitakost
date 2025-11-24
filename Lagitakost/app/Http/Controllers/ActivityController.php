<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\ContactMessage;

class ActivityController extends Controller
{
    public function index()
    {
        // Get all recent bookings with user info
        $bookings = Booking::with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Get all contact messages
        $contactMessages = ContactMessage::orderBy('created_at', 'desc')
            ->paginate(20);

        // Combine and sort all activities
        $activities = collect();

        // Add bookings to activities
        foreach ($bookings as $booking) {
            $activities->push([
                'type' => 'booking',
                'id' => $booking->id,
                'title' => 'Booking ' . $booking->room_type,
                'description' => $booking->user->name . ' - Check-in: ' . $booking->check_in_date->format('d/m/Y'),
                'created_at' => $booking->created_at,
                'data' => $booking
            ]);
        }

        // Add contact messages to activities
        foreach ($contactMessages as $message) {
            $activities->push([
                'type' => 'message',
                'id' => $message->id,
                'title' => $message->subject,
                'description' => $message->name . ' - ' . \Illuminate\Support\Str::limit($message->message, 100),
                'created_at' => $message->created_at,
                'data' => $message
            ]);
        }

        // Sort by created_at descending
        $activities = $activities->sortByDesc('created_at')->values();

        // Paginate the combined activities (20 per page)
        $perPage = 20;
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $paginatedActivities = $activities->slice($offset, $perPage);

        $activities = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginatedActivities,
            $activities->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'pageName' => 'page']
        );

        return view('activities.index', compact('activities'));
    }
}
