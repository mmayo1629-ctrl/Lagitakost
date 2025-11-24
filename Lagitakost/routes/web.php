<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes(); // Commented out to avoid conflicts with custom auth routes

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'customerDashboard'])->name('dashboard');

    Route::get('/kamar', [App\Http\Controllers\RoomController::class, 'customerIndex'])->name('rooms');
    Route::get('/kamar/{id}', [App\Http\Controllers\RoomController::class, 'customerShow'])->name('rooms.show');

    Route::get('/kontak', function () {
        return view('contact');
    })->name('contact');

    Route::get('/fasilitas', function () {
        return view('fasilitas');
    })->name('fasilitas');

    Route::get('/lokasi', function () {
        return view('location');
    })->name('location');
});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ActivityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk guest (belum login)
// Removed guest middleware to allow logged-in users to access login/register pages as per user request
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Forgot Password Routes
Route::get('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendOtp'])->name('password.send-otp');
Route::get('/verify-otp', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showVerifyOtpForm'])->name('password.verify-otp');
Route::post('/verify-otp', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'verifyOtp'])->name('password.verify-otp');
Route::post('/resend-otp', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'resendOtp'])->name('password.resend-otp');
Route::get('/reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset-form');
Route::post('/reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'resetPassword'])->name('password.reset');

// Route untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Contact form submission
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

    // Booking routes
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index')->middleware('admin');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::patch('/booking/{booking}/status', [BookingController::class, 'updateStatus'])->name('booking.update-status');
    Route::patch('/booking/{booking}/mark-read', [BookingController::class, 'markNotificationRead'])->name('booking.mark-notification-read');
    Route::get('/api/booked-dates', [BookingController::class, 'getBookedDates'])->name('api.booked-dates');

    // Payment routes
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');

    // API routes for user data
    Route::get('/api/user/latest-booking', [BookingController::class, 'getLatestBooking'])->name('api.user.latest-booking');

    // Customer dashboard
    Route::get('/customer-dashboard', [App\Http\Controllers\HomeController::class, 'customerDashboard'])->name('dashboard');

    // Contact Messages routes (Admin only)
    Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('/contact-messages/{id}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::patch('/contact-messages/{id}/read', [ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-read');
    Route::delete('/contact-messages/{id}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

    // Activity routes (Admin only)
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');

    // Financial Report routes (Admin only)
    Route::get('/financial-report', [FinancialReportController::class, 'index'])->name('financial-report')->middleware('admin');

    // Tenants management routes (Admin only)
    Route::get('/tenants', [BookingController::class, 'tenants'])->name('tenants.index')->middleware('admin');
    Route::patch('/booking/{booking}/update-tenant', [BookingController::class, 'updateTenant'])->name('booking.update-tenant')->middleware('admin');
    Route::delete('/booking/{booking}/delete-tenant', [BookingController::class, 'deleteTenant'])->name('booking.delete-tenant')->middleware('admin');

    // Room management routes (Admin only)
    Route::resource('rooms', \App\Http\Controllers\RoomController::class)->middleware('admin');
    Route::patch('/rooms/{room}/toggle-availability', [\App\Http\Controllers\RoomController::class, 'toggleAvailability'])->name('rooms.toggle-availability')->middleware('admin');
});


