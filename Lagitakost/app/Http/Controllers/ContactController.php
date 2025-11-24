<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Save message to database
        ContactMessage::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_read' => false, // Mark as unread for owner dashboard
        ]);

        // Optional: Send email notification to admin
        /*
        Mail::raw($request->message, function ($mail) use ($request) {
            $mail->to('admin@lagitakost.com')
                 ->subject('Contact Form: ' . $request->subject)
                 ->from($request->email, $request->name);
        });
        */

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim! Kami akan segera menghubungi Anda.'
        ]);
    }
}
