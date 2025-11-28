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
        padding: 8px;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .mobile-menu-toggle:hover {
        background-color: #f0f0f0;
    }

    /* Mobile Menu Overlay */
    .mobile-menu-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        backdrop-filter: blur(2px);
    }

    .mobile-menu {
        position: fixed;
        top: 0;
        right: -300px;
        width: 280px;
        height: 100%;
        background: white;
        box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
        transition: right 0.3s ease;
        z-index: 1000;
        padding: 20px;
        overflow-y: auto;
    }

    .mobile-menu.active {
        right: 0;
    }

    .mobile-menu-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }

    .mobile-menu-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #666;
        padding: 5px;
    }

    .mobile-menu-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mobile-menu-nav li {
        margin-bottom: 10px;
    }

    .mobile-menu-nav a {
        display: block;
        padding: 12px 15px;
        color: #333;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        border-radius: 8px;
        transition: all 0.3s;
    }

    .mobile-menu-nav a:hover {
        background: #f8f9fa;
        color: #1a1a1a;
    }

    .mobile-menu-actions {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .mobile-contact-btn,
    .mobile-logout-btn,
    .mobile-login-btn,
    .mobile-register-btn {
        width: 100%;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        text-decoration: none;
    }

    .mobile-contact-btn {
        background: #1a1a1a;
        color: white;
        border: none;
    }

    .mobile-contact-btn:hover {
        background: #333;
    }

    .mobile-logout-btn {
        background: #000;
        color: white;
        border: none;
    }

    .mobile-logout-btn:hover {
        background: #333;
    }

    .mobile-login-btn,
    .mobile-register-btn {
        background: #1a1a1a;
        color: white;
        border: none;
    }

    .mobile-login-btn:hover,
    .mobile-register-btn:hover {
        background: #333;
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

    .facilities-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 60px 80px;
    }

    .facilities-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .facilities-title {
        font-size: 36px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .facilities-subtitle {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Facilities Grid */
    .facilities-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        margin-bottom: 50px;
    }

    .facility-card {
        background: white;
        border-radius: 16px;
        padding: 35px 30px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        cursor: pointer;
    }

    .facility-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .facility-card.has-image {
        padding: 0;
        overflow: hidden;
    }

    .facility-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .facility-content {
        padding: 30px;
    }

    .facility-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        background: #f0f0f0;
    }

    .facility-icon svg {
        width: 28px;
        height: 28px;
    }

    .facility-name {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 12px;
    }

    .facility-description {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }

    /* Additional Facilities Section */
    .additional-facilities {
        margin-top: 60px;
    }

    .section-title {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 40px;
        text-align: center;
    }

    .additional-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .additional-card {
        background: white;
        border-radius: 16px;
        padding: 35px 30px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        text-align: center;
        transition: all 0.3s;
    }

    .additional-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .additional-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .additional-icon.green { background: #d1fae5; }
    .additional-icon.blue { background: #dbeafe; }
    .additional-icon.purple { background: #ede9fe; }

    .additional-icon svg {
        width: 32px;
        height: 32px;
    }

    .additional-name {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 12px;
    }

    .additional-description {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }

    @media (max-width: 1200px) {
        .facilities-container {
            padding: 50px 60px;
        }

        .facilities-grid,
        .additional-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .facility-card,
        .additional-card {
            padding: 30px 25px;
        }
    }

    @media (max-width: 1024px) {
        .facilities-container {
            padding: 45px 50px;
        }

        .facilities-grid,
        .additional-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .facility-card,
        .additional-card {
            padding: 28px 22px;
        }

        .facility-name,
        .additional-name {
            font-size: 18px;
        }

        .facility-description,
        .additional-description {
            font-size: 13px;
        }
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

        .facilities-container {
            padding: 40px 30px;
        }

        .facilities-header {
            margin-bottom: 50px;
        }

        .facilities-title {
            font-size: 32px;
        }

        .facilities-subtitle {
            font-size: 15px;
            max-width: 500px;
        }

        .facilities-grid,
        .additional-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .facility-card,
        .additional-card {
            padding: 25px 20px;
        }

        .facility-image {
            height: 180px;
        }

        .facility-content {
            padding: 25px;
        }

        .facility-name,
        .additional-name {
            font-size: 17px;
        }

        .facility-description,
        .additional-description {
            font-size: 13px;
        }

        .additional-facilities {
            margin-top: 50px;
        }

        .section-title {
            font-size: 26px;
            margin-bottom: 35px;
        }
    }

    @media (max-width: 768px) {
        .custom-navbar {
            padding: 12px 20px;
        }

        .brand-name {
            font-size: 16px;
        }

        .brand-tagline {
            font-size: 11px;
        }

        .facilities-container {
            padding: 30px 20px;
        }

        .facilities-header {
            margin-bottom: 40px;
        }

        .facilities-title {
            font-size: 28px;
        }

        .facilities-subtitle {
            font-size: 14px;
            max-width: 100%;
        }

        .facilities-grid,
        .additional-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .facility-card,
        .additional-card {
            padding: 20px 18px;
        }

        .facility-image {
            height: 160px;
        }

        .facility-content {
            padding: 20px;
        }

        .facility-name,
        .additional-name {
            font-size: 16px;
        }

        .facility-description,
        .additional-description {
            font-size: 12px;
        }

        .additional-facilities {
            margin-top: 40px;
        }

        .section-title {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .additional-icon {
            width: 60px;
            height: 60px;
        }

        .additional-icon svg {
            width: 28px;
            height: 28px;
        }
    }

    @media (max-width: 640px) {
        .custom-navbar {
            padding: 10px 15px;
        }

        .brand-logo {
            width: 38px;
            height: 38px;
            font-size: 14px;
        }

        .brand-name {
            font-size: 15px;
        }

        .brand-tagline {
            font-size: 10px;
        }

        .facilities-container {
            padding: 25px 15px;
        }

        .facilities-header {
            margin-bottom: 35px;
        }

        .facilities-title {
            font-size: 26px;
        }

        .facilities-subtitle {
            font-size: 13px;
        }

        .facility-card,
        .additional-card {
            padding: 18px 16px;
        }

        .facility-image {
            height: 140px;
        }

        .facility-content {
            padding: 18px;
        }

        .facility-name,
        .additional-name {
            font-size: 15px;
        }

        .facility-description,
        .additional-description {
            font-size: 11px;
        }

        .section-title {
            font-size: 22px;
            margin-bottom: 25px;
        }

        .additional-icon {
            width: 55px;
            height: 55px;
        }

        .additional-icon svg {
            width: 25px;
            height: 25px;
        }
    }

    @media (max-width: 480px) {
        .custom-navbar {
            padding: 8px 12px;
        }

        .brand-logo {
            width: 35px;
            height: 35px;
            font-size: 12px;
        }

        .brand-name {
            font-size: 14px;
        }

        .brand-tagline {
            font-size: 9px;
        }

        .facilities-container {
            padding: 20px 12px;
        }

        .facilities-header {
            margin-bottom: 30px;
        }

        .facilities-title {
            font-size: 24px;
        }

        .facilities-subtitle {
            font-size: 12px;
        }

        .facility-card,
        .additional-card {
            padding: 16px 14px;
        }

        .facility-image {
            height: 120px;
        }

        .facility-content {
            padding: 16px;
        }

        .facility-name,
        .additional-name {
            font-size: 14px;
        }

        .facility-description,
        .additional-description {
            font-size: 10px;
        }

        .additional-facilities {
            margin-top: 35px;
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .additional-icon {
            width: 50px;
            height: 50px;
        }

        .additional-icon svg {
            width: 22px;
            height: 22px;
        }
    }

    @media (max-width: 360px) {
        .custom-navbar {
            padding: 6px 10px;
        }

        .brand-logo {
            width: 32px;
            height: 32px;
            font-size: 10px;
        }

        .brand-name {
            font-size: 12px;
        }

        .brand-tagline {
            font-size: 8px;
        }

        .facilities-container {
            padding: 15px 10px;
        }

        .facilities-header {
            margin-bottom: 25px;
        }

        .facilities-title {
            font-size: 20px;
        }

        .facilities-subtitle {
            font-size: 11px;
        }

        .facility-card,
        .additional-card {
            padding: 14px 12px;
        }

        .facility-image {
            height: 100px;
        }

        .facility-content {
            padding: 14px;
        }

        .facility-name,
        .additional-name {
            font-size: 13px;
        }

        .facility-description,
        .additional-description {
            font-size: 9px;
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .additional-icon {
            width: 45px;
            height: 45px;
        }

        .additional-icon svg {
            width: 20px;
            height: 20px;
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

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay" onclick="closeMobileMenu()"></div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <div class="navbar-brand-custom">
                <div class="brand-logo">LK</div>
                <div class="brand-text">
                    <div class="brand-name">Lagita Kost</div>
                    <div class="brand-tagline">Kost Modern & Nyaman</div>
                </div>
            </div>
            <button class="mobile-menu-close" onclick="closeMobileMenu()">×</button>
        </div>

        <ul class="mobile-menu-nav">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('rooms') }}">Kamar</a></li>
            <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
            <li><a href="{{ route('location') }}">Lokasi</a></li>
            <li><a href="{{ route('contact') }}">Kontak</a></li>
        </ul>

        <div class="mobile-menu-actions">
            @if(Auth::check())
                <a href="tel:+6287761001778" class="mobile-contact-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    Hubungi Admin
                </a>
                <button type="button" class="mobile-logout-btn" onclick="showLogoutPopup()">Logout</button>
            @else
                <a href="tel:+6287761001778" class="mobile-contact-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    Hubungi Admin
                </a>
                <a href="{{ route('login') }}" class="mobile-login-btn">Login</a>
                <a href="{{ route('register') }}" class="mobile-register-btn">Daftar</a>
            @endif
        </div>
    </div>
@endif

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('mobileMenuOverlay');
        const body = document.body;

        if (menu.classList.contains('active')) {
            closeMobileMenu();
        } else {
            menu.classList.add('active');
            overlay.style.display = 'block';
            body.style.overflow = 'hidden';
        }
    }

    function closeMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('mobileMenuOverlay');
        const body = document.body;

        menu.classList.remove('active');
        overlay.style.display = 'none';
        body.style.overflow = 'auto';
    }

    // Close mobile menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMobileMenu();
        }
    });

    // Close mobile menu when clicking on a menu item
    document.querySelectorAll('.mobile-menu-nav a').forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });
