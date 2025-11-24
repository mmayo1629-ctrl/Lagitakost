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

    /* Tenants Page Styles */
    .tenants-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 80px;
    }

    .tenants-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .tenants-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .tenants-subtitle {
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

    .tenants-content {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .tenants-table {
        width: 100%;
        border-collapse: collapse;
    }

    .tenants-table th,
    .tenants-table td {
        padding: 16px 20px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }

    .tenants-table th {
        background: #f8f9fa;
        font-weight: 600;
        color: #1a1a1a;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .tenants-table tr:hover {
        background: #f8f9fa;
    }

    .tenant-name {
        font-weight: 600;
        color: #1a1a1a;
    }

    .tenant-email {
        color: #666;
        font-size: 14px;
    }

    .room-type {
        font-weight: 500;
        color: #333;
    }

    .tenant-dates {
        color: #666;
        font-size: 14px;
    }

    .tenant-status {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
        background: #d1ecf1;
        color: #0c5460;
    }

    .tenant-notes {
        max-width: 200px;
        color: #666;
        font-size: 14px;
        line-height: 1.4;
    }

    .tenant-notes:empty::before {
        content: "-";
        color: #999;
    }

    .tenant-actions {
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

    .btn-edit {
        background: #007bff;
        color: white;
    }

    .btn-edit:hover {
        background: #0056b3;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
    }

    .no-tenants {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .no-tenants-icon {
        font-size: 48px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .no-tenants-title {
        font-size: 24px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .no-tenants-text {
        font-size: 16px;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: white;
        margin: 5% auto;
        padding: 30px;
        border-radius: 16px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 4px 30px rgba(0,0,0,0.3);
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-title {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .close {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: #1a1a1a;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-input:focus {
        outline: none;
        border-color: #1a1a1a;
    }

    .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        min-height: 80px;
        resize: vertical;
        transition: border-color 0.3s;
    }

    .form-textarea:focus {
        outline: none;
        border-color: #1a1a1a;
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 30px;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-secondary:hover {
        background: #545b62;
    }

    .btn-primary {
        background: #1a1a1a;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-primary:hover {
        background: #333;
    }

    @media (max-width: 1200px) {
        .tenants-container {
            padding: 30px 40px;
        }

        .tenants-table th,
        .tenants-table td {
            padding: 12px 16px;
        }

        .tenant-notes {
            max-width: 150px;
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
        z-index: 2000;
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

    @media (max-width: 768px) {
        .tenants-container {
            padding: 20px;
        }

        .tenants-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .tenants-table {
            font-size: 14px;
        }

        .tenants-table th,
        .tenants-table td {
            padding: 10px 12px;
        }

        .tenant-notes {
            max-width: 120px;
        }

        .tenant-actions {
            flex-direction: column;
            gap: 4px;
        }

        .action-btn {
            padding: 4px 8px;
            font-size: 11px;
        }

        .modal-content {
            margin: 10% auto;
            padding: 20px;
        }
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
        <a href="tel:+6287786100178" class="phone-number">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            +62 877-8610-0178
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

<div class="tenants-container">
    <div class="tenants-header">
        <div>
            <h1 class="tenants-title">Kelola Penghuni</h1>
            <p class="tenants-subtitle">Daftar penghuni yang sedang menempati kamar kost</p>
        </div>
        <a href="{{ route('home') }}" class="back-btn">← Kembali ke Dashboard</a>
    </div>

    <div class="tenants-content">
        @if($currentTenants->count() > 0)
        <table class="tenants-table">
            <thead>
                <tr>
                    <th>Penghuni</th>
                    <th>Tipe Kamar</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($currentTenants as $tenant)
                <tr>
                    <td>
                        <div class="tenant-name">{{ $tenant->user->name }}</div>
                        <div class="tenant-email">{{ $tenant->user->email }}</div>
                    </td>
                    <td>
                        <div class="room-type">{{ $tenant->display_room_type }}</div>
                    </td>
                    <td>
                        <div class="tenant-dates">{{ $tenant->check_in_date->format('d/m/Y') }}</div>
                    </td>
                    <td>
                        <div class="tenant-dates">{{ $tenant->check_out_date->format('d/m/Y') }}</div>
                    </td>
                    <td>
                        <span class="tenant-status">Aktif</span>
                    </td>
                    <td>
                        <div class="tenant-notes" title="{{ $tenant->notes }}">
                            {{ Str::limit($tenant->notes, 50) }}
                        </div>
                    </td>
                    <td>
                        <div class="tenant-actions">
                            <button class="action-btn btn-edit" onclick="openEditModal({{ $tenant->id }}, '{{ $tenant->user->name }}', '{{ $tenant->user->email }}', '{{ $tenant->room_type }}', '{{ $tenant->check_in_date->format('Y-m-d') }}', '{{ $tenant->check_out_date->format('Y-m-d') }}', '{{ addslashes($tenant->notes) }}')">
                                Edit
                            </button>
                            <form method="POST" action="{{ route('booking.delete-tenant', $tenant->id) }}" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data penghuni ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete">
                                    Hapus Data Penghuni
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-tenants">
            <div class="no-tenants-icon">🏠</div>
            <div class="no-tenants-title">Belum ada penghuni aktif</div>
            <div class="no-tenants-text">Penghuni yang sedang menempati kamar akan muncul di sini.</div>
        </div>
        @endif
    </div>
</div>

<!-- Edit Tenant Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Edit Penghuni</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <form id="editTenantForm" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" id="tenantId" name="tenant_id">

            <div class="form-group">
                <label class="form-label" for="tenantName">Nama Penghuni</label>
                <input type="text" id="tenantName" name="name" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="tenantEmail">Email</label>
                <input type="email" id="tenantEmail" name="email" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="roomType">Tipe Kamar</label>
                <select id="roomType" name="room_type" class="form-input" required>
                    <option value="Tipe A">Tipe A</option>
                    <option value="Tipe B">Tipe B</option>
                    <option value="Tipe C">Tipe C</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="checkInDate">Tanggal Check-in</label>
                <input type="date" id="checkInDate" name="check_in_date" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="checkOutDate">Tanggal Check-out</label>
                <input type="date" id="checkOutDate" name="check_out_date" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="tenantNotes">Catatan</label>
                <textarea id="tenantNotes" name="notes" class="form-textarea" placeholder="Catatan tambahan..."></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-secondary" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(id, name, email, roomType, checkIn, checkOut, notes) {
    document.getElementById('tenantId').value = id;
    document.getElementById('tenantName').value = name;
    document.getElementById('tenantEmail').value = email;
    document.getElementById('roomType').value = roomType;
    document.getElementById('checkInDate').value = checkIn;
    document.getElementById('checkOutDate').value = checkOut;
    document.getElementById('tenantNotes').value = notes;

    document.getElementById('editModal').style.display = 'block';
    document.getElementById('editTenantForm').action = '/booking/' + id + '/update-tenant';
}

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

function viewTenantDetails(tenantId) {
    // For now, just show an alert. You can implement a detailed view later
    alert('Fitur detail penghuni akan segera hadir!');
}

function showLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'flex';
}

function hideLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }

    const logoutPopup = document.getElementById('logoutPopup');
    if (event.target == logoutPopup) {
        hideLogoutPopup();
    }
}
</script>

@endsection
