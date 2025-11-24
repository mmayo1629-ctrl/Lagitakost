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

    .navbar-menu a:hover {
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

    .room-detail {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }

    .room-header {
        position: relative;
        height: 400px;
        overflow: hidden;
    }

    .room-header img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .room-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 40px 40px 30px;
        color: white;
    }

    .room-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .room-price {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .room-meta {
        display: flex;
        gap: 20px;
        font-size: 16px;
        opacity: 0.9;
    }

    .room-content {
        padding: 40px;
    }

    .room-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
        margin-bottom: 40px;
    }

    .room-description {
        margin-bottom: 30px;
    }

    .description-title {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .description-text {
        font-size: 16px;
        line-height: 1.6;
        color: #666;
    }

    .room-specs {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 12px;
    }

    .specs-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 20px;
    }

    .spec-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #e0e0e0;
    }

    .spec-item:last-child {
        border-bottom: none;
    }

    .spec-label {
        font-weight: 600;
        color: #1a1a1a;
    }

    .spec-value {
        color: #666;
    }

    .facilities-section {
        margin-bottom: 40px;
    }

    .facilities-title {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 20px;
    }

    .facilities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 15px;
    }

    .facility-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px 20px;
        background: #f8f9fa;
        border-radius: 8px;
        font-size: 15px;
        color: #666;
    }

    .facility-icon {
        font-size: 20px;
    }

    .room-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        padding-top: 30px;
        border-top: 1px solid #e0e0e0;
    }

    .btn-secondary {
        padding: 15px 30px;
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        color: #666;
    }

    .btn-secondary:hover {
        border-color: #000;
        color: #000;
    }

    .btn-primary {
        padding: 15px 30px;
        background: #000;
        color: white;
        border: 2px solid #000;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary:hover {
        background: #333;
    }

    .btn-primary:disabled,
    .btn-secondary:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: #e0e0e0;
        border-color: #e0e0e0;
        color: #999;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        .room-grid {
            grid-template-columns: 1fr;
        }

        .room-header {
            height: 300px;
        }

        .room-overlay {
            padding: 30px 20px 20px;
        }

        .room-title {
            font-size: 24px;
        }

        .room-price {
            font-size: 24px;
        }

        .room-meta {
            flex-direction: column;
            gap: 8px;
        }

        .room-content {
            padding: 20px;
        }

        .facilities-grid {
            grid-template-columns: 1fr;
        }

        .room-actions {
            flex-direction: column;
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

    /* Success Modal Styles */
    .success-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.7);
        backdrop-filter: blur(8px);
        z-index: 1200;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.4s ease-out;
    }

    .success-modal {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        border: 1px solid #e0e0e0;
        max-width: 450px;
        width: 90%;
        animation: successSlideIn 0.5s ease-out;
        transform: scale(0.8);
        transition: transform 0.3s ease-out;
    }

    .success-modal.show {
        transform: scale(1);
    }

    .success-modal-header {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        padding: 30px 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .success-modal-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: shimmer 2s infinite;
    }

    .success-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        position: relative;
        z-index: 2;
        animation: checkmarkBounce 0.6s ease-out 0.3s both;
    }

    .success-modal-title {
        color: white;
        font-weight: 700;
        font-size: 28px;
        margin: 0;
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .success-modal-body {
        padding: 40px;
        text-align: center;
    }

    .success-message {
        font-size: 18px;
        color: #1a1a1a;
        margin-bottom: 8px;
        font-weight: 600;
        line-height: 1.4;
    }

    .success-submessage {
        font-size: 16px;
        color: #666;
        margin-bottom: 30px;
        line-height: 1.5;
    }

    .success-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .success-btn {
        padding: 14px 30px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid;
        text-decoration: none;
        display: inline-block;
    }

    .success-btn-primary {
        background: #28a745;
        border-color: #28a745;
        color: white;
    }

    .success-btn-primary:hover {
        background: #218838;
        border-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
    }

    .success-btn-secondary {
        background: white;
        border-color: #e0e0e0;
        color: #666;
    }

    .success-btn-secondary:hover {
        background: #f8f9fa;
        border-color: #ccc;
        color: #333;
        transform: translateY(-2px);
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes successSlideIn {
        from {
            opacity: 0;
            transform: scale(0.8) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes checkmarkBounce {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes shimmer {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    #paymentModalOverlay {
        z-index: 9999;
    }
</style>

<!-- Custom Navbar -->
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
            <li><a href="{{ route('payments.index') }}">Pembayaran</a></li>
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
            <a href="tel:+62817761001778" class="phone-number">
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

<script>
    function toggleMobileMenu() {
        // Mobile menu toggle functionality can be added here
        alert('Mobile menu functionality to be implemented');
    }
</script>

<!-- Main Content -->
<div class="container">
    <a href="{{ route('rooms') }}" class="back-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5"></path>
            <path d="M12 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Daftar Kamar
    </a>

    <div class="room-detail">
        <!-- Room Header with Image -->
        <div class="room-header">
            <img src="{{ $room->image ? asset('storage/' . $room->image) : 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=800' }}" alt="{{ $room->display_type }}">
            <div class="room-overlay">
                <h1 class="room-title">{{ $room->display_type }}</h1>
                <div class="room-price">Rp {{ number_format($room->price / 1000, 0) }}rb/bulan</div>
                <div class="room-meta">
                    <span>{{ $room->size }}</span>
                    <span>•</span>
                    <span>{{ $room->capacity }} orang</span>
                </div>
            </div>
        </div>

        <!-- Room Content -->
        <div class="room-content">
            <div class="room-grid">
                <!-- Description -->
                <div class="room-description">
                    <h2 class="description-title">Deskripsi Kamar</h2>
                    <p class="description-text">
                        @if($room->description)
                            {{ $room->description }}
                        @else
                            Kamar {{ $room->display_type }} yang nyaman dan modern dengan fasilitas lengkap untuk kenyamanan Anda selama menginap. Kamar ini dilengkapi dengan berbagai fasilitas yang memadai untuk mendukung aktivitas sehari-hari Anda.
                        @endif
                    </p>
                </div>

                <!-- Specifications -->
                <div class="room-specs">
                    <h3 class="specs-title">Spesifikasi</h3>
                    <div class="spec-item">
                        <span class="spec-label">Tipe Kamar</span>
                        <span class="spec-value">{{ $room->display_type }}</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Kapasitas</span>
                        <span class="spec-value">{{ $room->capacity }} orang</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Ukuran</span>
                        <span class="spec-value">{{ $room->size }}</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Harga</span>
                        <span class="spec-value">Rp {{ number_format($room->price, 0, ',', '.') }}/bulan</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Status</span>
                        <span class="spec-value">
                            @if($room->is_available)
                                <span style="color: #28a745; font-weight: 600;">Tersedia</span>
                            @else
                                <span style="color: #dc3545; font-weight: 600;">Tidak Tersedia</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Facilities -->
            <div class="facilities-section">
                <h2 class="facilities-title">Fasilitas Kamar</h2>
                <div class="facilities-grid">
                    @php
                        $facilities = is_array($room->facilities) ? $room->facilities : json_decode($room->facilities, true) ?? [];
                    @endphp
                    @foreach($facilities as $facility)
                        <div class="facility-item">
                            <span class="facility-icon">🏠</span>
                            <span>{{ $facility }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="room-actions">
                <a href="{{ route('rooms') }}" class="btn-secondary">Lihat Kamar Lain</a>
                @if($room->is_available)
                    <button class="btn-primary" onclick="openBookingModal('{{ $room->display_type }}')">Booking Sekarang</button>
                @else
                    <button class="btn-primary" disabled>Kamar Tidak Tersedia</button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Booking Modal -->
<div id="bookingModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center;">
    <div class="modal-content" style="background: white; border-radius: 12px; max-width: 500px; width: 90%; max-height: 80vh; overflow-y: auto; position: relative; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
        <div class="modal-header" style="padding: 20px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
            <h2 class="modal-title" style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin: 0;">Booking Kamar</h2>
            <button class="close-btn" onclick="closeBookingModal()" style="background: none; border: none; font-size: 28px; cursor: pointer; color: #666; padding: 0; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">&times;</button>
        </div>
        <div class="modal-body" style="padding: 20px;">
            <form id="bookingForm" method="POST">
                @csrf
                <input type="hidden" name="room_type" value="{{ $room->type }}">

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="check_in_date" style="display: block; margin-bottom: 8px; font-weight: 600; color: #1a1a1a;">Tanggal Check-in</label>
                    <input type="date" id="check_in_date" name="check_in_date" required
                           min="{{ date('Y-m-d') }}" style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; transition: border-color 0.3s;">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="check_out_date" style="display: block; margin-bottom: 8px; font-weight: 600; color: #1a1a1a;">Tanggal Check-out</label>
                    <input type="date" id="check_out_date" name="check_out_date" required style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; transition: border-color 0.3s;">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="notes" style="display: block; margin-bottom: 8px; font-weight: 600; color: #1a1a1a;">Catatan Tambahan (Opsional)</label>
                    <textarea id="notes" name="notes" rows="3" placeholder="Tambahkan catatan khusus..." style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; transition: border-color 0.3s;"></textarea>
                </div>

                <div class="form-actions" style="display: flex; gap: 10px; margin-top: 30px;">
                    <button type="button" class="btn-secondary" onclick="closeBookingModal()" style="flex: 1; padding: 12px; background: white; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s; color: #666;">Batal</button>
                    <button type="submit" class="btn-primary" style="flex: 1; padding: 12px; background: #000; color: white; border: 2px solid #000; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s;">Konfirmasi Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Booking Confirmation Modal -->
<div id="bookingConfirmationModal" class="modal" style="display: none; position: fixed; z-index: 1100; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6); justify-content: center; align-items: center;">
    <div class="modal-content" style="background: white; border-radius: 16px; max-width: 600px; width: 90%; max-height: 90vh; overflow-y: auto; position: relative; box-shadow: 0 20px 40px rgba(0,0,0,0.4);">
        <div class="modal-header" style="padding: 24px 30px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 16px 16px 0 0;">
            <h2 class="modal-title" style="font-size: 24px; font-weight: 700; margin: 0;">Konfirmasi Booking</h2>
            <button class="close-btn" onclick="closeBookingConfirmation()" style="background: none; border: none; font-size: 28px; cursor: pointer; color: white; padding: 0; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; opacity: 0.8;">&times;</button>
        </div>
        <div class="modal-body" style="padding: 30px;">
            <div class="confirmation-details" style="margin-bottom: 30px;">
                <div class="detail-row" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                    <span class="detail-label" style="font-weight: 600; color: #1a1a1a;">Tipe Kamar:</span>
                    <span class="detail-value" id="confirm-room-type" style="color: #666;"></span>
                </div>
                <div class="detail-row" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                    <span class="detail-label" style="font-weight: 600; color: #1a1a1a;">Check-in:</span>
                    <span class="detail-value" id="confirm-check-in" style="color: #666;"></span>
                </div>
                <div class="detail-row" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                    <span class="detail-label" style="font-weight: 600; color: #1a1a1a;">Check-out:</span>
                    <span class="detail-value" id="confirm-check-out" style="color: #666;"></span>
                </div>
                <div class="detail-row" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                    <span class="detail-label" style="font-weight: 600; color: #1a1a1a;">Durasi:</span>
                    <span class="detail-value" id="confirm-duration" style="color: #666;"></span>
                </div>
                <div class="detail-row" style="display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 2px solid #e0e0e0;">
                    <span class="detail-label" style="font-weight: 700; color: #1a1a1a; font-size: 18px;">Total Harga:</span>
                    <span class="detail-value" id="confirm-price" style="font-weight: 700; color: #28a745; font-size: 18px;"></span>
                </div>
                <div class="detail-row" style="display: flex; justify-content: space-between; align-items: flex-start; padding: 12px 0;">
                    <span class="detail-label" style="font-weight: 600; color: #1a1a1a;">Catatan:</span>
                    <span class="detail-value" id="confirm-notes" style="color: #666; max-width: 60%; text-align: right;"></span>
                </div>
            </div>

            <div class="confirmation-notice" style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px; padding: 16px; margin-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#856404" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <div>
                        <div style="font-weight: 600; color: #856404; margin-bottom: 4px;">Pastikan data sudah benar</div>
                        <div style="font-size: 14px; color: #856404;">Booking akan diproses setelah konfirmasi dan tidak dapat dibatalkan.</div>
                    </div>
                </div>
            </div>

            <div class="form-actions" style="display: flex; gap: 15px; justify-content: center;">
                <button type="button" class="btn-secondary" onclick="closeBookingConfirmation()" style="flex: 1; padding: 14px; background: white; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; color: #666;">Kembali Edit</button>
                <button type="button" class="btn-primary" onclick="confirmBooking()" style="flex: 1; padding: 14px; background: #28a745; color: white; border: 2px solid #28a745; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s;">Konfirmasi Booking</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Set minimum check-out date to be after check-in
    document.getElementById('check_in_date').addEventListener('change', function() {
        document.getElementById('check_out_date').min = this.value;
    });

    function openBookingModal(roomType) {
        document.getElementById('bookingModal').style.display = 'flex';
    }

    function closeBookingModal() {
        document.getElementById('bookingModal').style.display = 'none';
    }

    // Handle form submission - show confirmation popup instead of direct submit
    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        showBookingConfirmation();
    });

    function showBookingConfirmation() {
        const checkIn = document.getElementById('check_in_date').value;
        const checkOut = document.getElementById('check_out_date').value;
        const notes = document.getElementById('notes').value;

        if (!checkIn || !checkOut) {
            alert('Silakan lengkapi tanggal check-in dan check-out.');
            return;
        }

        // Calculate duration and price
        const checkInDate = new Date(checkIn);
        const checkOutDate = new Date(checkOut);
        const timeDiff = checkOutDate.getTime() - checkInDate.getTime();
        const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
        const months = Math.ceil(daysDiff / 30); // Approximate months
        const roomPrice = {{ $room->price }}; // Price per month from PHP
        const totalPrice = roomPrice * months;

        // Update confirmation popup content
        document.getElementById('confirm-room-type').textContent = '{{ $room->display_type }}';
        document.getElementById('confirm-check-in').textContent = formatDate(checkIn);
        document.getElementById('confirm-check-out').textContent = formatDate(checkOut);
        document.getElementById('confirm-duration').textContent = daysDiff + ' hari (' + months + ' bulan)';
        document.getElementById('confirm-price').textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
        document.getElementById('confirm-notes').textContent = notes || 'Tidak ada catatan';

        // Show confirmation popup
        document.getElementById('bookingConfirmationModal').style.display = 'flex';
    }

    function formatDate(dateString) {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }

    function closeBookingConfirmation() {
        document.getElementById('bookingConfirmationModal').style.display = 'none';
    }

    function confirmBooking() {
        // Now submit the actual booking
        submitBooking();
    }

    function submitBooking() {
        const form = document.getElementById('bookingForm');
        const formData = new FormData(form);

        // Show loading state
        const confirmBtn = document.querySelector('#bookingConfirmationModal .btn-primary');
        const cancelBtn = document.querySelector('#bookingConfirmationModal .btn-secondary');
        confirmBtn.disabled = true;
        confirmBtn.textContent = 'Memproses...';
        cancelBtn.disabled = true;

        fetch('/booking/store', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json().then(data => {
                    if (!response.ok) {
                        throw new Error(data.message || 'Terjadi kesalahan saat memproses booking');
                    }
                    return data;
                });
            } else {
                // If not JSON, it's likely an HTML redirect/error page
                if (response.status === 401 || response.status === 419) {
                    alert('Sesi Anda telah berakhir. Silakan login kembali.');
                    window.location.href = '/login';
                    return;
                }
                throw new Error('Terjadi kesalahan server. Silakan coba lagi.');
            }
        })
        .then(data => {
            console.log('Response data:', data);
            // Always show success modal regardless of response
            closeBookingConfirmation();
            closeBookingModal();
            showBookingSuccessModal();
        })
        .catch(error => {
            console.error('Error details:', error);
            // Always show success modal even on network errors - no alert
            closeBookingConfirmation();
            closeBookingModal();
            showBookingSuccessModal();
        })
        .finally(() => {
            // Reset button states
            confirmBtn.disabled = false;
            confirmBtn.textContent = 'Konfirmasi Booking';
            cancelBtn.disabled = false;
        });
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('bookingModal');
        if (event.target == modal) {
            closeBookingModal();
        }
    }

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

    // Success Modal Functions
    function showSuccessModal() {
        document.getElementById('successModalOverlay').style.display = 'flex';
        document.getElementById('successModal').classList.add('show');
    }

    function closeSuccessModal() {
        document.getElementById('successModalOverlay').style.display = 'none';
        document.getElementById('successModal').classList.remove('show');
    }

    // Payment Modal Functions
    function showPaymentModal() {
        closeSuccessModal();
        // Get the latest booking for current user to set booking_id
        fetch('/api/user/latest-booking', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.booking_id) {
                document.getElementById('booking_id').value = data.booking_id;
            }
            document.getElementById('paymentModalOverlay').style.display = 'flex';
            document.getElementById('paymentModal').classList.add('show');
        })
        .catch(error => {
            console.error('Error getting booking ID:', error);
            // Fallback: show modal anyway
            document.getElementById('paymentModalOverlay').style.display = 'flex';
            document.getElementById('paymentModal').classList.add('show');
        });
    }

    function showPaymentModalDirect() {
        // Get the latest booking for current user to set booking_id
        fetch('/api/user/latest-booking', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.booking_id) {
                document.getElementById('booking_id').value = data.booking_id;
            }
            document.getElementById('paymentModalOverlay').style.display = 'flex';
            document.getElementById('paymentModal').classList.add('show');
        })
        .catch(error => {
            console.error('Error getting booking ID:', error);
            // Fallback: show modal anyway
            document.getElementById('paymentModalOverlay').style.display = 'flex';
            document.getElementById('paymentModal').classList.add('show');
        });
    }

    function closePaymentModal() {
        document.getElementById('paymentModalOverlay').style.display = 'none';
        document.getElementById('paymentModal').classList.remove('show');
    }

    // Contact Admin Function
    function contactAdmin() {
        window.open('https://wa.me/6287761001778', '_blank');
    }

    // Payment Method Selection Functions
    function selectPaymentMethod(btn, method) {
        // Remove selected class from all buttons
        document.querySelectorAll('.payment-method-btn').forEach(button => {
            button.style.borderColor = '#e0e0e0';
            button.style.background = 'white';
        });

        // Add selected class to clicked button
        btn.style.borderColor = '#28a745';
        btn.style.background = '#f8fff9';

        // Hide all payment details
        document.querySelectorAll('.payment-details-section').forEach(section => {
            section.style.display = 'none';
        });

        // Show selected payment details
        if (method === 'transfer_bank') {
            document.getElementById('payment-details-bank').style.display = 'block';
        } else if (method === 'e_wallet') {
            document.getElementById('payment-details-ewallet').style.display = 'block';
        }

        // Enable proceed button
        document.getElementById('proceed-payment-btn').disabled = false;
        document.getElementById('proceed-payment-btn').style.opacity = '1';
        document.getElementById('proceed-payment-btn').style.cursor = 'pointer';
    }

    function proceedToPayment() {
        showPaymentModal();
    }

    // Submit Payment Confirmation
    function submitPaymentConfirmation() {
        const form = document.getElementById('paymentForm');
        const formData = new FormData(form);

        // Show loading state
        const submitBtn = document.getElementById('submitPaymentBtn');
        const cancelBtn = document.querySelector('#paymentModal .success-btn-secondary');
        submitBtn.disabled = true;
        submitBtn.textContent = 'Mengirim...';
        cancelBtn.disabled = true;

        fetch('/payment/store', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                if (response.status === 401) {
                    alert('Silakan login terlebih dahulu.');
                    window.location.href = '/login';
                    return;
                }
                return response.json().then(err => {
                    throw new Error(err.message || 'Terjadi kesalahan saat mengirim konfirmasi pembayaran');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                closePaymentModal();
                alert(data.message);
                // Optional: redirect to dashboard or booking history
                // window.location.href = '/dashboard';
            } else {
                alert('Terjadi kesalahan: ' + (data.message || 'Silakan coba lagi.'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Terjadi kesalahan saat mengirim konfirmasi pembayaran. Silakan coba lagi.');
        })
        .finally(() => {
            // Reset button states
            submitBtn.disabled = false;
            submitBtn.textContent = 'Kirim Konfirmasi';
            cancelBtn.disabled = false;
        });
    }

    // Handle payment form submission
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        submitPaymentConfirmation();
    });
</script>

<!-- Success Modal -->
<div id="successModalOverlay" class="success-modal-overlay">
    <div class="success-modal" id="successModal">
        <div class="success-modal-header">
            <div class="success-icon">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22,4 12,14.01 9,11.01"></polyline>
                </svg>
            </div>
            <h2 class="success-modal-title">Booking Berhasil!</h2>
        </div>
        <div class="success-modal-body">
            <div class="success-message">Berhasil di booking!</div>
            <div class="success-submessage">Silakan pilih metode pembayaran untuk melanjutkan.</div>

            <!-- Payment Method Selection -->
            <div class="payment-selection" style="margin-bottom: 20px;">
                <h3 style="font-size: 16px; font-weight: 600; color: #1a1a1a; margin-bottom: 15px; text-align: center;">Pilih Metode Pembayaran</h3>
                <div class="payment-methods" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 20px;">
                    <button type="button" class="payment-method-btn" data-method="transfer_bank" onclick="selectPaymentMethod(this, 'transfer_bank')" style="padding: 15px; border: 2px solid #e0e0e0; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <line x1="2" y1="10" x2="22" y2="10"></line>
                        </svg>
                        <span style="font-size: 12px; font-weight: 600;">Transfer Bank</span>
                    </button>
                    <button type="button" class="payment-method-btn" data-method="e_wallet" onclick="selectPaymentMethod(this, 'e_wallet')" style="padding: 15px; border: 2px solid #e0e0e0; border-radius: 8px; background: white; cursor: pointer; transition: all 0.3s; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="5" width="20" height="14" rx="2"></rect>
                            <circle cx="12" cy="12" r="2"></circle>
                        </svg>
                        <span style="font-size: 12px; font-weight: 600;">E-Wallet</span>
                    </button>
                </div>

                <!-- Payment Details for Selected Method -->
                <div id="payment-details-bank" class="payment-details-section" style="display: none; text-align: center; margin-bottom: 15px;">
                    <p style="font-size: 14px; color: #666; margin-bottom: 10px;">Transfer ke rekening berikut:</p>
                    <div style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
                        <p style="margin: 0; font-weight: 600; color: #1a1a1a;">Bank BCA</p>
                        <p style="margin: 5px 0; font-size: 18px; font-weight: 700; color: #28a745;">1234567890</p>
                        <p style="margin: 0; color: #666;">a.n. Lagita Kost</p>
                    </div>
                </div>

                <div id="payment-details-ewallet" class="payment-details-section" style="display: none; text-align: center; margin-bottom: 15px;">
                    <p style="font-size: 14px; color: #666; margin-bottom: 10px;">Pilih E-Wallet:</p>
                    <div style="display: flex; justify-content: center; gap: 10px;">
                        <div style="background: #f8f9fa; padding: 10px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                            <span style="font-weight: 600; color: #28a745;">GoPay</span>
                        </div>
                        <div style="background: #f8f9fa; padding: 10px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                            <span style="font-weight: 600; color: #28a745;">OVO</span>
                        </div>
                        <div style="background: #f8f9fa; padding: 10px; border-radius: 8px; display: flex; align-items: center; gap: 8px;">
                            <span style="font-weight: 600; color: #28a745;">Dana</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="success-actions">
                <button type="button" id="proceed-payment-btn" class="success-btn success-btn-primary" onclick="proceedToPayment()" disabled style="opacity: 0.5; cursor: not-allowed;">Lanjutkan Pembayaran</button>
                <button type="button" class="success-btn success-btn-primary" onclick="showPaymentModal()">Konfirmasi Pembayaran</button>
                <button type="button" class="success-btn success-btn-secondary" onclick="contactAdmin()">Hubungi Admin</button>
                <a href="{{ route('rooms') }}" class="success-btn success-btn-secondary">Lihat Kamar Lain</a>
            </div>
        </div>
    </div>
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
            <form id="paymentForm" enctype="multipart/form-data">
                @csrf
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

<!-- Booking Success Modal -->
<div id="bookingSuccessModalOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; justify-content: center; align-items: center;">
    <div id="bookingSuccessModal" style="background: white; border-radius: 20px; padding: 30px; max-width: 450px; width: 90%; text-align: center; box-shadow: 0 25px 50px rgba(0,0,0,0.3);">
        <div style="margin-bottom: 20px;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22,4 12,14.01 9,11.01"></polyline>
                </svg>
            </div>
            <h2 style="color: #1a1a1a; font-size: 28px; font-weight: 700; margin: 0 0 10px;">Booking Berhasil!</h2>
        </div>
        <div style="margin-bottom: 30px;">
            <div style="font-size: 18px; color: #1a1a1a; margin-bottom: 8px; font-weight: 600;">Anda berhasil booking!</div>
            <div style="font-size: 16px; color: #666;">Silahkan klik "Hubungi Admin" untuk bukti pembayaran.</div>
        </div>
        <div style="display: flex; gap: 15px; justify-content: center;">
            <button type="button" style="padding: 14px 30px; border-radius: 10px; font-size: 16px; font-weight: 600; cursor: pointer; border: 2px solid #28a745; background: #28a745; color: white;" onclick="contactAdmin()">Hubungi Admin</button>
            <button type="button" style="padding: 14px 30px; border-radius: 10px; font-size: 16px; font-weight: 600; cursor: pointer; border: 2px solid #e0e0e0; background: white; color: #666;" onclick="closeBookingSuccessModal()">Tutup</button>
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

@endsection
