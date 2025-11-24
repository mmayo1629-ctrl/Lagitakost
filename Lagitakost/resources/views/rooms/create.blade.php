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

    /* Form Styles */
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 80px;
    }

    .form-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .form-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .form-subtitle {
        font-size: 16px;
        color: #666;
    }

    .form-card {
        background: white;
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s;
        background: white;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #1a1a1a;
        box-shadow: 0 0 0 3px rgba(26, 26, 26, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .checkbox-group {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 10px;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .checkbox-item input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #1a1a1a;
    }

    .checkbox-item label {
        font-size: 14px;
        color: #333;
        cursor: pointer;
        margin: 0;
    }

    .file-upload {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .file-upload-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        background: #f8f9fa;
    }

    .file-upload-label:hover {
        border-color: #1a1a1a;
        background: #e9ecef;
    }

    .file-upload-icon {
        font-size: 48px;
        color: #6c757d;
        margin-bottom: 10px;
    }

    .file-upload-text {
        font-size: 16px;
        color: #6c757d;
        margin-bottom: 5px;
    }

    .file-upload-hint {
        font-size: 12px;
        color: #999;
    }

    .file-upload input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .image-preview {
        margin-top: 15px;
        display: none;
    }

    .image-preview img {
        max-width: 200px;
        max-height: 150px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #e9ecef;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: #1a1a1a;
        color: white;
    }

    .btn-primary:hover {
        background: #333;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: #f8f9fa;
        color: #1a1a1a;
        border: 2px solid #e9ecef;
    }

    .btn-secondary:hover {
        background: #e9ecef;
    }

    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
        display: block;
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

    @media (max-width: 968px) {
        .form-container {
            padding: 30px 30px;
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

        .form-actions {
            flex-direction: column;
        }

        .checkbox-group {
            grid-template-columns: 1fr;
        }
    }
</style>

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

<div class="form-container">
    <div class="form-header">
        <h1 class="form-title">Tambah Kamar Baru</h1>
        <p class="form-subtitle">Masukkan detail kamar untuk ditambahkan ke sistem kost</p>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('rooms.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nama Kamar *</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" placeholder="Contoh: Tipe A - 101" required>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="type" class="form-label">Tipe Kamar *</label>
                <select id="type" name="type" class="form-select" required>
                    <option value="">Pilih tipe kamar</option>
                    @foreach($roomTypes as $type => $price)
                        <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>
                            {{ $type }} - Rp {{ number_format($price, 0, ',', '.') }}/bulan
                        </option>
                    @endforeach
                </select>
                @error('type')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Harga Sewa (Rp) *</label>
                <input type="number" id="price" name="price" class="form-input" value="{{ old('price') }}" placeholder="500000" min="0" required>
                @error('price')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="capacity" class="form-label">Kapasitas (orang) *</label>
                <input type="number" id="capacity" name="capacity" class="form-input" value="{{ old('capacity') }}" placeholder="1" min="1" required>
                @error('capacity')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="size" class="form-label">Ukuran Kamar *</label>
                <input type="text" id="size" name="size" class="form-input" value="{{ old('size') }}" placeholder="Contoh: 3×4m" required>
                @error('size')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Fasilitas *</label>
                <div class="checkbox-group">
                    @php
                        $facilities = ['WiFi', 'AC', 'Kamar Mandi Dalam', 'TV', 'Lemari', 'Meja Belajar', 'Kasur', 'Kulkas', 'Dapur', 'Parkir'];
                        $oldFacilities = old('facilities', []);
                    @endphp
                    @foreach($facilities as $facility)
                        <div class="checkbox-item">
                            <input type="checkbox" id="facility_{{ $loop->index }}" name="facilities[]" value="{{ $facility }}" {{ in_array($facility, $oldFacilities) ? 'checked' : '' }}>
                            <label for="facility_{{ $loop->index }}">{{ $facility }}</label>
                        </div>
                    @endforeach
                </div>
                @error('facilities')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Foto Kamar</label>
                <div class="file-upload">
                    <label for="image" class="file-upload-label">
                        <div class="file-upload-icon">📷</div>
                        <div class="file-upload-text">Klik untuk memilih foto kamar</div>
                        <div class="file-upload-hint">Format: JPG, PNG, GIF. Maksimal 2MB</div>
                    </label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                <div class="image-preview" id="imagePreview">
                    <img id="previewImg" src="" alt="Preview">
                </div>
                @error('image')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi Tambahan</label>
                <textarea id="description" name="description" class="form-textarea" placeholder="Deskripsi detail kamar (opsional)">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <div class="checkbox-item">
                    <input type="checkbox" id="is_available" name="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }}>
                    <label for="is_available">Kamar tersedia untuk disewa</label>
                </div>
            </div>

            <div class="form-group">
                <div class="checkbox-item">
                    <input type="checkbox" id="is_popular" name="is_popular" value="1" {{ old('is_popular', false) ? 'checked' : '' }}>
                    <label for="is_popular">Tandai sebagai kamar populer</label>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('rooms.index') }}" class="btn btn-secondary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5"></path>
                        <path d="M12 19l-7-7 7-7"></path>
                    </svg>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14"></path>
                        <path d="M5 12h14"></path>
                    </svg>
                    Simpan Kamar
                </button>
            </div>
        </form>
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
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});

// Auto-fill price based on room type selection
document.getElementById('type').addEventListener('change', function() {
    const selectedType = this.value;
    const roomTypes = @json($roomTypes);
    if (roomTypes[selectedType]) {
        document.getElementById('price').value = roomTypes[selectedType];
    }
});

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
</script>

@endsection
