@extends('layouts.app')

@section('content')
<style>
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
                +62 877 6100 1778
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

    .contact-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 60px 80px;
        background: #f5f5f5;
    }

    .contact-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .contact-title {
        font-size: 36px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .contact-subtitle {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
    }

    .contact-content {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 60px;
        align-items: start;
    }

    /* Informasi Kontak Section */
    .info-section {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 30px;
    }

    .contact-info-item {
        display: flex;
        gap: 20px;
        padding: 25px;
        margin-bottom: 15px;
        background: #f8f9fa;
        border-radius: 12px;
        transition: all 0.3s;
    }

    .contact-info-item:hover {
        background: #f0f0f0;
        transform: translateY(-2px);
    }

    .icon-wrapper {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .icon-wrapper svg {
        color: #1a1a1a;
    }

    .contact-info-text {
        flex: 1;
    }

    .contact-info-label {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 5px;
    }

    .contact-info-value {
        font-size: 14px;
        color: #666;
        line-height: 1.5;
    }

    /* Quick Contact Section */
    .quick-contact {
        margin-top: 30px;
    }

    .quick-contact-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .contact-buttons {
        display: flex;
        gap: 15px;
    }

    .contact-btn {
        flex: 1;
        padding: 15px 20px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .contact-btn.whatsapp {
        background: #25D366;
        color: white;
    }

    .contact-btn.whatsapp:hover {
        background: #20BD5A;
        transform: translateY(-2px);
    }

    .contact-btn.phone {
        background: white;
        color: #1a1a1a;
        border: 2px solid #e0e0e0;
    }

    .contact-btn.phone:hover {
        background: #f5f5f5;
        border-color: #1a1a1a;
    }

    /* Social Media Section */
    .social-media {
        margin-top: 30px;
    }

    .social-buttons {
        display: flex;
        gap: 10px;
    }

    .social-btn {
        flex: 1;
        padding: 12px 15px;
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #1a1a1a;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
    }

    .social-btn:hover {
        background: #f5f5f5;
        border-color: #1a1a1a;
        transform: translateY(-2px);
    }

    /* Form Section */
    .form-section {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-label {
        display: block;
        font-size: 15px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 15px;
        font-family: 'Inter', sans-serif;
        transition: all 0.3s;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #1a1a1a;
        box-shadow: 0 0 0 3px rgba(0,0,0,0.05);
    }

    .form-textarea {
        resize: vertical;
        min-height: 150px;
    }

    .submit-button {
        width: 100%;
        padding: 16px 30px;
        background: #1a1a1a;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .submit-button:hover {
        background: #333;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .form-tips {
        background: #fff3cd;
        padding: 15px 20px;
        border-radius: 10px;
        margin-top: 20px;
        display: flex;
        gap: 12px;
        align-items: start;
    }

    .form-tips-icon {
        font-size: 18px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .form-tips-text {
        font-size: 14px;
        color: #666;
        line-height: 1.5;
    }

    .form-tips-text strong {
        color: #1a1a1a;
        font-weight: 600;
    }

    /* Success Popup Notification */
    .popup-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        padding: 20px 25px;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        gap: 15px;
        min-width: 320px;
        z-index: 10000;
        transform: translateX(400px);
        opacity: 0;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .popup-notification.show {
        transform: translateX(0);
        opacity: 1;
    }

    .popup-icon {
        width: 45px;
        height: 45px;
        background: #22c55e;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .popup-content {
        flex: 1;
    }

    .popup-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 3px;
    }

    .popup-message {
        font-size: 14px;
        color: #666;
    }

    .popup-close {
        background: none;
        border: none;
        font-size: 20px;
        color: #999;
        cursor: pointer;
        padding: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.3s;
    }

    .popup-close:hover {
        color: #333;
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
        .contact-container {
            padding: 40px 30px;
        }

        .contact-content {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .popup-notification {
            right: 10px;
            left: 10px;
            min-width: auto;
        }
    }
</style>

<div class="contact-container">
    <div class="contact-header">
        <h1 class="contact-title">Hubungi Kami</h1>
        <p class="contact-subtitle">
            Punya pertanyaan atau ingin survey langsung? Tim kami siap membantu Anda 24/7
        </p>
    </div>

    <div class="contact-content">
        <!-- Informasi Kontak -->
        <div class="info-section">
            <h2 class="section-title">Informasi Kontak</h2>

            <div class="contact-info-item">
                <div class="icon-wrapper">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </div>
                <div class="contact-info-text">
                    <div class="contact-info-label">Telepon & WhatsApp</div>
                    <div class="contact-info-value">+62 877-6100-1778</div>
                </div>
            </div>

            <div class="contact-info-item">
                <div class="icon-wrapper">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <div class="contact-info-text">
                    <div class="contact-info-label">Email</div>
                    <div class="contact-info-value">info@lagitakost.com</div>
                </div>
            </div>

            <div class="contact-info-item">
                <div class="icon-wrapper">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <div class="contact-info-text">
                    <div class="contact-info-label">Alamat</div>
                    <div class="contact-info-value">
                    Jl. Bangau Sakti, Kec. Tampan<br>
                    Pekanbaru, Riau 28292
                        
                    </div>
                </div>
            </div>

            <div class="contact-info-item">
                <div class="icon-wrapper">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <div class="contact-info-text">
                    <div class="contact-info-label">Jam Operasional</div>
                    <div class="contact-info-value">
                        Senin - Minggu: 08:00 - 21:00<br>
                        Emergency: 24 jam
                    </div>
                </div>
            </div>

            <!-- Kontak Cepat -->
            <div class="quick-contact">
                <h3 class="quick-contact-title">Kontak Cepat</h3>
                <div class="contact-buttons">
                    <a href="https://wa.me/6287761001778" class="contact-btn whatsapp" target="_blank">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        WhatsApp
                    </a>
                    <a href="tel:+6287761001778" class="contact-btn phone">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        Telepon
                    </a>
                </div>
            </div>


        </div>

        <!-- Form Kirim Pesan -->
        <div class="form-section">
            <h2 class="section-title">Kirim Pesan</h2>

            <form id="contactForm" method="POST" action="{{ route('contact.send') }}">
                @csrf
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-input" placeholder="Masukkan nama Anda" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="tel" name="phone" class="form-input" placeholder="Contoh: 08123456789" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input" placeholder="contoh@email.com" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Subjek</label>
                    <input type="text" name="subject" class="form-input" placeholder="Tanya kamar tersedia" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Pesan</label>
                    <textarea name="message" class="form-textarea" placeholder="Ceritakan kebutuhan Anda..." required></textarea>
                </div>

                <button type="submit" class="submit-button">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                    Kirim Pesan
                </button>

                <div class="form-tips">
                    <div class="form-tips-icon">💡</div>
                    <div class="form-tips-text">
                        <strong>Tips:</strong> Untuk respon lebih cepat, langsung hubungi WhatsApp kami atau datang langsung untuk survey lokasi.
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Success Popup Notification -->
<div id="successPopup" class="popup-notification">
    <div class="popup-icon">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3">
            <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
    </div>
    <div class="popup-content">
        <div class="popup-title">Pesan Terkirim!</div>
        <div class="popup-message">Terima kasih, kami akan segera menghubungi Anda.</div>
    </div>
    <button class="popup-close" onclick="closePopup()">×</button>
</div>

<!-- Logout Confirmation Popup -->
<div id="logoutPopup" class="logout-popup-overlay">
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
            <div class="logout-popup-submessage">Anda akan diarahkan ke halaman login.</div>
        </div>
        <div class="logout-popup-actions">
            <button class="logout-popup-btn logout-popup-btn-cancel" onclick="cancelLogout()">Batal</button>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-popup-btn logout-popup-btn-logout">Ya, Keluar</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Handle form submission
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        // Show loading state
        const submitBtn = this.querySelector('.submit-button');
        submitBtn.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10" opacity="0.25"></circle><path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"><animateTransform attributeName="transform" type="rotate" from="0 12 12" to="360 12 12" dur="1s" repeatCount="indefinite"/></path></svg> Mengirim...';
        submitBtn.disabled = true;

        // Send AJAX request
        fetch('{{ route("contact.send") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reset form
                this.reset();

                // Show success popup
                showPopup();
            } else {
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        })
        .finally(() => {
            // Reset button
            submitBtn.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg> Kirim Pesan';
            submitBtn.disabled = false;
        });
    });

    function showPopup() {
        const popup = document.getElementById('successPopup');
        popup.classList.add('show');
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            closePopup();
        }, 5000);
    }

    function closePopup() {
        const popup = document.getElementById('successPopup');
        popup.classList.remove('show');
    }

    // Logout popup functions
    function showLogoutPopup() {
        const popup = document.getElementById('logoutPopup');
        popup.style.display = 'flex';
    }

    function cancelLogout() {
        const popup = document.getElementById('logoutPopup');
        popup.style.display = 'none';
    }
</script>

@endsection