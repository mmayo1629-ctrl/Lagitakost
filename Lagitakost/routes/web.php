<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;

// Default welcome page
Route::get('/', function () {
    return view('welcome');
});

// Home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ---------------------- AUTH ONLY ROUTES ----------------------
Route::middleware('auth')->group(function () {

    // Customer dashboard
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'customerDashboard'])
        ->name('dashboard');

    // CUSTOMER — ROOM LIST
    Route::get('/kamar', [RoomController::class, 'customerIndex'])
        ->name('rooms');

    Route::get('/kamar/{id}', [RoomController::class, 'customerShow'])
        ->name('customer.rooms.show');

    // ADMIN — ROOM MANAGEMENT
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::resource('rooms', RoomController::class);
        Route::patch('rooms/{room}/toggle-availability', [RoomController::class, 'toggleAvailability'])->name('rooms.toggle-availability');
    });

    // Static pages
    Route::get('/kontak', fn () => view('contact'))->name('contact');
    Route::get('/fasilitas', fn () => view('fasilitas'))->name('fasilitas');
    Route::get('/lokasi', fn () => view('location'))->name('location');
});

// ---------------------- AUTH CONTROLLERS ----------------------

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FinancialReportController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Login & Register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.send-otp');
Route::get('/verify-otp', [ForgotPasswordController::class, 'showVerifyOtpForm'])->name('password.verify-otp');
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('password.verify-otp.submit');
Route::post('/resend-otp', [ForgotPasswordController::class, 'resendOtp'])->name('password.resend-otp');
Route::get('/reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset-form');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');

// ---------------------- AUTH ONLY ----------------------
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Contact form
    Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

    // Booking (admin only)
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index')->middleware('admin');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::patch('/booking/{booking}/status', [BookingController::class, 'updateStatus'])->name('booking.update-status');
    Route::patch('/booking/{booking}/mark-read', [BookingController::class, 'markNotificationRead'])->name('booking.mark-notification-read');
    Route::get('/api/booked-dates', [BookingController::class, 'getBookedDates'])->name('api.booked-dates');

    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');

    // Latest Booking API
    Route::get('/api/user/latest-booking', [BookingController::class, 'getLatestBooking'])->name('api.user.latest-booking');

    // Customer Dashboard
    Route::get('/customer-dashboard', [App\Http\Controllers\HomeController::class, 'customerDashboard'])
        ->name('customer.dashboard');

    // Contact Messages (admin)
    Route::middleware('admin')->group(function () {
        Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
        Route::get('/contact-messages/{id}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
        Route::patch('/contact-messages/{id}/read', [ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-read');
        Route::delete('/contact-messages/{id}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

        // Activities
        Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');

        // Financial Report
        Route::get('/financial-report', [FinancialReportController::class, 'index'])->name('financial-report');

        // Tenants
        Route::get('/tenants', [BookingController::class, 'tenants'])->name('tenants.index');
        Route::patch('/booking/{booking}/update-tenant', [BookingController::class, 'updateTenant'])->name('booking.update-tenant');
        Route::delete('/booking/{booking}/delete-tenant', [BookingController::class, 'deleteTenant'])->name('booking.delete-tenant');
    });
});
