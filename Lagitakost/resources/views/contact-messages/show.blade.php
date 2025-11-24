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

    .message-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 40px 80px;
    }

    .message-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .message-title {
        font-size: 36px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .message-subtitle {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
    }

    .message-card {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .message-meta {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .sender-info {
        flex: 1;
    }

    .sender-name {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 5px;
    }

    .sender-email {
        font-size: 16px;
        color: #666;
        margin-bottom: 3px;
    }

    .sender-phone {
        font-size: 16px;
        color: #666;
    }

    .message-info {
        text-align: right;
    }

    .message-date {
        font-size: 14px;
        color: #999;
        margin-bottom: 5px;
    }

    .message-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-read {
        background: #e8f5e8;
        color: #2e7d32;
    }

    .status-unread {
        background: #fff3e0;
        color: #ef6c00;
    }

    .message-subject {
        font-size: 20px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 25px;
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 4px solid #1976d2;
    }

    .message-content {
        font-size: 16px;
        color: #333;
        line-height: 1.8;
        margin-bottom: 30px;
        padding: 25px;
        background: #fafafa;
        border-radius: 10px;
        white-space: pre-line;
    }

    .message-actions {
        display: flex;
        gap: 15px;
        justify-content: space-between;
        align-items: center;
        padding-top: 25px;
        border-top: 1px solid #f0f0f0;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-secondary {
        background: #f8f9fa;
        color: #1a1a1a;
        border: 1px solid #e0e0e0;
    }

    .btn-secondary:hover {
        background: #e9ecef;
        border-color: #1a1a1a;
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background: #c82333;
    }

    .back-link {
        color: #666;
        text-decoration: none;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: color 0.3s;
    }

    .back-link:hover {
        color: #1a1a1a;
    }

    .contact-actions {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-top: 25px;
    }

    .contact-actions h4 {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .contact-buttons {
        display: flex;
        gap: 12px;
    }

    .contact-btn {
        flex: 1;
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s;
    }

    .contact-btn.phone {
        background: #28a745;
        color: white;
    }

    .contact-btn.phone:hover {
        background: #218838;
    }

    .contact-btn.whatsapp {
        background: #25d366;
        color: white;
    }

    .contact-btn.whatsapp:hover {
        background: #1da851;
    }

    .contact-btn.email {
        background: #007bff;
        color: white;
    }

    .contact-btn.email:hover {
        background: #0056b3;
    }

    @media (max-width: 968px) {
        .message-container {
            padding: 30px 30px;
        }

        .custom-navbar {
            padding: 15px 30px;
        }

        .navbar-menu {
            display: none;
        }

        .message-meta {
            flex-direction: column;
            gap: 15px;
        }

        .message-info {
            text-align: left;
        }

        .message-actions {
            flex-direction: column;
            gap: 20px;
        }

        .action-buttons {
            justify-content: center;
        }

        .contact-buttons {
            flex-direction: column;
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
        <form method="POST" action="{{ route('logout') }}" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin keluar?')">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</nav>

<div class="message-container">
    <div class="message-header">
        <h1 class="message-title">Detail Pesan</h1>
        <p class="message-subtitle">
            Lihat detail lengkap pesan dari calon penghuni
        </p>
    </div>

    <div class="message-card">
        <div class="message-meta">
            <div class="sender-info">
                <div class="sender-name">{{ $message->name }}</div>
                <div class="sender-email">{{ $message->email }}</div>
                <div class="sender-phone">{{ $message->phone }}</div>
            </div>
            <div class="message-info">
                <div class="message-date">{{ $message->created_at->format('l, d F Y H:i') }}</div>
                <div class="message-status {{ $message->is_read ? 'status-read' : 'status-unread' }}">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    {{ $message->is_read ? 'Sudah Dibaca' : 'Belum Dibaca' }}
                    @if($message->read_at)
                        <br><small style="font-weight: normal;">Dibaca: {{ $message->read_at->format('d M Y H:i') }}</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="message-subject">
            {{ $message->subject }}
        </div>

        <div class="message-content">
            {{ $message->message }}
        </div>

        <div class="contact-actions">
            <h4>Kontak Pengirim</h4>
            <div class="contact-buttons">
                <a href="tel:{{ $message->phone }}" class="contact-btn phone">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    Telepon
                </a>
                <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $message->phone) }}" class="contact-btn whatsapp" target="_blank">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    WhatsApp
                </a>
                <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="contact-btn email">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    Email
                </a>
            </div>
        </div>

        <div class="message-actions">
            <a href="{{ route('contact-messages.index') }}" class="back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5"></path>
                    <path d="M12 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Pesan
            </a>

            <div class="action-buttons">
                @if(!$message->is_read)
                    <button class="btn btn-secondary" onclick="markAsRead({{ $message->id }})">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        Tandai Sudah Dibaca
                    </button>
                @endif

                <form method="POST" action="{{ route('contact-messages.destroy', $message->id) }}" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                        </svg>
                        Hapus Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function markAsRead(messageId) {
    fetch(`{{ url('/contact-messages') }}/${messageId}/read`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menandai pesan sebagai sudah dibaca');
    });
}
</script>

@endsection
