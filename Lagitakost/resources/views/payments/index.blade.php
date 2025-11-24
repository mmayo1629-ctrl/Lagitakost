@extends('layouts.app')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        background: #f8f9fa;
    }

    .navbar.navbar-expand-md {
        display: none;
    }

    /* Custom Navbar Styles */
    .custom-navbar {
        background: white;
        padding: 15px 80px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar-brand-custom {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
    }

    .brand-logo {
        background: #1a1a1a;
        color: white;
        width: 42px;
        height: 42px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 16px;
    }

    .brand-text {
        display: flex;
        flex-direction: column;
    }

    .brand-name {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1;
    }

    .brand-tagline {
        font-size: 12px;
        color: #666;
        margin-top: 2px;
    }

    .navbar-menu {
        display: flex;
        gap: 35px;
        align-items: center;
        list-style: none;
        margin: 0;
    }

    .navbar-menu li {
        margin: 0;
    }

    .navbar-menu a {
        color: #333;
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        transition: color 0.3s;
    }

    .navbar-menu a:hover,
    .navbar-menu a.active {
        color: #1a1a1a;
    }

    .navbar-actions {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 16px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        cursor: pointer;
        transition: all 0.3s;
        border: 1px solid #e0e0e0;
    }

    .user-profile:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        transform: translateY(-1px);
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a1a;
        line-height: 1;
    }

    .user-role {
        font-size: 12px;
        color: #666;
        line-height: 1;
    }

    .logout-btn {
        background: #000;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .logout-btn:hover {
        background: #333;
    }

    .phone-number {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #666;
        font-size: 14px;
        text-decoration: none;
        transition: color 0.3s;
    }

    .phone-number:hover {
        color: #1a1a1a;
    }

    .contact-button {
        background: #1a1a1a;
        color: white;
        padding: 10px 24px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .contact-button:hover {
        background: #333;
        color: white;
        transform: translateY(-1px);
    }

    .mobile-menu-toggle {
        display: none;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #1a1a1a;
    }

    @media (max-width: 968px) {
        .custom-navbar {
            padding: 15px 30px;
        }

        .navbar-menu {
            display: none;
        }

        .mobile-menu-toggle {
            display: block;
        }

        .navbar-actions .phone-number {
            display: none;
        }
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 80px;
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .page-subtitle {
        font-size: 16px;
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }

    .bookings-grid {
        display: grid;
        gap: 24px;
    }

    .booking-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .booking-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .booking-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 24px;
        color: white;
    }

    .booking-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .booking-date {
        font-size: 14px;
        opacity: 0.9;
    }

    .booking-body {
        padding: 24px;
    }

    .booking-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .detail-label {
        font-size: 12px;
        font-weight: 600;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-value {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
    }

    .booking-status {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-confirmed {
        background: #d1ecf1;
        color: #0c5460;
    }

    .status-paid {
        background: #d4edda;
        color: #155724;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .payment-info {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        margin-top: 20px;
    }

    .payment-title {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .payment-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 16px;
    }

    .payment-detail-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .payment-label {
        font-size: 12px;
        font-weight: 600;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .payment-value {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a1a;
    }

    .booking-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        border: 2px solid;
    }

    .btn-primary {
        background: #28a745;
        border-color: #28a745;
        color: white;
    }

    .btn-primary:hover {
        background: #218838;
        border-color: #218838;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: white;
        border-color: #e0e0e0;
        color: #666;
    }

    .btn-secondary:hover {
        background: #f8f9fa;
        border-color: #ccc;
        color: #333;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .empty-icon {
        font-size: 64px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-title {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .empty-message {
        font-size: 16px;
        color: #666;
        max-width: 400px;
        margin: 0 auto 24px;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #666;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 20px;
        transition: color 0.3s;
    }

    .back-btn:hover {
        color: #1a1a1a;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        .booking-details {
            grid-template-columns: 1fr;
        }

        .payment-details {
            grid-template-columns: 1fr;
        }

        .booking-actions {
            flex-direction: column;
        }

        .page-title {
            font-size: 24px;
        }
    }

    /* Logout Popup Styles */
    .logout-popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.6);
        backdrop-filter: blur(5px);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.3s ease-out;
    }
    .logout-popup {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border: 1px solid #ddd;
        max-width: 400px;
        width: 90%;
        animation: popupSlideIn 0.3s ease-out;
    }
    .logout-popup-header {
        border: none;
        border-radius: 8px 8px 0 0;
        background: white;
        padding: 20px 30px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }
    .logout-popup-title {
        color: #333;
        font-weight: 600;
        font-size: 18px;
        margin: 0;
    }
    .logout-popup-body {
        padding: 30px;
        text-align: center;
    }
    .logout-popup-icon {
        animation: pulse 2s infinite;
        color: #dc3545;
        margin-bottom: 20px;
    }
    .logout-popup-message {
        font-size: 16px;
        margin-bottom: 10px;
        color: #1a1a1a;
    }
    .logout-popup-submessage {
        font-size: 14px;
        color: #666;
        margin-bottom: 0;
    }
    .logout-popup-actions {
        padding: 20px 30px 30px;
        display: flex;
        gap: 15px;
        justify-content: center;
    }
    .logout-popup-btn {
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        padding: 12px 30px;
        transition: all 0.3s ease;
        border: 1px solid;
        cursor: pointer;
    }

    .logout-popup-btn-cancel {
        background: white;
        border-color: #6c757d;
        color: #6c757d;
    }
    .logout-popup-btn-cancel:hover {
        background: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    .logout-popup-btn-logout {
        background: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    .logout-popup-btn-logout:hover {
        background: #6c757d;
        border-color: #6c757d;
        color: white;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes popupSlideIn {
        from {
            opacity: 0;
            transform: scale(0.8) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .loading {
        color: #666;
        font-style: italic;
    }

    .error {
        color: #dc3545;
        font-size: 14px;
    }
</style>

@if(Auth::check())
    @php
        $user = Auth::user();
        $initials = strtoupper(substr($user->name, 0, 1));
    @endphp
    <nav class="custom-navbar">
        <a href="{{ route('home') }}" class="navbar-brand-custom">
            <div class="brand-logo">LK</div>
            <div class="brand-text">
                <div class="brand-name">Lagita Kost</div>
                <div class="brand-tagline">Kost Modern & Nyaman</div>
            </div>
        </a>

        <ul class="navbar-menu">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('rooms') }}">Kamar</a></li>
            <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
            <li><a href="{{ route('location') }}">Lokasi</a></li>
            <li><a href="{{ route('contact') }}">Kontak</a></li>
            <li><a href="{{ route('payments.index') }}" class="active">Pembayaran</a></li>
        </ul>

        <div class="navbar-actions">
            <a href="tel:+6287761001778" class="phone-number">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                +62 877-6100-1778
            </a>

            <div class="user-profile">
                <div class="user-avatar">{{ $initials }}</div>
                <div class="user-info">
                    <div class="user-name">{{ $user->name }}</div>
                    <div class="user-role">{{ $user->is_admin ? 'Admin' : 'Customer' }}</div>
                </div>
            </div>

            <button type="button" class="logout-btn" onclick="showLogoutPopup()">Logout</button>
        </div>

        <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </nav>
@else
    <nav class="custom-navbar">
        <a href="{{ route('home') }}" class="navbar-brand-custom">
            <div class="brand-logo">LK</div>
            <div class="brand-text">
                <div class="brand-name">Lagita Kost</div>
                <div class="brand-tagline">Kost Modern & Nyaman</div>
            </div>
        </a>

        <ul class="navbar-menu">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('rooms') }}">Kamar</a></li>
            <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
            <li><a href="{{ route('location') }}">Lokasi</a></li>
            <li><a href="{{ route('contact') }}">Kontak</a></li>
        </ul>

        <div class="navbar-actions">
            <a href="tel:+6287761001778" class="phone-number">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                +62 877-6100-1778
            </a>

            <a href="{{ route('login') }}" class="contact-button">Login</a>
            <a href="{{ route('register') }}" class="contact-button">Daftar</a>
        </div>

        <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </nav>
@endif

        <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </nav>
@else
    <nav class="custom-navbar">
        <a href="{{ route('home') }}" class="navbar-brand-custom">
            <div class="brand-logo">LK</div>
            <div class="brand-text">
                <div class="brand-name">Lagita Kost</div>
                <div class="brand-tagline">Kost Modern & Nyaman</div>
            </div>
        </a>

        <ul class="navbar-menu">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('rooms') }}">Kamar</a></li>
            <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
            <li><a href="{{ route('location') }}">Lokasi</a></li>
            <li><a href="{{ route('contact') }}">Kontak</a></li>
        </ul>

        <div class="navbar-actions">
            <a href="tel:+6287761001778" class="phone-number">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                +62 877-6100-1778
            </a>
            <a href="https://wa.me/6287761001778" class="contact-button" target="_blank">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>

            <a href="{{ route('login') }}" class="contact-button">Login</a>
            <a href="{{ route('register') }}" class="contact-button">Daftar</a>
        </div>

        <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </nav>
@endif

<script>
    function toggleMobileMenu() {
        // Mobile menu toggle functionality can be added here
        alert('Mobile menu functionality to be implemented');
    }
</script>

<div class="container">
    <a href="{{ route('home') }}" class="back-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5"></path>
            <path d="M12 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Beranda
    </a>

    <div class="page-header">
        <h1 class="page-title">Riwayat Pembayaran</h1>
        <p class="page-subtitle">Pantau status pembayaran dan booking Anda di sini</p>
    </div>

    <!-- Current Booking Status Section -->
    <div id="currentBookingSection" class="booking-card" style="margin-bottom: 40px; display: none;">
        <div class="booking-header">
            <div class="booking-title">Status Booking Terbaru</div>
            <div class="booking-date" id="currentBookingDate">Loading...</div>
        </div>
        <div class="booking-body">
            <div class="booking-details">
                <div class="detail-item">
                    <span class="detail-label">Tipe Kamar</span>
                    <span class="detail-value" id="currentRoomType">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Status</span>
                    <span class="booking-status" id="currentStatus">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Check-in</span>
                    <span class="detail-value" id="currentCheckIn">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Check-out</span>
                    <span class="detail-value" id="currentCheckOut">-</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total Harga</span>
                    <span class="detail-value" id="currentPrice">-</span>
                </div>
            </div>
        </div>
    </div>

    @if($bookings->count() > 0)
        <div class="bookings-grid">
            @foreach($bookings as $booking)
                <div class="booking-card">
                    <div class="booking-header">
                        <div class="booking-title">{{ $booking->room->display_type ?? 'Kamar' }}</div>
                        <div class="booking-date">Booking: {{ $booking->created_at->format('d M Y, H:i') }}</div>
                    </div>

                    <div class="booking-body">
                        <div class="booking-details">
                            <div class="detail-item">
                                <span class="detail-label">Check-in</span>
                                <span class="detail-value">{{ $booking->check_in_date ? \Carbon\Carbon::parse($booking->check_in_date)->format('d M Y') : '-' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Check-out</span>
                                <span class="detail-value">{{ $booking->check_out_date ? \Carbon\Carbon::parse($booking->check_out_date)->format('d M Y') : '-' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Total Harga</span>
                                <span class="detail-value">Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Status Booking</span>
                                <span class="booking-status status-{{ strtolower(str_replace(' ', '-', $booking->status ?? 'pending')) }}">
                                    {{ $booking->status ?? 'Menunggu Konfirmasi' }}
                                </span>
                            </div>
                        </div>

                        @if($booking->payment_method || $booking->payment_amount)
                            <div class="payment-info">
                                <div class="payment-title">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                                        <line x1="2" y1="10" x2="22" y2="10"></line>
                                    </svg>
                                    Informasi Pembayaran
                                </div>
                                <div class="payment-details">
                                    <div class="payment-detail-item">
                                        <span class="payment-label">Metode</span>
                                        <span class="payment-value">{{ $booking->payment_method ? ucfirst(str_replace('_', ' ', $booking->payment_method)) : '-' }}</span>
                                    </div>
                                    <div class="payment-detail-item">
                                        <span class="payment-label">Jumlah</span>
                                        <span class="payment-value">Rp {{ number_format($booking->payment_amount ?? 0, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="payment-detail-item">
                                        <span class="payment-label">Tanggal Bayar</span>
                                        <span class="payment-value">{{ $booking->payment_date ? \Carbon\Carbon::parse($booking->payment_date)->format('d M Y') : '-' }}</span>
                                    </div>
                                    <div class="payment-detail-item">
                                        <span class="payment-label">Status</span>
                                        <span class="payment-value">{{ $booking->payment_status ? ucfirst(str_replace('_', ' ', $booking->payment_status)) : 'Belum Dibayar' }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="booking-actions">
                            @if($booking->status === 'confirmed' && (!$booking->payment_status || $booking->payment_status === 'pending_verification'))
                                <button class="btn btn-primary" onclick="showPaymentModal({{ $booking->id }})">Konfirmasi Pembayaran</button>
                            @endif
                            <a href="{{ route('rooms.show', $booking->room_id) }}" class="btn btn-secondary">Lihat Detail Kamar</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">📋</div>
            <div class="empty-title">Belum Ada Booking</div>
            <div class="empty-message">Anda belum melakukan booking apapun. Mulai booking kamar impian Anda sekarang!</div>
            <a href="{{ route('rooms') }}" class="btn btn-primary">Lihat Kamar Tersedia</a>
        </div>
    @endif
</div>

<!-- Payment Confirmation Modal -->
<div id="paymentModalOverlay" class="success-modal-overlay">
    <div class="success-modal" id="paymentModal">
        <div class="success-modal-header">
            <div class="success-icon">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14,2 14,8 20,8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10,9 9,9 8,9"></polyline>
                </svg>
            </div>
            <h2 class="success-modal-title">Konfirmasi Pembayaran</h2>
        </div>
        <div class="success-modal-body">
            <form id="paymentForm" action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="booking_id" name="booking_id" value="">

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="payment_method" style="display: block; margin-bottom: 8px; font-weight: 600; color: #1a1a1a;">Metode Pembayaran</label>
                    <select id="payment_method" name="payment_method" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; transition: border-color 0.3s;">
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="transfer_bank">Transfer Bank</option>
                        <option value="e_wallet">E-Wallet (GoPay, OVO, Dana)</option>
                        <option value="cash">Tunai</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="payment_amount" style="display: block; margin-bottom: 8px; font-weight: 600; color: #1a1a1a;">Jumlah Pembayaran</label>
                    <input type="number" id="payment_amount" name="payment_amount" required placeholder="Masukkan jumlah pembayaran" style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; transition: border-color 0.3s;">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="payment_date" style="display: block; margin-bottom: 8px; font-weight: 600; color: #1a1a1a;">Tanggal Pembayaran</label>
                    <input type="date" id="payment_date" name="payment_date" required max="{{ date('Y-m-d') }}" style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; transition: border-color 0.3s;">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="payment_proof" style="display: block; margin-bottom: 8px; font-weight: 600; color: #1a1a1a;">Bukti Pembayaran</label>
                    <input type="file" id="payment_proof" name="payment_proof" accept="image/*,.pdf" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; transition: border-color 0.3s;">
                    <small style="color: #666; font-size: 12px;">Upload gambar bukti transfer atau PDF (max 5MB)</small>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="payment_notes" style="display: block; margin-bottom: 8px; font-weight: 600; color: #1a1a1a;">Catatan (Opsional)</label>
                    <textarea id="payment_notes" name="payment_notes" rows="3" placeholder="Tambahkan catatan jika diperlukan..." style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; transition: border-color 0.3s;"></textarea>
                </div>

                <div class="success-actions">
                    <button type="button" class="success-btn success-btn-secondary" onclick="closePaymentModal()">Batal</button>
                    <button type="submit" class="success-btn success-btn-primary" id="submitPaymentBtn">Kirim Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Logout Confirmation Popup -->
<div id="logoutPopupOverlay" class="logout-popup-overlay">
    <div class="logout-popup">
        <div class="logout-popup-header">
            <h3 class="logout-popup-title">Konfirmasi Logout</h3>
        </div>
        <div class="logout-popup-body">
            <div class="logout-popup-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16,17 21,12 16,7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
            </div>
            <div class="logout-popup-message">Apakah Anda yakin ingin logout?</div>
            <div class="logout-popup-submessage">Anda akan diarahkan ke halaman login.</div>
        </div>
        <div class="logout-popup-actions">
            <button class="logout-popup-btn logout-popup-btn-cancel" onclick="hideLogoutPopup()">Batal</button>
            <button class="logout-popup-btn logout-popup-btn-logout" onclick="confirmLogout()">Logout</button>
        </div>
    </div>
</div>

<script>
    // Logout Popup Functions
    function showLogoutPopup() {
        document.getElementById('logoutPopupOverlay').style.display = 'flex';
    }

    function hideLogoutPopup() {
        document.getElementById('logoutPopupOverlay').style.display = 'none';
    }

    function confirmLogout() {
        // Create a form to submit logout
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("logout") }}';
        form.innerHTML = '@csrf';
        document.body.appendChild(form);
        form.submit();
    }

    // Payment Modal Functions
    function showPaymentModal(bookingId) {
        document.getElementById('booking_id').value = bookingId;
        document.getElementById('paymentModalOverlay').style.display = 'flex';
        document.getElementById('paymentModal').classList.add('show');
    }

    function closePaymentModal() {
        document.getElementById('paymentModalOverlay').style.display = 'none';
        document.getElementById('paymentModal').classList.remove('show');
    }

    // Submit Payment Confirmation
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        submitPaymentConfirmation();
    });

    function submitPaymentConfirmation() {
        const form = document.getElementById('paymentForm');
        const formData = new FormData(form);

        // Show loading state
        const submitBtn = document.getElementById('submitPaymentBtn');
        const cancelBtn = document.querySelector('#paymentModal .success-btn-secondary');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Mengirim...';
        cancelBtn.disabled = true;


            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            // Hide loading state
            submitBtn.disabled = false;
            submitBtn.textContent = 'Kirim Konfirmasi';
            cancelBtn.disabled = false;

            if (data.success) {
                // Success - close modal and show success message
                closePaymentModal();
                alert('Konfirmasi pembayaran berhasil dikirim! Kami akan memverifikasi pembayaran Anda dalam 1-2 hari kerja.');
                // Optionally reload the page to show updated status
                location.reload();
            } else {
                // Show error message
                showError(data.message || 'Terjadi kesalahan saat mengirim konfirmasi pembayaran.');
            }
        })
        .catch(error => {
            // Hide loading state
            submitBtn.disabled = false;
            submitBtn.textContent = 'Kirim Konfirmasi';
            cancelBtn.disabled = false;

            console.error('Error:', error);
            showError('Terjadi kesalahan jaringan. Silakan coba lagi.');
        });
    }

    function showError(message) {
        // Remove existing error messages
        const existingError = document.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }

        // Create and show error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message error';
        errorDiv.textContent = message;
        errorDiv.style.marginBottom = '20px';
        errorDiv.style.padding = '12px';
        errorDiv.style.borderRadius = '8px';
        errorDiv.style.backgroundColor = '#f8d7da';
        errorDiv.style.border = '1px solid #f5c6cb';

        const form = document.getElementById('paymentForm');
        form.insertBefore(errorDiv, form.firstChild);

        // Auto-hide error after 5 seconds
        setTimeout(() => {
            if (errorDiv.parentNode) {
                errorDiv.remove();
            }
        }, 5000);
    }

    // Add loading state to form elements
    function setFormLoading(loading) {
        const form = document.getElementById('paymentForm');
        const inputs = form.querySelectorAll('input, select, textarea, button');

        inputs.forEach(input => {
            if (input.type !== 'submit') {
                input.disabled = loading;
                if (loading) {
                    input.classList.add('loading');
                } else {
                    input.classList.remove('loading');
                }
            }
        });
    }
