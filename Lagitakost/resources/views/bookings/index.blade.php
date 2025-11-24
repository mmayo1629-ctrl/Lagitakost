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
    }

    @media (max-width: 768px) {
        .mobile-menu-toggle {
            display: block;
        }
        .navbar-menu {
            display: none;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            margin-top: 10px;
        }
        .navbar-menu.active {
            display: flex;
        }
        .custom-navbar {
            flex-wrap: wrap;
            padding: 15px 20px;
        }
        .navbar-actions {
            width: 100%;
            justify-content: center;
            margin-top: 10px;
            gap: 15px;
            order: 3;
        }
        .bookings-container {
            padding: 20px 10px;
        }
    }

    /* Bookings Page Styles */
    .bookings-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 80px;
    }

    .bookings-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .bookings-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .bookings-subtitle {
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

    .bookings-content {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .bookings-table {
        width: 100%;
        border-collapse: collapse;
    }

    .bookings-table th,
    .bookings-table td {
        padding: 16px 20px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }

    .bookings-table th {
        background: #f8f9fa;
        font-weight: 600;
        color: #1a1a1a;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .bookings-table tr:hover {
        background: #f8f9fa;
    }

    .customer-name {
        font-weight: 600;
        color: #1a1a1a;
    }

    .room-type {
        font-weight: 500;
        color: #333;
    }

    .booking-dates {
        color: #666;
        font-size: 14px;
    }

    .booking-status {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
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

    .booking-notes {
        max-width: 200px;
        color: #666;
        font-size: 14px;
        line-height: 1.4;
    }

    .booking-notes:empty::before {
        content: "-";
        color: #999;
    }

    .booking-actions {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-confirm {
        background: #28a745;
        color: white;
    }

    .btn-confirm:hover {
        background: #218838;
    }

    .btn-cancel {
        background: #dc3545;
        color: white;
    }

    .btn-cancel:hover {
        background: #c82333;
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

    @media (max-width: 1200px) {
        .bookings-container {
            padding: 30px 40px;
        }

        .bookings-table th,
        .bookings-table td {
            padding: 12px 16px;
        }

        .booking-notes {
            max-width: 150px;
        }
    }

    @media (max-width: 768px) {
        .bookings-container {
            padding: 20px;
        }

        .bookings-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .bookings-table {
            font-size: 14px;
        }

        .bookings-table th,
        .bookings-table td {
            padding: 10px 12px;
        }

        .booking-notes {
            max-width: 120px;
        }

        .booking-actions {
            flex-direction: column;
            gap: 4px;
        }

        .action-btn {
            padding: 4px 8px;
            font-size: 11px;
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

    /* Confirmation Popup Styles */
    .confirmation-popup-overlay {
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
    .confirmation-popup {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border: 1px solid #ddd;
        max-width: 450px;
        width: 90%;
        animation: popupSlideIn 0.3s ease-out;
    }
    .confirmation-popup-header {
        border: none;
        border-radius: 8px 8px 0 0;
        background: white;
        padding: 20px 30px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }
    .confirmation-popup-title {
        color: #333;
        font-weight: 600;
        font-size: 18px;
        margin: 0;
    }
    .confirmation-popup-body {
        padding: 30px;
        text-align: center;
    }
    .confirmation-popup-icon {
        animation: pulse 2s infinite;
        color: #28a745;
        margin-bottom: 20px;
    }
    .confirmation-popup-message {
        font-size: 16px;
        margin-bottom: 15px;
        color: #1a1a1a;
        font-weight: 600;
    }
    .confirmation-popup-details {
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
        line-height: 1.5;
    }
    .confirmation-popup-warning {
        font-size: 14px;
        color: #856404;
        background: #fff3cd;
        padding: 12px;
        border-radius: 6px;
        border: 1px solid #ffeaa7;
        line-height: 1.4;
    }
    .confirmation-popup-actions {
        padding: 20px 30px 30px;
        display: flex;
        gap: 15px;
        justify-content: center;
    }
    .confirmation-popup-btn {
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        padding: 12px 30px;
        transition: all 0.3s ease;
        border: 1px solid;
        cursor: pointer;
    }
    .confirmation-popup-btn-cancel {
        background: white;
        border-color: #6c757d;
        color: #6c757d;
    }
    .confirmation-popup-btn-cancel:hover {
        background: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    .confirmation-popup-btn-confirm {
        background: #28a745;
        border-color: #28a745;
        color: white;
    }
    .confirmation-popup-btn-confirm:hover {
        background: #218838;
        border-color: #218838;
        color: white;
    }
</style>

<!-- Custom Navbar -->
<nav class="custom-navbar">
    <a href="/" class="navbar-brand-custom">
        <div class="brand-logo">LK</div>
        <div class="brand-text">
            <span class="brand-name">Lagita Kost</span>
            <span class="brand-tagline">Owner Dashboard</span>
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

<div class="bookings-container">
    <div class="bookings-header">
        <div>
            <h1 class="bookings-title">Booking Kamar Bulan Ini</h1>
            <p class="bookings-subtitle">{{ now()->format('F Y') }} - Kelola semua booking kamar</p>
        </div>
        <a href="{{ route('home') }}" class="back-btn">← Kembali ke Dashboard</a>
    </div>

    <div class="bookings-content">
        @if($bookings->count() > 0)
        <table class="bookings-table">
            <thead>
                <tr>
                    <th>Pelanggan</th>
                    <th>Tipe Kamar</th>
                    <th>Tanggal Booking</th>
                    <th>Check-in / Check-out</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>
                        <div class="customer-name">{{ $booking->user->name }}</div>
                    </td>
                    <td>
                        <div class="room-type">{{ $booking->display_room_type }}</div>
                    </td>
                    <td>
                        <div class="booking-dates">{{ $booking->created_at->format('d/m/Y H:i') }}</div>
                    </td>
                    <td>
                        <div class="booking-dates">
                            {{ $booking->check_in_date->format('d/m/Y') }}<br>
                            <small>sampai {{ $booking->check_out_date->format('d/m/Y') }}</small>
                        </div>
                    </td>
                    <td>
                        <span class="booking-status status-{{ $booking->status }}">
                            @switch($booking->status)
                                @case('pending')
                                    Menunggu
                                    @break
                                @case('confirmed')
                                    Dikonfirmasi
                                    @break
                                @case('cancelled')
                                    Dibatalkan
                                    @break
                            @endswitch
                        </span>
                    </td>
                    <td>
                        <div class="booking-notes" title="{{ $booking->notes }}">
                            {{ Str::limit($booking->notes, 50) }}
                        </div>
                    </td>
                    <td>
                        <div class="booking-price">
                            Rp {{ number_format($booking->price, 0, ',', '.') }}
                        </div>
                    </td>
                    <td>
                        <div class="booking-actions">
                            @if($booking->status === 'pending')
                            <form method="POST" action="{{ route('booking.update-status', $booking) }}" style="display: inline;" id="confirm-form-{{ $booking->id }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="confirmed">
                                <button type="button" class="action-btn btn-confirm" onclick="showConfirmationPopup({{ $booking->id }}, '{{ $booking->user->name }}', '{{ $booking->display_room_type }}')">Konfirmasi</button>
                            </form>
                            <form method="POST" action="{{ route('booking.update-status', $booking) }}" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="cancelled">
                                <button type="submit" class="action-btn btn-cancel">Batalkan</button>
                            </form>
                            @elseif($booking->status === 'confirmed')
                            <span class="booking-status status-confirmed" style="font-size: 11px; padding: 4px 8px;">Sudah Dikonfirmasi</span>
                            @elseif($booking->status === 'cancelled')
                            <span class="booking-status status-cancelled" style="font-size: 11px; padding: 4px 8px;">Dibatalkan</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-bookings">
            <div class="no-bookings-icon">📅</div>
            <div class="no-bookings-title">Belum ada booking bulan ini</div>
            <div class="no-bookings-text">Booking kamar akan muncul di sini setelah ada pelanggan yang melakukan booking.</div>
        </div>
        @endif
    </div>
</div>

<!-- CONFIRMATION POPUP -->
<div class="confirmation-popup-overlay" id="confirmationPopup">
    <div class="confirmation-popup">
        <div class="confirmation-popup-header">
            <h3 class="confirmation-popup-title">Konfirmasi Booking</h3>
        </div>
        <div class="confirmation-popup-body">
            <div class="confirmation-popup-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div class="confirmation-popup-message">Konfirmasi booking ini?</div>
            <div class="confirmation-popup-details" id="confirmationDetails">
                <!-- Details will be populated by JavaScript -->
            </div>
            <div class="confirmation-popup-warning">
                <strong>Catatan:</strong> Sistem akan otomatis mengisi kamar yang tersedia dan menambah penghuni tanpa mengubah fungsi apapun.
            </div>
        </div>
        <div class="confirmation-popup-actions">
            <button class="confirmation-popup-btn confirmation-popup-btn-cancel" onclick="hideConfirmationPopup()">Batal</button>
            <button class="confirmation-popup-btn confirmation-popup-btn-confirm" id="confirmButton" onclick="confirmBooking()">Konfirmasi</button>
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
    let currentBookingId = null;

    // Confirmation popup functions
    function showConfirmationPopup(bookingId, customerName, roomType) {
        currentBookingId = bookingId;
        document.getElementById('confirmationDetails').innerHTML = `
            <strong>Pelanggan:</strong> ${customerName}<br>
            <strong>Tipe Kamar:</strong> ${roomType}
        `;
        document.getElementById('confirmationPopup').style.display = 'flex';
    }

    function hideConfirmationPopup() {
        document.getElementById('confirmationPopup').style.display = 'none';
        currentBookingId = null;
    }

    function confirmBooking() {
        if (currentBookingId) {
            document.getElementById('confirm-form-' + currentBookingId).submit();
        }
    }

    // Confirmation popup event listener for clicking outside
    document.getElementById('confirmationPopup').addEventListener('click', function(e) {
        if (e.target === this) {
            hideConfirmationPopup();
        }
    });

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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const navbarMenu = document.querySelector('.navbar-menu');

        menuToggle.addEventListener('click', function () {
            navbarMenu.classList.toggle('active');
        });
    });
</script>

@endsection