</script>

<div class="facilities-container">
    <!-- Header -->
    <div class="facilities-header">
        <h1 class="facilities-title">Fasilitas Lengkap</h1>
        <p class="facilities-subtitle">
            Nikmati berbagai fasilitas modern dan nyaman yang mendukung aktivitas harian Anda
        </p>
    </div>

    <!-- Main Facilities Grid -->
    <div class="facilities-grid">
        <!-- WiFi Unlimited -->
        <div class="facility-card has-image">
            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop" alt="WiFi Unlimited" class="facility-image">
            <div class="facility-content">
                <h3 class="facility-name">Internet WiFi Unlimited</h3>
                <p class="facility-description">
                    WiFi berkecepatan tinggi 24/7 di seluruh area kost
                </p>
            </div>
        </div>

        <!-- Keamanan 24 Jam -->
        <div class="facility-card has-image">
            <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?w=600&h=400&fit=crop" alt="Keamanan 24 Jam" class="facility-image">
            <div class="facility-content">
                <h3 class="facility-name">Keamanan 24 Jam</h3>
                <p class="facility-description">
                    Security dan CCTV untuk keamanan maksimal penghuni
                </p>
            </div>
        </div>

        <!-- Parkir Gratis -->
        <div class="facility-card has-image">
            <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=600&h=400&fit=crop" alt="Parkir Gratis" class="facility-image">
            <div class="facility-content">
                <h3 class="facility-name">Parkir Gratis</h3>
                <p class="facility-description">
                    Area parkir motor dan mobil yang aman dan luas
                </p>
            </div>
        </div>

        <!-- Dapur Bersama (with image) -->
        <div class="facility-card has-image">
            <img src="https://images.unsplash.com/photo-1556912167-f556f1f39fdf?w=600&h=400&fit=crop" alt="Dapur Bersama" class="facility-image">
            <div class="facility-content">
                <h3 class="facility-name">Dapur Bersama</h3>
                <p class="facility-description">
                    Dapur lengkap dengan peralatan memasak modern
                </p>
            </div>
        </div>

        <!-- Laundry (with image) -->
        <div class="facility-card has-image">
            <img src="https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?w=600&h=400&fit=crop" alt="Laundry" class="facility-image">
            <div class="facility-content">
                <h3 class="facility-name">Laundry</h3>
                <p class="facility-description">
                    Mesin cuci dan pengering gratis untuk semua penghuni
                </p>
            </div>
        </div>

        <!-- Area Komunal -->
        <div class="facility-card has-image">
            <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=600&h=400&fit=crop" alt="Area Komunal" class="facility-image">
            <div class="facility-content">
                <h3 class="facility-name">Area Komunal</h3>
                <p class="facility-description">
                    Ruang santai dan co-working space yang nyaman
                </p>
            </div>
        </div>

        <!-- Listrik Stabil -->
        <div class="facility-card has-image">
            <img src="https://images.unsplash.com/photo-1621905252472-943afaa20e20?w=600&h=400&fit=crop" alt="Listrik Stabil" class="facility-image">
            <div class="facility-content">
                <h3 class="facility-name">Listrik Stabil</h3>
                <p class="facility-description">
                    Suplai listrik PLN 24 jam dengan backup generator
                </p>
            </div>
        </div>

        <!-- Dekat Pusat Belanja -->
        <div class="facility-card has-image">
            <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=600&h=400&fit=crop" alt="Dekat Pusat Belanja" class="facility-image">
            <div class="facility-content">
                <h3 class="facility-name">Dekat Pusat Belanja</h3>
                <p class="facility-description">
                    Mall, minimarket, dan restoran dalam jangkauan 5 menit
                </p>
            </div>
        </div>
    </div>

    <!-- Additional Facilities -->
    <div class="additional-facilities">
        <h2 class="section-title">Keunggulan Lainnya</h2>
        <div class="additional-grid">
            <!-- Keamanan Terjamin -->
            <div class="additional-card">
                <div class="additional-icon green">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <path d="M9 12l2 2 4-4"></path>
                    </svg>
                </div>
                <h3 class="additional-name">Keamanan Terjamin</h3>
                <p class="additional-description">
                    CCTV 24/7, akses kartu, dan security yang ramah
                </p>
            </div>

            <!-- Utilitas Lengkap -->
            <div class="additional-card">
                <div class="additional-icon blue">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                    </svg>
                </div>
                <h3 class="additional-name">Utilitas Lengkap</h3>
                <p class="additional-description">
                    Listrik, air, internet sudah termasuk dalam harga sewa
                </p>
            </div>

            <!-- Komunitas Aktif -->
            <div class="additional-card">
                <div class="additional-icon purple">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3 class="additional-name">Komunitas Aktif</h3>
                <p class="additional-description">
                    Lingkungan yang ramah dengan berbagai kegiatan bersama
                </p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div style="text-align: center; margin-top: 60px;">
        <a href="{{ route('rooms') }}" style="display: inline-flex; align-items: center; gap: 10px; background: #1a1a1a; color: white; padding: 16px 40px; border-radius: 10px; font-size: 16px; font-weight: 600; text-decoration: none; transition: all 0.3s;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            Lihat Kamar Tersedia
        </a>
    </div>
