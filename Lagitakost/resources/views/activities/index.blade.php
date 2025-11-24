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

    /* Activities Page Styles */
    .activities-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 80px;
    }

    .activities-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .activities-title {
        font-size: 36px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .activities-subtitle {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
    }

    .activities-content {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .activities-filters {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e9ecef;
    }

    .filter-tabs {
        display: flex;
        gap: 10px;
    }

    .filter-tab {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        background: #f8f9fa;
        color: #666;
        border: none;
    }

    .filter-tab.active,
    .filter-tab:hover {
        background: #1a1a1a;
        color: white;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f8f9fa;
        padding: 10px 16px;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .search-input {
        border: none;
        background: transparent;
        outline: none;
        font-size: 14px;
        flex: 1;
    }

    .search-icon {
        color: #666;
    }

    .activities-list {
        margin-bottom: 30px;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 25px;
        border-bottom: 1px solid #f0f0f0;
        transition: all 0.3s;
        cursor: pointer;
    }

    .activity-item:hover {
        background: #f8f9fa;
        transform: translateX(5px);
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 5px;
    }

    .activity-description {
        font-size: 15px;
        color: #666;
        margin-bottom: 8px;
        line-height: 1.4;
    }

    .activity-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 13px;
        color: #999;
    }

    .activity-type {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .activity-type.booking {
        background: #e3f2fd;
        color: #1976d2;
    }

    .activity-type.message {
        background: #f3e5f5;
        color: #7b1fa2;
    }

    .activity-time {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        padding-top: 30px;
        border-top: 1px solid #e9ecef;
    }

    .pagination {
        display: flex;
        gap: 5px;
        align-items: center;
    }

    .pagination-link {
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s;
        border: 1px solid #e9ecef;
        color: #666;
    }

    .pagination-link:hover,
    .pagination-link.active {
        background: #1a1a1a;
        color: white;
        border-color: #1a1a1a;
    }

    .pagination-arrow {
        padding: 8px 14px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s ease;
        border: 1px solid #d1d5db;
        color: #374151;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-width: 90px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .pagination-arrow:hover {
        background: #f9fafb;
        color: #111827;
        border-color: #9ca3af;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.12);
    }

    .pagination-arrow:active {
        transform: translateY(0);
        transition: all 0.1s;
    }

    .pagination-arrow.disabled {
        opacity: 0.5;
        pointer-events: none;
        background: #f3f4f6;
        color: #9ca3af;
        border-color: #e5e7eb;
        box-shadow: none;
        transform: none;
    }

    .pagination-arrow svg {
        width: 14px;
        height: 14px;
        transition: transform 0.2s ease;
    }

    .pagination-arrow:hover svg {
        transform: scale(1.1);
    }

    .pagination-arrow.previous svg {
        transform: rotate(180deg);
    }

    .pagination-arrow.previous:hover svg {
        transform: rotate(180deg) scale(1.1);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        opacity: 0.5;
    }

    .empty-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
        color: #1a1a1a;
    }

    .empty-description {
        font-size: 16px;
        line-height: 1.5;
    }

    @media (max-width: 968px) {
        .activities-container {
            padding: 30px 30px;
        }

        .activities-content {
            padding: 30px 20px;
        }

        .activities-filters {
            flex-direction: column;
            gap: 20px;
            align-items: stretch;
        }

        .filter-tabs {
            justify-content: center;
        }

        .activity-item {
            padding: 20px;
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .activity-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
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
            <span class="brand-tagline">Owner Dashboard</span>
        </div>
    </a>

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
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-popup-btn logout-popup-btn-logout">Logout</button>
            </form>
        </div>
    </div>
</div>

<div class="activities-container">
    <div class="activities-header">
        <h1 class="activities-title">Semua Aktivitas</h1>
        <p class="activities-subtitle">
            Riwayat lengkap semua aktivitas sistem kost Anda
        </p>
    </div>

    <div class="activities-content">
        <div class="activities-filters">
            <div class="filter-tabs">
                <button class="filter-tab active" data-filter="all">Semua</button>
                <button class="filter-tab" data-filter="booking">Booking</button>
                <button class="filter-tab" data-filter="message">Pesan</button>
            </div>

            <div class="search-box">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="search-icon">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="M21 21l-4.35-4.35"></path>
                </svg>
                <input type="text" class="search-input" placeholder="Cari aktivitas..." id="searchInput">
            </div>
        </div>

        <div class="activities-list">
            @forelse($activities as $activity)
            <div class="activity-item" data-type="{{ $activity['type'] }}">
                <div class="activity-icon">
                    @if($activity['type'] === 'booking')
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 21V3a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v18a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <path d="M9 7h6"></path>
                            <path d="M9 11h6"></path>
                            <path d="M9 15h4"></path>
                        </svg>
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14,2 14,8 20,8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10,9 9,9 8,9"></polyline>
                        </svg>
                    @endif
                </div>
                <div class="activity-content">
                    <div class="activity-title">{{ $activity['title'] }}</div>
                    <div class="activity-description">{{ $activity['description'] }}</div>
                    <div class="activity-meta">
                        <span class="activity-type {{ $activity['type'] }}">{{ $activity['type'] === 'booking' ? 'Booking' : 'Pesan' }}</span>
                        <span class="activity-time">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            {{ $activity['created_at']->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14,2 14,8 20,8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10,9 9,9 8,9"></polyline>
                    </svg>
                </div>
                <div class="empty-title">Belum ada aktivitas</div>
                <div class="empty-description">
                    Aktivitas sistem seperti booking dan pesan masuk akan muncul di sini
                </div>
            </div>
            @endforelse
        </div>

        @if($activities->hasPages())
        <div class="pagination-container">
            <div class="pagination">
                @if($activities->onFirstPage())
                    <a class="pagination-arrow previous disabled" href="#">Previous</a>
                @else
                    <a class="pagination-arrow previous" href="{{ $activities->previousPageUrl() }}">Previous</a>
                @endif

                @if($activities->hasMorePages())
                    <a class="pagination-arrow" href="{{ $activities->nextPageUrl() }}">Next</a>
                @else
                    <a class="pagination-arrow disabled" href="#">Next</a>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<script>
function showLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'flex';
}

function hideLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'none';
}

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterTabs = document.querySelectorAll('.filter-tab');
    const activityItems = document.querySelectorAll('.activity-item');
    const searchInput = document.getElementById('searchInput');

    // Filter tabs
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            filterTabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');

            const filter = this.dataset.filter;

            activityItems.forEach(item => {
                if (filter === 'all' || item.dataset.type === filter) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        activityItems.forEach(item => {
            const title = item.querySelector('.activity-title').textContent.toLowerCase();
            const description = item.querySelector('.activity-description').textContent.toLowerCase();

            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
</script>

@endsection
