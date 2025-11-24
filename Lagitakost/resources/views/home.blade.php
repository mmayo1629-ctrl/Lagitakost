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
        background: #f5f5f5;
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
        position: relative;
    }

    .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #dc3545;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 600;
        z-index: 10;
    }

    .user-profile {
        position: relative;
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

    .hero-section {
        background: #f8f9fa;
        padding: 60px 80px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #fff3cd;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .hero-title {
        font-size: 48px;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1.2;
        margin-bottom: 20px;
    }

    .hero-description {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .features {
        display: flex;
        gap: 30px;
        margin-bottom: 30px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 15px;
        color: #333;
    }

    .rating {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
    }

    .stars {
        color: #ffc107;
        font-size: 18px;
    }

    .rating-text {
        font-size: 15px;
        color: #333;
        font-weight: 500;
    }

    .cta-button {
        background: #1a1a1a;
        color: white;
        padding: 16px 40px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
    }

    .cta-button:hover {
        background: #333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .hero-image {
        position: relative;
    }

    .price-card {
        position: absolute;
        top: 20px;
        right: 20px;
        background: white;
        padding: 20px 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        text-align: center;
        z-index: 10;
    }

    .price-label {
        font-size: 13px;
        color: #666;
        margin-bottom: 5px;
    }

    .price {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .price-period {
        font-size: 14px;
        color: #666;
    }

    .main-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .availability-badge {
        position: absolute;
        bottom: 30px;
        right: 30px;
        background: white;
        padding: 15px 25px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        font-weight: 600;
        font-size: 18px;
        color: #22c55e;
    }

    .stats-section {
        display: flex;
        justify-content: center;
        gap: 80px;
        padding: 50px 80px;
        background: white;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 42px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 15px;
        color: #666;
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
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
    @keyframes popupSlideIn {
        0% {
            opacity: 0;
            transform: scale(0.7) translateY(-50px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
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

        .hero-section {
            grid-template-columns: 1fr;
            padding: 40px 30px;
        }

        .hero-title {
            font-size: 36px;
        }

        .stats-section {
            flex-wrap: wrap;
            gap: 40px;
            padding: 40px 30px;
        }
    }
</style>

<!-- Custom Navbar -->
<nav class="custom-navbar">
    <a href="/" class="navbar-brand-custom">
        <div class="brand-logo">LK</div>
        <div class="brand-text">
            <span class="brand-name">Lagita Kost</span>
            <span class="brand-tagline">Boarding Kost Premium</span>
        </div>
    </a>

    <ul class="navbar-menu">
        <li><a href="{{ route('rooms') }}">Kamar</a></li>
        <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
        <li><a href="{{ route('location') }}">Lokasi</a></li>
        <li><a href="{{ route('contact') }}">Kontak</a></li>
    </ul>

    <div class="navbar-actions">
        <a href="{{ route('dashboard') }}" class="user-profile" style="text-decoration: none; position: relative;">
            @if(isset($notificationCount) && $notificationCount > 0)
                <div class="notification-badge">{{ $notificationCount }}</div>
            @endif
            <div class="user-avatar">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ auth()->user()->is_admin ? 'Admin' : 'Customer' }}</div>
            </div>
        </a>
        <button type="button" class="logout-btn" onclick="showLogoutPopup()">Logout</button>
    </div>

    <button class="mobile-menu-toggle">☰</button>
</nav>

<!-- Logout Popup -->
<div class="logout-popup-overlay" id="logoutPopup">
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
            <div class="logout-popup-message">Apakah Anda yakin ingin keluar?</div>
            <div class="logout-popup-submessage">Anda akan diarahkan ke halaman login</div>
        </div>
        <div class="logout-popup-actions">
            <button class="logout-popup-btn logout-popup-btn-cancel" onclick="hideLogoutPopup()">Batal</button>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-popup-btn logout-popup-btn-logout">Logout</button>
            </form>
        </div>
    </div>
</div>



<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <div class="badge">
            ⭐ Kost Terpercaya #1 di Kota Pekanbaru
        </div>

        <h1 class="hero-title">Kost Nyaman untuk Mahasiswi</h1>

        <p class="hero-description">
            Temukan hunian yang nyaman, aman, dan terjangkau dengan fasilitas lengkap.
            Lokasi strategis dekat kampus dan pusat bisnis.
        </p>

        <div class="features">
            <div class="feature-item">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
                Dekat Universitas Riau
            </div>
            <div class="feature-item">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 20h9"></path>
                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                </svg>
                WiFi Unlimited
            </div>
            <div class="feature-item">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Komunitas Aktif
            </div>
        </div>

        <div class="rating">
            <div class="stars">⭐⭐⭐⭐⭐</div>
            <span class="rating-text">4.9/5 dari 150+ penghuni</span>
        </div>

        <a href="{{ route('rooms') }}" class="cta-button">
            Lihat Kamar Tersedia
        </a>
    </div>

    <div class="hero-image">
        <div class="price-card">
            <div class="price-label">Mulai dari</div>
            <div class="price">Rp 500rb</div>
            <div class="price-period">/bulan</div>
        </div>
        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800" alt="Lagita Kost" class="main-image">
        <div class="availability-badge">
            Tersedia<br>30+ Kamar
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="stat-item">
        <div class="stat-number">30+</div>
        <div class="stat-label">Kamar Tersedia</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">24/7</div>
        <div class="stat-label">Keamanan</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">5 Min</div>
        <div class="stat-label">ke UNRI</div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-section" style="background: white; padding: 80px 80px;">
    <div class="contact-form-container" style="max-width: 1200px; margin: 0 auto;">
        <div class="contact-form-header" style="text-align: center; margin-bottom: 50px;">
            <h2 style="font-size: 36px; font-weight: 700; color: #1a1a1a; margin-bottom: 15px;">Hubungi Kami Sekarang</h2>
            <p style="font-size: 16px; color: #666; line-height: 1.6; max-width: 600px; margin: 0 auto;">
                Punya pertanyaan atau ingin survey langsung? Kirim pesan kepada kami dan tim kami akan segera menghubungi Anda.
            </p>
        </div>

        <div class="contact-form-content" style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start;">
            <!-- Contact Info -->
            <div class="contact-info">
                <h3 style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin-bottom: 30px;">Informasi Kontak</h3>

                <div class="contact-info-items">
                    <div class="contact-info-item" style="display: flex; gap: 20px; padding: 20px; margin-bottom: 15px; background: #f8f9fa; border-radius: 12px; transition: all 0.3s;">
                        <div class="icon-wrapper" style="width: 50px; height: 50px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div class="contact-info-text">
                            <div class="contact-info-label" style="font-size: 16px; font-weight: 600; color: #1a1a1a; margin-bottom: 5px;">Telepon & WhatsApp</div>
                            <div class="contact-info-value" style="font-size: 14px; color: #666; line-height: 1.5;">+62 877-6100-1778</div>
                        </div>
                    </div>

                    <div class="contact-info-item" style="display: flex; gap: 20px; padding: 20px; margin-bottom: 15px; background: #f8f9fa; border-radius: 12px; transition: all 0.3s;">
                        <div class="icon-wrapper" style="width: 50px; height: 50px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <div class="contact-info-text">
                            <div class="contact-info-label" style="font-size: 16px; font-weight: 600; color: #1a1a1a; margin-bottom: 5px;">Email</div>
                            <div class="contact-info-value" style="font-size: 14px; color: #666; line-height: 1.5;">info@lagitakost.com</div>
                        </div>
                    </div>

                    <div class="contact-info-item" style="display: flex; gap: 20px; padding: 20px; margin-bottom: 15px; background: #f8f9fa; border-radius: 12px; transition: all 0.3s;">
                        <div class="icon-wrapper" style="width: 50px; height: 50px; background: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <div class="contact-info-text">
                            <div class="contact-info-label" style="font-size: 16px; font-weight: 600; color: #1a1a1a; margin-bottom: 5px;">Alamat</div>
                            <div class="contact-info-value" style="font-size: 14px; color: #666; line-height: 1.5;">
                            Jl. Bangau Sakti, Kec. Tampan<br>
                            Pekanbaru, Riau 28292
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Contact Buttons -->
                <div class="quick-contact" style="margin-top: 30px;">
                    <h4 style="font-size: 18px; font-weight: 600; color: #1a1a1a; margin-bottom: 15px;">Kontak Cepat</h4>
                    <div class="contact-buttons" style="display: flex; gap: 15px;">
                        <a href="https://wa.me/6287761001778" style="flex: 1; padding: 15px 20px; border-radius: 10px; font-size: 15px; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; background: #25D366; color: white;" target="_blank">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            WhatsApp
                        </a>
                        <a href="tel:+62 877-6100-1778" style="flex: 1; padding: 15px 20px; border-radius: 10px; font-size: 15px; font-weight: 600; border: 2px solid #e0e0e0; cursor: pointer; transition: all 0.3s; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; background: white; color: #1a1a1a;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            Telepon
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrapper" style="background: #f8f9fa; padding: 40px; border-radius: 16px;">
                <h3 style="font-size: 24px; font-weight: 700; color: #1a1a1a; margin-bottom: 30px;">Kirim Pesan</h3>

                <form id="homeContactForm" method="POST" action="{{ route('contact.send') }}">
                    @csrf

                    <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label style="display: block; font-size: 15px; font-weight: 600; color: #1a1a1a; margin-bottom: 10px;">Nama Lengkap</label>
                            <input type="text" name="name" style="width: 100%; padding: 14px 18px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 15px; font-family: 'Inter', sans-serif; transition: all 0.3s;" placeholder="Masukkan nama Anda" required>
                        </div>

                        <div class="form-group">
                            <label style="display: block; font-size: 15px; font-weight: 600; color: #1a1a1a; margin-bottom: 10px;">Nomor Telepon</label>
                            <input type="tel" name="phone" style="width: 100%; padding: 14px 18px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 15px; font-family: 'Inter', sans-serif; transition: all 0.3s;" placeholder="Contoh: 08123456789" required>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 15px; font-weight: 600; color: #1a1a1a; margin-bottom: 10px;">Email</label>
                        <input type="email" name="email" style="width: 100%; padding: 14px 18px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 15px; font-family: 'Inter', sans-serif; transition: all 0.3s;" placeholder="Masukkan email Anda" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 15px; font-weight: 600; color: #1a1a1a; margin-bottom: 10px;">Subjek</label>
                        <input type="text" name="subject" style="width: 100%; padding: 14px 18px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 15px; font-family: 'Inter', sans-serif; transition: all 0.3s;" placeholder="Contoh: Tanya kamar tersedia" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 30px;">
                        <label style="display: block; font-size: 15px; font-weight: 600; color: #1a1a1a; margin-bottom: 10px;">Pesan</label>
                        <textarea name="message" rows="5" style="width: 100%; padding: 14px 18px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 15px; font-family: 'Inter', sans-serif; transition: all 0.3s; resize: vertical;" placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>

                    <button type="submit" style="width: 100%; padding: 16px 20px; border-radius: 10px; font-size: 16px; font-weight: 600; border: none; cursor: pointer; transition: all 0.3s; background: #1a1a1a; color: white;">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function showLogoutPopup() {
        document.getElementById('logoutPopup').style.display = 'flex';
    }

    function hideLogoutPopup() {
        document.getElementById('logoutPopup').style.display = 'none';
    }

    // Close popup when clicking outside
    document.getElementById('logoutPopup').addEventListener('click', function(e) {
        if (e.target === this) {
            hideLogoutPopup();
        }
    });

    // Form validation and submission feedback
    document.getElementById('homeContactForm').addEventListener('submit', function(e) {
        // Basic validation
        const name = this.name.value.trim();
        const phone = this.phone.value.trim();
        const email = this.email.value.trim();
        const message = this.message.value.trim();

        if (!name || !phone || !email || !message) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan.');
            return;
        }

        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.textContent = 'Mengirim...';
        submitBtn.disabled = true;
    });
</script>

<!-- Footer -->
<footer style="background: #1a1a1a; color: white; padding: 60px 80px 30px; margin-top: 80px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; margin-bottom: 40px;">
            <!-- Company Info -->
            <div>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                    <div style="background: white; color: #1a1a1a; width: 42px; height: 42px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 16px;">LK</div>
                    <div>
                        <div style="font-size: 18px; font-weight: 700;">Lagita Kost</div>
                        <div style="font-size: 12px; color: #ccc;">Boarding Kost Premium</div>
                    </div>
                </div>
                <p style="color: #ccc; line-height: 1.6; margin-bottom: 20px;">
                    Kost nyaman dan terpercaya untuk mahasiswi di Pekanbaru. Lokasi strategis dekat Universitas Riau dengan fasilitas lengkap dan keamanan 24/7.
                </p>
                <div style="display: flex; gap: 15px;">
                    <a href="https://wa.me/6287761001778" style="color: #25D366; text-decoration: none; font-size: 24px;" target="_blank">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>
                    <a href="tel:+6287761001778" style="color: #666; text-decoration: none; font-size: 24px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </a>
                    <a href="mailto:info@lagitakost.com" style="color: #666; text-decoration: none; font-size: 24px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 style="font-size: 18px; font-weight: 700; margin-bottom: 20px; color: white;">Menu Utama</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 10px;"><a href="{{ route('rooms') }}" style="color: #ccc; text-decoration: none; transition: color 0.3s;">Kamar Tersedia</a></li>
                    <li style="margin-bottom: 10px;"><a href="{{ route('fasilitas') }}" style="color: #ccc; text-decoration: none; transition: color 0.3s;">Fasilitas</a></li>
                    <li style="margin-bottom: 10px;"><a href="{{ route('location') }}" style="color: #ccc; text-decoration: none; transition: color 0.3s;">Lokasi</a></li>
                    <li style="margin-bottom: 10px;"><a href="{{ route('contact') }}" style="color: #ccc; text-decoration: none; transition: color 0.3s;">Kontak</a></li>
                    <li style="margin-bottom: 10px;"><a href="{{ route('dashboard') }}" style="color: #ccc; text-decoration: none; transition: color 0.3s;">Dashboard</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 style="font-size: 18px; font-weight: 700; margin-bottom: 20px; color: white;">Kontak Kami</h4>
                <div style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 15px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2" style="margin-top: 2px; flex-shrink: 0;">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <div style="color: #ccc; font-size: 14px; line-height: 1.5;">
                        Jl. Bangau Sakti, Kec. Tampan<br>
                        Pekanbaru, Riau 28292
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    <a href="tel:+6287761001778" style="color: #ccc; text-decoration: none; font-size: 14px;">+62 877-6100-1778</a>
                </div>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <a href="mailto:info@lagitakost.com" style="color: #ccc; text-decoration: none; font-size: 14px;">info@lagitakost.com</a>
                </div>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 style="font-size: 18px; font-weight: 700; margin-bottom: 20px; color: white;">Berlangganan Update</h4>
                <p style="color: #ccc; font-size: 14px; line-height: 1.5; margin-bottom: 15px;">
                    Dapatkan informasi terbaru tentang kamar kosong dan promo spesial.
                </p>
                <div style="display: flex; gap: 10px;">
                    <input type="email" placeholder="Email Anda" style="flex: 1; padding: 10px 15px; border: 1px solid #444; border-radius: 6px; background: #333; color: white; font-size: 14px;">
                    <button style="padding: 10px 15px; background: #1a1a1a; border: 1px solid #666; border-radius: 6px; color: white; cursor: pointer; transition: all 0.3s;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22,2 15,22 11,13 2,9"></polygon>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div style="border-top: 1px solid #444; padding-top: 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div style="color: #ccc; font-size: 14px;">
                © 2025 Lagita Kost. All rights reserved.
            </div>
            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <a href="#" style="color: #ccc; text-decoration: none; font-size: 14px; transition: color 0.3s;">Privacy Policy</a>
                <a href="#" style="color: #ccc; text-decoration: none; font-size: 14px; transition: color 0.3s;">Terms of Service</a>
                <a href="#" style="color: #ccc; text-decoration: none; font-size: 14px; transition: color 0.3s;">FAQ</a>
            </div>
        </div>
    </div>
</footer>

@endsection