</div>

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
            <div class="logout-popup-submessage">Anda akan diarahkan ke halaman login setelah logout.</div>
        </div>
        <div class="logout-popup-actions">
            <button class="logout-popup-btn logout-popup-btn-cancel" onclick="hideLogoutPopup()">Batal</button>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-popup-btn logout-popup-btn-logout">Ya, Keluar</button>
            </form>
        </div>
    </div>
</div>

<style>
    .logout-popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.6);
        backdrop-filter: blur(5px);
        z-index: 2000;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.3s ease-out;
    }

    .logout-popup {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.25);
        max-width: 400px;
        width: 90%;
        animation: popupSlideIn 0.35s ease-out;
    }

    .logout-popup-header {
        background: #000;
        color: white;
        text-align: center;
        padding: 18px;
        border-radius: 12px 12px 0 0;
    }

    .logout-popup-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    .logout-popup-body {
        padding: 30px 25px;
        text-align: center;
    }

    .logout-popup-icon {
        font-size: 40px;
        color: #dc3545;
        margin-bottom: 15px;
        animation: pulse 1.8s infinite;
    }

    .logout-popup-message {
        font-size: 16px;
        color: #222;
        margin-bottom: 8px;
    }

    .logout-popup-submessage {
        font-size: 14px;
        color: #777;
    }

    .logout-popup-actions {
        display: flex;
        justify-content: center;
        gap: 15px;
        padding: 25px 0 30px;
    }

    .logout-popup-btn {
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        padding: 12px 28px;
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .logout-popup-btn-cancel {
        background: white;
        border-color: #6c757d;
        color: #6c757d;
    }

    .logout-popup-btn-cancel:hover {
        background: #6c757d;
        color: white;
    }

    .logout-popup-btn-logout {
        background: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .logout-popup-btn-logout:hover {
        background: #b02a37;
        border-color: #b02a37;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes popupSlideIn {
        0% { opacity: 0; transform: scale(0.7) translateY(-40px); }
        100% { opacity: 1; transform: scale(1) translateY(0); }
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
</style>

<script>
    // Show & Hide Logout Popup
    function showLogoutPopup() {
        document.getElementById('logoutPopup').style.display = 'flex';
    }

    function hideLogoutPopup() {
        document.getElementById('logoutPopup').style.display = 'none';
    }

    // Close popup if user clicks outside
    window.onclick = function(event) {
        const popup = document.getElementById('logoutPopup');
        if (event.target === popup) {
            hideLogoutPopup();
        }
    }
</script>

@endsection
