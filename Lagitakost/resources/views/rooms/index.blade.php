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

    /* Rooms Management Styles */
    .rooms-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 80px;
    }

    .rooms-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .rooms-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .add-room-btn {
        background: #1a1a1a;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }

    .add-room-btn:hover {
        background: #333;
        transform: translateY(-2px);
    }

    .rooms-table {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .table-header {
        background: #f8f9fa;
        padding: 20px;
        border-bottom: 1px solid #e9ecef;
    }

    .table-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin: 0;
    }

    .table-content {
        padding: 0;
    }

    .room-row {
        display: flex;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.3s;
    }

    .room-row:hover {
        background: #f8f9fa;
    }

    .room-row:last-child {
        border-bottom: none;
    }

    .room-image {
        width: 80px;
        height: 60px;
        border-radius: 6px;
        overflow: hidden;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .room-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .room-image.placeholder {
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 12px;
    }

    .room-info {
        flex: 1;
        min-width: 0;
    }

    .room-name {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .room-details {
        font-size: 14px;
        color: #666;
        margin-bottom: 2px;
    }

    .room-price {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-right: 20px;
    }

    .room-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-available {
        background: #d4edda;
        color: #155724;
    }

    .status-unavailable {
        background: #f8d7da;
        color: #721c24;
    }

    .room-actions {
        display: flex;
        gap: 8px;
        margin-left: 20px;
    }

    .action-btn {
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.3s;
    }

    .btn-edit {
        background: #ffc107;
        color: #000;
        border: 1px solid #ffc107;
    }

    .btn-edit:hover {
        background: #e0a800;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: 1px solid #dc3545;
    }

    .btn-delete:hover {
        background: #c82333;
    }

    .btn-toggle {
        background: #28a745;
        color: white;
        border: 1px solid #28a745;
    }

    .btn-toggle:hover {
        background: #218838;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #1a1a1a;
    }

    .empty-description {
        font-size: 16px;
        margin-bottom: 30px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 30px;
        gap: 8px;
        flex-wrap: wrap;
    }

    .pagination li {
        list-style: none;
    }

    .pagination a,
    .pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        text-decoration: none;
        color: #007bff;
        font-weight: 500;
        transition: all 0.3s;
        background: white;
    }

    .pagination .active span {
        background: #007bff;
        color: white;
        border-color: #007bff;
        font-weight: 600;
    }

    .pagination a:hover {
        background: #007bff;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,123,255,0.3);
    }

    .pagination .disabled span {
        color: #6c757d;
        background: #f8f9fa;
        border-color: #dee2e6;
        cursor: not-allowed;
    }

    .pagination .page-link {
        border: none;
        background: transparent;
        color: inherit;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .pagination .page-link:focus {
        outline: none;
        box-shadow: none;
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

    /* Delete Confirmation Modal Styles */
    .delete-modal-overlay {
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

    .delete-modal {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        border: 1px solid #e0e0e0;
        max-width: 450px;
        width: 90%;
        animation: modalSlideIn 0.4s ease-out;
    }

    .delete-modal-header {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        padding: 25px 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .delete-modal-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: shimmer 2s infinite;
    }

    .delete-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 15px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        position: relative;
        z-index: 2;
        animation: iconBounce 0.6s ease-out 0.2s both;
    }

    .delete-modal-title {
        color: white;
        font-weight: 700;
        font-size: 24px;
        margin: 0;
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .delete-modal-body {
        padding: 30px;
        text-align: center;
    }

    .delete-message {
        font-size: 18px;
        color: #1a1a1a;
        margin-bottom: 8px;
        font-weight: 600;
        line-height: 1.4;
    }

    .delete-submessage {
        font-size: 16px;
        color: #666;
        margin-bottom: 25px;
        line-height: 1.5;
    }

    .delete-room-name {
        font-weight: 700;
        color: #dc3545;
        font-size: 16px;
    }

    .delete-modal-actions {
        padding: 20px 30px 30px;
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .delete-modal-btn {
        padding: 12px 25px;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid;
        min-width: 120px;
    }

    .delete-modal-btn-cancel {
        background: white;
        border-color: #6c757d;
        color: #6c757d;
    }

    .delete-modal-btn-cancel:hover {
        background: #6c757d;
        border-color: #6c757d;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(108, 117, 125, 0.3);
    }

    .delete-modal-btn-confirm {
        background: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .delete-modal-btn-confirm:hover {
        background: #c82333;
        border-color: #c82333;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(220, 53, 69, 0.3);
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: scale(0.8) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes iconBounce {
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

    @media (max-width: 968px) {
        .rooms-container {
            padding: 30px 30px;
        }

        .rooms-header {
            flex-direction: column;
            gap: 20px;
            align-items: stretch;
        }

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

        .room-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .room-price {
            margin-right: 0;
        }

        .room-actions {
            margin-left: 0;
            width: 100%;
            justify-content: flex-end;
        }
    }
</style>

@if(session('success'))
<div style="position: fixed; top: 20px; right: 20px; background: #d4edda; color: #155724; padding: 15px 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); z-index: 1001; font-weight: 500;">
    {{ session('success') }}
</div>
@endif

<!-- Custom Navbar -->
<nav class="custom-navbar">
    <a href="{{ route('home') }}" class="navbar-brand-custom">
        <div class="brand-logo">LK</div>
        <div class="brand-text">
            <div class="brand-name">Lagita Kost</div>
            <div class="brand-tagline">Owner Dashboard</div>
        </div>
    </a>

    <ul class="navbar-menu">
        <li><a href="{{ route('rooms') }}">Kamar</a></li>
        <li><a href="{{ route('fasilitas') }}">Fasilitas</a></li>
        <li><a href="#lokasi">Lokasi</a></li>
        <li><a href="{{ route('contact') }}">Kontak</a></li>
    </ul>

    <div class="navbar-actions">
        <a href="tel:+6287786100178" class="phone-number">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            +62 877-6100-1778
        </a>
        <a href="https://wa.me/6287786100178" class="contact-button" target="_blank">
            Hubungi Admin
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

<!-- Delete Confirmation Modal -->
<div class="delete-modal-overlay" id="deleteModal">
    <div class="delete-modal">
        <div class="delete-modal-header">
            <div class="delete-icon">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#dc3545" stroke-width="2">
                    <path d="M3 6h18"></path>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
            </div>
            <h2 class="delete-modal-title">Konfirmasi Hapus</h2>
        </div>
        <div class="delete-modal-body">
            <div class="delete-message">Apakah Anda yakin ingin menghapus kamar ini?</div>
            <div class="delete-submessage">
                Kamar <span class="delete-room-name" id="deleteRoomName"></span> akan dihapus secara permanen dan tidak dapat dikembalikan.
            </div>
        </div>
        <div class="delete-modal-actions">
            <button class="delete-modal-btn delete-modal-btn-cancel" onclick="hideDeleteModal()">Batal</button>
            <form method="POST" id="deleteForm" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-modal-btn delete-modal-btn-confirm">Hapus Kamar</button>
            </form>
        </div>
    </div>
</div>

<div class="rooms-container">
    <div class="rooms-header">
        <h1 class="rooms-title">Kelola Kamar</h1>
        <a href="{{ route('rooms.create') }}" class="add-room-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14"></path>
                <path d="M5 12h14"></path>
            </svg>
            Tambah Kamar Baru
        </a>
    </div>

    <div class="rooms-table">
        <div class="table-header">
            <h2 class="table-title">Daftar Kamar ({{ $rooms->total() }} kamar)</h2>
        </div>

        <div class="table-content">
            @forelse($rooms as $room)
            <div class="room-row">
                <div class="room-image">
                    @if($room->imageUrl)
                        <img src="{{ $room->imageUrl }}" alt="{{ $room->name }}">
                    @else
                        <div class="placeholder">No Image</div>
                    @endif
                </div>

                <div class="room-info">
                    <div class="room-name">{{ $room->name }}</div>
                    <div class="room-details">{{ $room->type }} • {{ $room->size }} • {{ $room->capacity }} orang</div>
                    <div class="room-details">{{ $room->facilities_list }}</div>
                </div>

                <div class="room-price">{{ $room->formatted_price }}/bulan</div>

                <div class="room-status {{ $room->is_available ? 'status-available' : 'status-unavailable' }}">
                    {{ $room->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                </div>

                <div class="room-actions">
                    <a href="{{ route('rooms.edit', $room) }}" class="action-btn btn-edit">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        Edit
                    </a>

                    <form method="POST" action="{{ route('rooms.toggle-availability', $room) }}" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="action-btn btn-toggle">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            {{ $room->is_available ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>

                    <button type="button" class="action-btn btn-delete" onclick="showDeleteModal('{{ $room->name }}', '{{ route('rooms.destroy', $room) }}')">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 6h18"></path>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-title">Belum ada kamar</div>
                <div class="empty-description">Tambahkan kamar pertama untuk mulai mengelola kost Anda.</div>
                <a href="{{ route('rooms.create') }}" class="add-room-btn">Tambah Kamar Baru</a>
            </div>
            @endforelse
        </div>
    </div>

    @if($rooms->hasPages())
    <div class="pagination">
        {{ $rooms->links() }}
    </div>
    @endif
</div>

<script>
// Logout popup functions
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

// Delete modal functions
function showDeleteModal(roomName, deleteUrl) {
    document.getElementById('deleteRoomName').textContent = roomName;
    document.getElementById('deleteForm').action = deleteUrl;
    document.getElementById('deleteModal').style.display = 'flex';
}

function hideDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

// Close delete modal when clicking outside
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideDeleteModal();
    }
});

// Auto-hide success message after 5 seconds
setTimeout(() => {
    const successMsg = document.querySelector('[style*="background: #d4edda"]');
    if (successMsg) {
        successMsg.style.display = 'none';
    }
}, 5000);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const navbarMenu = document.querySelector('.navbar-menu');

        if (menuToggle && navbarMenu) {
            menuToggle.addEventListener('click', function () {
                navbarMenu.classList.toggle('active');
            });
        }
    });
</script>

@endsection
