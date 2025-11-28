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

    .mobile-logout-btn {
        width: 100%;
        background: #000;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .mobile-logout-btn:hover {
        background: #333;
    }

    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 80px;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .dashboard-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .dashboard-subtitle {
        font-size: 16px;
        color: #666;
        margin: 5px 0 0 0;
    }

    .back-btn {
        background: white;
        color: #1a1a1a;
        border: 2px solid #e0e0e0;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .back-btn:hover {
        background: #f8f9fa;
        border-color: #1a1a1a;
    }

    .dashboard-content {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .dashboard-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .card-header {
        background: #f8f9fa;
        padding: 20px 30px;
        border-bottom: 1px solid #e0e0e0;
    }

    .card-title {
        font-size: 20px;
        font-weight: 600;
        color: #1a1a1a;
        margin: 0;
    }

    .card-body {
        padding: 30px;
    }

    .booking-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .booking-item:last-child {
        border-bottom: none;
    }

    .booking-info {
        flex: 1;
    }

    .booking-room {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 5px;
    }

    .booking-dates {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
    }

    .booking-price {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .booking-status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-confirmed {
        background: #d1ecf1;
        color: #0c5460;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .booking-actions {
        display: flex;
        gap: 10px;
    }

    .mark-read-btn {
        background: #28a745;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .mark-read-btn:hover {
        background: #218838;
    }

    .no-bookings {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .no-bookings-icon {
        font-size: 48px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .no-bookings-title {
        font-size: 24px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .no-bookings-text {
        font-size: 16px;
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

        .navbar-actions .logout-btn {
            display: none;
        }

        .dashboard-container {
            padding: 25px 20px;
        }

        .dashboard-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .dashboard-title {
            font-size: 28px;
        }

        .dashboard-subtitle {
            font-size: 16px;
        }

        .booking-item {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .booking-actions {
            width: 100%;
            justify-content: flex-end;
        }
    }

    @media (max-width: 768px) {
        .custom-navbar {
            padding: 12px 15px;
        }

        .brand-name {
            font-size: 16px;
        }

        .brand-tagline {
            font-size: 11px;
        }

        .dashboard-container {
            padding: 20px 15px;
        }

        .dashboard-header {
            gap: 15px;
        }

        .dashboard-title {
            font-size: 26px;
        }

        .dashboard-subtitle {
            font-size: 15px;
        }

        .back-btn {
            padding: 10px 20px;
            font-size: 14px;
        }

        .card-header {
            padding: 18px 20px;
        }

        .card-title {
            font-size: 18px;
        }

        .card-body {
            padding: 20px;
        }

        .booking-item {
            padding: 15px 0;
        }

        .booking-room {
            font-size: 16px;
        }

        .booking-dates {
            font-size: 13px;
        }

        .booking-price {
            font-size: 15px;
        }

        .booking-status {
            font-size: 11px;
            padding: 3px 10px;
        }

        .mark-read-btn {
            padding: 6px 12px;
            font-size: 11px;
        }

        .no-bookings {
            padding: 40px 15px;
        }

        .no-bookings-title {
            font-size: 20px;
        }

        .no-bookings-text {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .dashboard-container {
            padding: 15px 10px;
        }

        .dashboard-header {
            gap: 15px;
        }

        .dashboard-title {
            font-size: 28px;
        }

        .dashboard-subtitle {
            font-size: 14px;
        }

        .back-btn {
            padding: 10px 20px;
            font-size: 13px;
        }

        .card-header {
            padding: 15px 20px;
        }

        .card-title {
            font-size: 18px;
        }

        .card-body {
            padding: 20px 15px;
        }

        .booking-item {
            padding: 15px 0;
        }

        .booking-room {
            font-size: 16px;
        }

        .booking-dates {
            font-size: 13px;
        }

        .booking-price {
            font-size: 15px;
        }

        .booking-status {
            font-size: 11px;
            padding: 3px 10px;
        }

        .mark-read-btn {
            padding: 6px 12px;
            font-size: 11px;
        }

        .no-bookings {
            padding: 40px 15px;
        }

        .no-bookings-title {
            font-size: 20px;
        }

        .no-bookings-text {
            font-size: 14px;
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

        .navbar-menu {
            gap: 25px;
        }

        .navbar-menu a {
            font-size: 14px;
        }

        .logout-btn {
            padding: 8px 16px;
            font-size: 13px;
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
</style>

<!-- Custom Navbar -->
<nav class="custom-navbar">
    <a href="/" class="navbar-brand-custom">
        <div class="brand-logo">LK</div>
        <div class="brand-text">
            <span class="brand-name">Lagita Kost</span>
            <span class="brand-tagline">Customer Dashboard</span>
        </div>
    </a>

    <ul class="navbar-menu">
        <li><a href="{{ route('rooms') }}">Kamar</a></li>
        <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
        <li><a href="{{ route('location') }}">Lokasi</a></li>
        <li><a href="{{ route('contact') }}">Kontak</a></li>
    </ul>

    <div class="navbar-actions">
        <button type="button" class="logout-btn" onclick="showLogoutPopup()">Logout</button>
    </div>

    <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">☰</button>
</nav>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay" onclick="closeMobileMenu()"></div>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-header">
        <div class="navbar-brand-custom">
            <div class="brand-logo">LK</div>
            <div class="brand-text">
                <span class="brand-name">Lagita Kost</span>
                <span class="brand-tagline">Customer Dashboard</span>
            </div>
        </div>
        <button class="mobile-menu-close" onclick="closeMobileMenu()">×</button>
    </div>

    <nav class="mobile-menu-nav">
        <li><a href="{{ route('rooms') }}">Kamar</a></li>
        <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
        <li><a href="{{ route('location') }}">Lokasi</a></li>
        <li><a href="{{ route('contact') }}">Kontak</a></li>
    </nav>

    <div class="mobile-menu-actions">
        <button type="button" class="mobile-logout-btn" onclick="showLogoutPopup(); closeMobileMenu();">Logout</button>
    </div>
</div>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div>
            <h1 class="dashboard-title">Dashboard Customer</h1>
            <p class="dashboard-subtitle">Kelola booking dan lihat status kamar Anda</p>
        </div>
        <a href="{{ route('home') }}" class="back-btn">← Kembali ke Home</a>
    </div>

    <div class="dashboard-content">
        <div class="dashboard-card">
            <div class="card-header">
                <h2 class="card-title">Riwayat Booking</h2>
            </div>
            <div class="card-body">
                @if($bookings->count() > 0)
                    @foreach($bookings as $booking)
                    <div class="booking-item">
                        <div class="booking-info">
                            <div class="booking-room">{{ $booking->room_type }}</div>
                            <div class="booking-dates">
                                Check-in: {{ $booking->check_in_date->format('d/m/Y') }} -
                                Check-out: {{ $booking->check_out_date->format('d/m/Y') }}
                            </div>
                            <div class="booking-price">
                                Total: Rp {{ number_format($booking->price, 0, ',', '.') }}
                            </div>
                            <span class="booking-status status-{{ $booking->status }}">
                                @switch($booking->status)
                                    @case('pending')
                                        Menunggu Konfirmasi
                                        @break
                                    @case('confirmed')
                                        Dikonfirmasi
                                        @break
                                    @case('cancelled')
                                        Dibatalkan
                                        @break
                                @endswitch
                            </span>
                        </div>
                        <div class="booking-actions">
                            @if(in_array($booking->status, ['confirmed', 'cancelled']) && !$booking->notification_read)
                            <form method="POST" action="{{ route('booking.mark-notification-read', $booking) }}" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="mark-read-btn">Tandai Dibaca</button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="no-bookings">
                    <div class="no-bookings-icon">📅</div>
                    <div class="no-bookings-title">Belum ada booking</div>
                    <div class="no-bookings-text">Anda belum melakukan booking kamar. Mulai booking sekarang!</div>
                </div>
                @endif
            </div>
        </div>
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
</style>

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

// Mobile Menu Functions
function toggleMobileMenu() {
    const overlay = document.getElementById('mobileMenuOverlay');
    const menu = document.getElementById('mobileMenu');

    if (menu.classList.contains('active')) {
        closeMobileMenu();
    } else {
        overlay.style.display = 'block';
        menu.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
}

function closeMobileMenu() {
    const overlay = document.getElementById('mobileMenuOverlay');
    const menu = document.getElementById('mobileMenu');

    overlay.style.display = 'none';
    menu.classList.remove('active');
    document.body.style.overflow = ''; // Restore scrolling
}

// Close mobile menu when clicking on menu links
document.querySelectorAll('.mobile-menu-nav a').forEach(link => {
    link.addEventListener('click', closeMobileMenu);
});

// Close mobile menu on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeMobileMenu();
    }
});
</script>

@endsection
