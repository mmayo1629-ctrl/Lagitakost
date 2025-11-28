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
    .mobile-logout-btn {
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

    /* Financial Report Styles */
    .report-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 80px;
    }

    .report-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .report-title {
        font-size: 36px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .report-subtitle {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .stat-card {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        text-align: center;
        transition: transform 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 24px;
    }

    .stat-number {
        font-size: 42px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 16px;
        color: #666;
        font-weight: 500;
    }

    .chart-container {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        margin-bottom: 30px;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .chart-title {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .chart-subtitle {
        font-size: 14px;
        color: #666;
        margin: 5px 0 0 0;
    }

    .chart-placeholder {
        height: 300px;
        background: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        font-size: 16px;
    }

    .details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .details-card {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .details-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 20px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-size: 15px;
        color: #333;
        font-weight: 500;
    }

    .detail-value {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
    }

    .back-btn {
        background: #f8f9fa;
        color: #1a1a1a;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 30px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .back-btn:hover {
        background: #e9ecef;
        transform: translateY(-1px);
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

        .navbar-actions {
            display: none;
        }

        .report-container {
            padding: 25px 20px;
        }

        .report-header {
            margin-bottom: 30px;
        }

        .report-title {
            font-size: 28px;
        }

        .report-subtitle {
            font-size: 16px;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .stat-card {
            padding: 20px;
        }

        .stat-number {
            font-size: 32px;
        }

        .stat-label {
            font-size: 14px;
        }

        .details-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .details-card {
            padding: 20px;
        }

        .details-title {
            font-size: 18px;
        }

        .detail-item {
            padding: 12px 0;
        }

        .detail-label {
            font-size: 14px;
        }

        .detail-value {
            font-size: 15px;
        }

        .back-btn {
            margin-bottom: 20px;
        }
    }

    @media (max-width: 768px) {
        .report-container {
            padding: 20px 15px;
        }

        .report-header {
            margin-bottom: 30px;
        }

        .report-title {
            font-size: 28px;
        }

        .report-subtitle {
            font-size: 14px;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            padding: 20px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 32px;
        }

        .stat-label {
            font-size: 14px;
        }

        .chart-container {
            padding: 20px;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 18px;
        }

        .chart-subtitle {
            font-size: 13px;
        }

        .chart-placeholder {
            height: 250px;
        }

        .details-card {
            padding: 20px;
        }

        .details-title {
            font-size: 18px;
        }

        .detail-item {
            padding: 12px 0;
        }

        .detail-label {
            font-size: 14px;
        }

        .detail-value {
            font-size: 15px;
        }

        .back-btn {
            padding: 10px 20px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .custom-navbar {
            padding: 12px 15px;
        }

        .brand-name {
            font-size: 16px;
        }

        .brand-tagline {
            font-size: 11px;
        }

        .navbar-actions {
            gap: 10px;
        }

        .contact-button {
            padding: 8px 16px;
            font-size: 13px;
        }

        .logout-btn {
            padding: 8px 16px;
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .report-container {
            padding: 15px 10px;
        }

        .report-header {
            margin-bottom: 25px;
        }

        .report-title {
            font-size: 24px;
        }

        .report-subtitle {
            font-size: 13px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card {
            padding: 15px;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .stat-number {
            font-size: 28px;
        }

        .stat-label {
            font-size: 13px;
        }

        .chart-container {
            padding: 15px;
            margin-bottom: 15px;
        }

        .chart-title {
            font-size: 16px;
        }

        .chart-subtitle {
            font-size: 12px;
        }

        .chart-placeholder {
            height: 200px;
            font-size: 14px;
        }

        .details-grid {
            gap: 20px;
        }

        .details-card {
            padding: 15px;
        }

        .details-title {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .detail-item {
            padding: 10px 0;
        }

        .detail-label {
            font-size: 13px;
        }

        .detail-value {
            font-size: 14px;
        }

        .back-btn {
            padding: 8px 16px;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .custom-navbar {
            padding: 10px 12px;
        }

        .brand-logo {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }

        .brand-name {
            font-size: 14px;
        }

        .brand-tagline {
            font-size: 10px;
        }

        .navbar-actions {
            gap: 8px;
        }

        .contact-button {
            padding: 6px 12px;
            font-size: 12px;
        }

        .logout-btn {
            padding: 6px 12px;
            font-size: 12px;
        }

        .logout-popup {
            width: 95%;
        }

        .logout-popup-header {
            padding: 15px 20px;
        }

        .logout-popup-title {
            font-size: 16px;
        }

        .logout-popup-body {
            padding: 20px 15px;
        }

        .logout-popup-message {
            font-size: 15px;
        }

        .logout-popup-submessage {
            font-size: 13px;
        }

        .logout-popup-actions {
            padding: 15px 20px 20px;
            flex-direction: column;
            gap: 10px;
        }

        .logout-popup-btn {
            width: 100%;
            padding: 10px;
            font-size: 14px;
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
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
</style>

<!-- Custom Navbar -->
<nav class="custom-navbar">
    <a href="/" class="navbar-brand-custom">
        <div class="brand-logo">LK</div>
        <div class="brand-text">
            <span class="brand-name">Lagita Kost</span>
            <span class="brand-tagline">Financial Report</span>
        </div>
    </a>

    <ul class="navbar-menu">
        <li><a href="{{ route('rooms') }}">Kamar</a></li>
        <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
        <li><a href="#lokasi">Lokasi</a></li>
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
            Hubungi Admin
        </a>
        <button type="button" class="logout-btn" onclick="showLogoutPopup()">Logout</button>
    </div>

    <button class="mobile-menu-toggle">☰</button>
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
                <div class="brand-tagline">Financial Report</div>
            </div>
        </div>
        <button class="mobile-menu-close" onclick="closeMobileMenu()">×</button>
    </div>

    <ul class="mobile-menu-nav">
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('rooms.index') }}">Kelola Kamar</a></li>
        <li><a href="{{ route('tenants.index') }}">Kelola Penghuni</a></li>
        <li><a href="{{ route('bookings.index') }}">Booking</a></li>
        <li><a href="{{ route('financial-report') }}">Laporan Keuangan</a></li>
        <li><a href="{{ route('activities.index') }}">Aktivitas</a></li>
    </ul>

    <div class="mobile-menu-actions">
        <a href="tel:+6287761001778" class="mobile-contact-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            Hubungi Admin
        </a>
        <button type="button" class="mobile-logout-btn" onclick="showLogoutPopup()">Logout</button>
    </div>
</div>

<div class="report-container">
    <a href="{{ route('dashboard') }}" class="back-btn">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5"></path>
            <path d="M12 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Dashboard
    </a>

    <div class="report-header">
        <h1 class="report-title">Laporan Keuangan</h1>
        <p class="report-subtitle">
            Ringkasan pendapatan dan performa keuangan kost bulan ini
        </p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
            </div>
            <div class="stat-number">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="stat-label">Total Pendapatan Bulan Ini</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
            </div>
            <div class="stat-number">{{ $monthlyBookings }}</div>
            <div class="stat-label">Booking Dikonfirmasi</div>
        </div>



        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14,2 14,8 20,8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10,9 9,9 8,9"></polyline>
                </svg>
            </div>
            <div class="stat-number">Rp {{ number_format($averageRevenuePerBooking, 0, ',', '.') }}</div>
            <div class="stat-label">Rata-rata Pendapatan per Booking</div>
        </div>
    </div>



    <!-- Details Grid -->
    <div class="details-grid">
        <!-- Monthly Breakdown -->
        <div class="details-card">
            <h3 class="details-title">Rincian Bulanan</h3>
            @foreach($monthlyRevenue as $month)
            <div class="detail-item">
                <span class="detail-label">{{ $month['month'] }}</span>
                <span class="detail-value">Rp {{ number_format($month['revenue'], 0, ',', '.') }}</span>
            </div>
            @endforeach
        </div>

        <!-- Summary -->
        <div class="details-card">
            <h3 class="details-title">Ringkasan</h3>
            <div class="detail-item">
                <span class="detail-label">Total Booking Bulan Ini</span>
                <span class="detail-value">{{ $monthlyBookings }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Rata-rata Pendapatan per Booking</span>
                <span class="detail-value">Rp {{ number_format($averageRevenuePerBooking, 0, ',', '.') }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Total Pendapatan</span>
                <span class="detail-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- LOGOUT POPUP -->
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

<script>
    // Logout popup functions
    function showLogoutPopup() {
        document.getElementById('logoutPopup').style.display = 'flex';
    }

    function hideLogoutPopup() {
        document.getElementById('logoutPopup').style.display = 'none';
    }

    // Logout popup event listener for clicking outside
    document.getElementById('logoutPopup').addEventListener('click', function(e) {
        if (e.target === this) {
            hideLogoutPopup();
        }
    });
</script>

@endsection
