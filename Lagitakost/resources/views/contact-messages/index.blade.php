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

    .messages-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 80px;
    }

    .messages-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .messages-title {
        font-size: 36px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .messages-subtitle {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
    }

    .messages-grid {
        display: grid;
        gap: 20px;
    }

    .message-card {
        background: white;
        padding: 25px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        transition: all 0.3s;
        cursor: pointer;
        border-left: 4px solid #e0e0e0;
    }

    .message-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 25px rgba(0,0,0,0.12);
    }

    .message-card.unread {
        border-left-color: #1976d2;
        background: linear-gradient(135deg, #f8f9ff 0%, white 100%);
    }

    .message-header {
        display: flex;
        justify-content: between;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .message-sender {
        flex: 1;
    }

    .sender-name {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 5px;
    }

    .sender-email {
        font-size: 14px;
        color: #666;
    }

    .message-meta {
        text-align: right;
        font-size: 12px;
        color: #999;
    }

    .message-subject {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .message-preview {
        font-size: 14px;
        color: #666;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .message-actions {
        display: flex;
        gap: 10px;
        justify-content: space-between;
        align-items: center;
    }

    .message-time {
        font-size: 12px;
        color: #999;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }

    .btn-primary {
        background: #1976d2;
        color: white;
    }

    .btn-primary:hover {
        background: #1565c0;
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background: #c82333;
    }

    .unread-badge {
        background: #1976d2;
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 600;
        margin-left: 10px;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 40px;
    }

    .pagination a,
    .pagination span {
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s;
    }

    .pagination a {
        background: white;
        color: #333;
        border: 1px solid #e0e0e0;
    }

    .pagination a:hover {
        background: #f8f9fa;
        border-color: #1a1a1a;
    }

    .pagination .active {
        background: #1a1a1a;
        color: white;
        border-color: #1a1a1a;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: #666;
        font-size: 32px;
    }

    .empty-title {
        font-size: 24px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .empty-message {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
    }

    @media (max-width: 968px) {
        .messages-container {
            padding: 30px 30px;
        }

        .custom-navbar {
            padding: 15px 30px;
        }

        .navbar-menu {
            display: none;
        }

        .message-header {
            flex-direction: column;
            gap: 10px;
        }

        .message-meta {
            text-align: left;
        }
    }
</style>

<!-- Custom Navbar -->
<nav class="custom-navbar">
    <a href="{{ route('home') }}" class="navbar-brand-custom">
        <div class="brand-logo">LK</div>
        <div class="brand-text">
            <span class="brand-name">Lagita Kost</span>
            <span class="brand-tagline">Owner Dashboard</span>
        </div>
    </a>

    <ul class="navbar-menu">
        <li><a href="{{ route('home') }}">Dashboard</a></li>
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
        <button type="button" class="logout-btn" onclick="showLogoutPopup()">Logout</button>
    </div>
</nav>

<div class="messages-container">
    <div class="messages-header">
        <h1 class="messages-title">Pesan Masuk</h1>
        <p class="messages-subtitle">
            Kelola semua pesan yang dikirim oleh calon penghuni kost
        </p>
    </div>

    @if($messages->count() > 0)
        <div class="messages-grid">
            @foreach($messages as $message)
                <div class="message-card {{ $message->is_read ? '' : 'unread' }}" onclick="window.location.href='{{ route('contact-messages.show', $message->id) }}'">
                    <div class="message-header">
                        <div class="message-sender">
                            <div class="sender-name">{{ $message->name }}</div>
                            <div class="sender-email">{{ $message->email }}</div>
                        </div>
                        <div class="message-meta">
                            {{ $message->created_at->format('d M Y') }}
                            @if(!$message->is_read)
                                <span class="unread-badge">Baru</span>
                            @endif
                        </div>
                    </div>

                    <div class="message-subject">{{ $message->subject }}</div>
                    <div class="message-preview">{{ Str::limit($message->message, 100) }}</div>

                    <div class="message-actions">
                        <div class="message-time">{{ $message->created_at->diffForHumans() }}</div>
                        <div class="action-buttons">
                            <button class="btn btn-primary" onclick="event.stopPropagation(); window.location.href='{{ route('contact-messages.show', $message->id) }}'">
                                Lihat
                            </button>
                            <form method="POST" action="{{ route('contact-messages.destroy', $message->id) }}" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="event.stopPropagation();">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $messages->links() }}
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14,2 14,8 20,8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10,9 9,9 8,9"></polyline>
                </svg>
            </div>
            <h2 class="empty-title">Belum ada pesan</h2>
            <p class="empty-message">
                Pesan dari calon penghuni akan muncul di sini setelah mereka mengirim formulir kontak.
            </p>
        </div>
    @endif
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
function showLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'flex';
}

function hideLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const logoutPopup = document.getElementById('logoutPopup');
    if (event.target == logoutPopup) {
        hideLogoutPopup();
    }
}
</script>

@endsection
