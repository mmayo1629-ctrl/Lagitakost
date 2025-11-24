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

    .location-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 60px 80px;
    }

    .location-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .location-title {
        font-size: 36px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .location-subtitle {
        font-size: 16px;
        color: #666;
    }

    .location-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    /* Map Section */
    .map-section {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .map-container {
        background: #e8eaf0;
        border-radius: 12px;
        height: 350px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
    }

    .map-icon {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .map-text {
        text-align: center;
    }

    .map-label {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .map-address {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }

    .map-buttons {
        display: flex;
        gap: 15px;
    }

    .map-btn {
        flex: 1;
        padding: 14px 20px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .map-btn.primary {
        background: #1a1a1a;
        color: white;
    }

    .map-btn.primary:hover {
        background: #333;
        transform: translateY(-2px);
    }

    .map-btn.secondary {
        background: white;
        color: #1a1a1a;
        border: 2px solid #e0e0e0;
    }

    .map-btn.secondary:hover {
        background: #f5f5f5;
        border-color: #1a1a1a;
    }

    /* Transport & Nearby Section */
    .info-section {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .section-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 25px;
    }

    /* Transport Items */
    .transport-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .transport-item {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 12px;
        transition: all 0.3s;
    }

    .transport-item:hover {
        background: #f0f0f0;
        transform: translateX(5px);
    }

    .transport-icon {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .transport-info {
        flex: 1;
    }

    .transport-name {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .transport-detail {
        font-size: 13px;
        color: #666;
    }

    .transport-distance {
        font-size: 13px;
        font-weight: 600;
        color: #666;
        white-space: nowrap;
    }

    /* Nearby Places */
    .nearby-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .nearby-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 18px;
        background: #f8f9fa;
        border-radius: 12px;
        transition: all 0.3s;
    }

    .nearby-item:hover {
        background: #f0f0f0;
        transform: translateX(5px);
    }

    .nearby-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 20px;
    }

    .nearby-icon.blue { background: #dbeafe; }
    .nearby-icon.green { background: #d1fae5; }
    .nearby-icon.yellow { background: #fef3c7; }
    .nearby-icon.pink { background: #fce7f3; }
    .nearby-icon.orange { background: #fed7aa; }

    .nearby-info {
        flex: 1;
    }

    .nearby-name {
        font-size: 15px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 3px;
    }

    .nearby-category {
        font-size: 12px;
        color: #666;
    }

    .nearby-time {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: #666;
        white-space: nowrap;
    }

    /* Advantages Section */
    .advantages-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        grid-column: 1 / -1;
        margin-top: 10px;
    }

    .advantages-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .advantage-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 18px;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .advantage-bullet {
        width: 10px;
        height: 10px;
        background: #1a1a1a;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .advantage-text {
        font-size: 15px;
        color: #333;
        line-height: 1.5;
    }

    @media (max-width: 1024px) {
        .location-content {
            grid-template-columns: 1fr;
        }

        .advantages-card {
            grid-column: 1;
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
    /* Login Popup Styles */
    .login-popup-overlay {
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
    .login-popup {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border: 1px solid #ddd;
        max-width: 400px;
        width: 90%;
        animation: popupSlideIn 0.3s ease-out;
    }
    .login-popup-header {
        border: none;
        border-radius: 8px 8px 0 0;
        background: white;
        padding: 20px 30px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }
    .login-popup-title {
        color: #333;
        font-weight: 600;
        font-size: 18px;
        margin: 0;
    }
    .login-popup-body {
        padding: 30px;
        text-align: center;
    }
    .login-popup-icon {
        font-size: 48px;
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
        box-sizing: border-box;
    }
    .form-input:focus {
        outline: none;
        border-color: #1a1a1a;
    }
    .login-popup-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 20px;
    }
    .login-popup-btn {
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        padding: 12px 30px;
        transition: all 0.3s ease;
        border: 1px solid;
        cursor: pointer;
    }
    .login-popup-btn-cancel {
        background: white;
        border-color: #6c757d;
        color: #6c757d;
    }
    .login-popup-btn-cancel:hover {
        background: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    .login-popup-btn-login {
        background: #1a1a1a;
        border-color: #1a1a1a;
        color: white;
    }
    .login-popup-btn-login:hover {
        background: #333;
        border-color: #333;
    }
    .login-popup-footer {
        padding: 20px 30px 30px;
        text-align: center;
        border-top: 1px solid #eee;
        margin-top: 20px;
    }
    .login-popup-footer p {
        font-size: 14px;
        color: #666;
        margin: 0;
    }
    .login-popup-footer a {
        color: #1a1a1a;
        text-decoration: none;
        font-weight: 600;
    }
    .login-popup-footer a:hover {
        text-decoration: underline;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    @media (max-width: 768px) {
        .location-container {
            padding: 40px 30px;
        }

        .map-buttons {
            flex-direction: column;
        }

        .advantages-list {
            grid-template-columns: 1fr;
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
                +62 877-6100-1778
            </a>

            <button type="button" class="contact-button" onclick="showLoginPopup()">Login</button>
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
                    <polyline points="16 17 21 12 16 7"></polyline>
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

<!-- Login Popup -->
<div class="login-popup-overlay" id="loginPopup">
    <div class="login-popup">
        <div class="login-popup-header">
            <h3 class="login-popup-title">Masuk ke Akun</h3>
        </div>
        <div class="login-popup-body">
            <div class="login-popup-icon">🔐</div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="Masukkan email Anda" required>
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-input" placeholder="Masukkan password Anda" required>
                </div>
                <div class="login-popup-actions">
                    <button type="button" class="login-popup-btn login-popup-btn-cancel" onclick="hideLoginPopup()">Batal</button>
                    <button type="submit" class="login-popup-btn login-popup-btn-login">Masuk</button>
                </div>
            </form>
            <div class="login-popup-footer">
                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleMobileMenu() {
        // Mobile menu toggle functionality can be added here
        alert('Mobile menu functionality to be implemented');
    }

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

    function showLoginPopup() {
        document.getElementById('loginPopup').style.display = 'flex';
    }

    function hideLoginPopup() {
        document.getElementById('loginPopup').style.display = 'none';
    }

    // Close popup when clicking outside
    document.getElementById('loginPopup').addEventListener('click', function(e) {
        if (e.target === this) {
            hideLoginPopup();
        }
    });
</script>

<div class="location-container">
    <div class="location-header">
        <h1 class="location-title">Lokasi Strategis</h1>
        <p class="location-subtitle">Lagita Kost berada di lokasi yang sangat strategis dan mudah diakses</p>
    </div>

    <div class="location-content">
        <!-- Map Section -->
        <div class="map-section">
            <div class="map-container">
                <div class="map-icon">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#1a1a1a" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <div class="map-text">
                    <div class="map-label">Peta Interaktif</div>
                    <div class="map-address">
                    Jl. Bangau Sakti, Kec. Tampan<br>
                    Pekanbaru, Riau 28292
                    </div>
                </div>
            </div>

            <div class="map-buttons">
                <a href="https://maps.google.com/?q=Lagita+Kost+Pekanbaru" target="_blank" class="map-btn primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                    Buka di Google Maps
                </a>
                <a href="#" class="map-btn secondary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    Lihat Arah
                </a>
            </div>

            <!-- Transport Section -->
            <div style="margin-top: 30px;">
                <h3 class="section-title">Akses Transportasi</h3>
                <div class="transport-list">
                    <div class="transport-item">
                        <div class="transport-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1a1a1a" stroke-width="2">
                                <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                                <rect x="9" y="9" width="6" height="6"></rect>
                                <line x1="9" y1="1" x2="9" y2="4"></line>
                                <line x1="15" y1="1" x2="15" y2="4"></line>
                                <line x1="9" y1="20" x2="9" y2="23"></line>
                                <line x1="15" y1="20" x2="15" y2="23"></line>
                                <line x1="20" y1="9" x2="23" y2="9"></line>
                                <line x1="20" y1="14" x2="23" y2="14"></line>
                                <line x1="1" y1="9" x2="4" y2="9"></line>
                                <line x1="1" y1="14" x2="4" y2="14"></line>
                            </svg>
                        </div>
                        <div class="transport-info">
                            <div class="transport-name">Trans Metro Pekanbaru</div>
                            <div class="transport-detail">Koridor 1, 6, dan 13</div>
                        </div>
                        <div class="transport-distance">5 menit jalan kaki</div>
                    </div>

                    <div class="transport-item">
                        <div class="transport-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1a1a1a" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div class="transport-info">
                            <div class="transport-name">Angkutan Online</div>
                            <div class="transport-detail">Gojek, Grab selalu tersedia</div>
                        </div>
                        <div class="transport-distance">Pickup cepat</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nearby Places Section -->
        <div class="info-section">
            <div class="section-card">
                <h3 class="section-title">Tempat Terdekat</h3>
                <div class="nearby-list">
                    <div class="nearby-item">
                        <div class="nearby-icon blue">🎓</div>
                        <div class="nearby-info">
                            <div class="nearby-name">Universitas Riau</div>
                            <div class="nearby-category">Kampus</div>
                        </div>
                        <div class="nearby-time">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            8 menit
                        </div>
                    </div>

                    <div class="nearby-item">
                        <div class="nearby-icon green">🚌</div>
                        <div class="nearby-info">
                            <div class="nearby-name">Terminal AKAP Pekanbaru</div>
                            <div class="nearby-category">Transportasi</div>
                        </div>
                        <div class="nearby-time">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            12 menit
                        </div>
                    </div>

                    <div class="nearby-item">
                        <div class="nearby-icon yellow">🛍️</div>
                        <div class="nearby-info">
                            <div class="nearby-name">MTC Mall Panam Pekanbaru</div>
                            <div class="nearby-category">Shopping</div>
                        </div>
                        <div class="nearby-time">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            6 menit
                        </div>
                    </div>

                    <div class="nearby-item">
                        <div class="nearby-icon pink">🏥</div>
                        <div class="nearby-info">
                            <div class="nearby-name">RSP Universitas Riau</div>
                            <div class="nearby-category">Kesehatan</div>
                        </div>
                        <div class="nearby-time">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            7 menit
                        </div>
                    </div>

                    <div class="nearby-item">
                        <div class="nearby-icon orange">☕</div>
                        <div class="nearby-info">
                            <div class="nearby-name">Samara Coffe & Space</div>
                            <div class="nearby-category">F&B</div>
                        </div>
                        <div class="nearby-time">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            2 menit
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advantages Section -->
    <div class="advantages-card">
        <h3 class="section-title">Keunggulan Lokasi</h3>
        <div class="advantages-list">
            <div class="advantage-item">
                <div class="advantage-bullet"></div>
                <div class="advantage-text">Bebas banjir dan akses jalan utama</div>
            </div>
            <div class="advantage-item">
                <div class="advantage-bullet"></div>
                <div class="advantage-text">Dekat dengan pusat pendidikan dan perbelanjaan</div>
            </div>
            <div class="advantage-item">
                <div class="advantage-bullet"></div>
                <div class="advantage-text">Transportasi umum 24 jam</div>
            </div>
            <div class="advantage-item">
                <div class="advantage-bullet"></div>
                <div class="advantage-text">Lingkungan aman dan bersih</div>
            </div>
        </div>
    </div>
</div>

@endsection