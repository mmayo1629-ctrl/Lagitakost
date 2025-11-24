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
        background: #f8f9fa;
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



    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 80px;
    }

    .search-container {
        margin-bottom: 30px;
    }

    .search-input-wrapper {
        position: relative;
        max-width: 400px;
    }

    .search-input-wrapper .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        color: #666;
        pointer-events: none;
    }

    .search-input-wrapper input {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        transition: border-color 0.3s;
        background: white;
    }

    .search-input-wrapper input:focus {
        outline: none;
        border-color: #000;
    }

    .search-input-wrapper input::placeholder {
        color: #999;
    }

    .room-actions {
        display: flex;
        justify-content: center;
    }

    .btn-booking {
        width: 100%;
    }

    .filter-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 30px;
    }

    .tab-btn {
        padding: 10px 24px;
        border: 2px solid #e0e0e0;
        background: white;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        color: #666;
    }

    .tab-btn:hover {
        border-color: #000;
        color: #000;
    }

    .tab-btn.active {
        background: #000;
        color: white;
        border-color: #000;
    }

    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 30px;
    }

    .room-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        transition: all 0.3s;
        position: relative;
    }

    .room-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.12);
    }

    .room-image {
        position: relative;
        width: 100%;
        height: 240px;
        overflow: hidden;
    }

    .room-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .popular-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: #ffc107;
        color: #000;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .unavailable-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #dc3545;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
    }

    .favorite-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 36px;
        height: 36px;
        background: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }

    .favorite-btn:hover {
        transform: scale(1.1);
    }

    .room-content {
        padding: 20px;
    }

    .room-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 12px;
    }

    .room-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .room-price {
        text-align: right;
    }

    .price-amount {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .price-period {
        font-size: 13px;
        color: #666;
    }

    .room-info {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        font-size: 14px;
        color: #666;
    }

    .room-features {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 18px;
    }

    .feature-tag {
        padding: 6px 12px;
        background: #f5f5f5;
        border-radius: 6px;
        font-size: 13px;
        color: #666;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .room-actions {
        display: flex;
        gap: 10px;
    }

    .btn-detail {
        flex: 1;
        padding: 12px;
        background: white;
        border: 2px solid #000;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-detail:hover {
        background: #f5f5f5;
    }

    .btn-booking {
        flex: 1;
        padding: 12px;
        background: #000;
        color: white;
        border: 2px solid #000;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-booking:hover {
        background: #333;
    }

    .btn-booking:disabled,
    .btn-detail:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        background: #e0e0e0;
        border-color: #e0e0e0;
        color: #999;
    }

    @media (max-width: 1200px) {
        .rooms-grid {
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        }

        .container {
            padding: 30px 40px;
        }
    }

    /* Mobile Menu Styles */
    .mobile-menu-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        z-index: 999;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .mobile-menu-overlay.show {
        opacity: 1;
    }

    .mobile-menu {
        position: fixed;
        top: 0;
        right: -320px;
        width: 300px;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: -2px 0 20px rgba(0,0,0,0.3);
        transition: right 0.3s ease;
        z-index: 1000;
        padding: 80px 0 0 0;
        overflow-y: auto;
        backdrop-filter: blur(20px);
    }

    .mobile-menu.show {
        right: 0;
    }

    .mobile-menu-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .mobile-menu-item {
        border-bottom: 1px solid #eee;
    }


        display: block;
        padding: 15px 25px;
        color: #333;
        text-decoration: none;
        font-size: 16px;
        font-weight: 500;
        transition: all 0.3s;
        position: relative;
    }

    .mobile-menu-link:hover,
    .mobile-menu-link.active {
        background-color: #f8f9fa;
        color: #000;
        padding-left: 35px;
    }
    .mobile-menu-link.active::before {
        content: '▶';
        position: absolute;
        left: 15px;
        color: #000;
        font-size: 12px;
    }

    .mobile-menu-actions {
        padding: 20px 25px;
        border-top: 1px solid #eee;
        margin-top: 20px;
    }

    .mobile-menu-actions .phone-number {
        display: block;
        margin-bottom: 15px;
        font-size: 14px;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .mobile-menu-actions .user-profile {
        margin-bottom: 15px;
        padding: 15px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 8px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .mobile-menu-actions .user-profile .user-info {
        margin-top: 8px;
    }

    .mobile-menu-actions .logout-btn {
        width: 100%;
        padding: 12px;
        margin-bottom: 10px;
        border-radius: 8px;
    }

    .mobile-menu-close {
        position: absolute;
        top: 20px;
        right: 20px;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #666;
        padding: 5px;
        border-radius: 50%;
        transition: all 0.3s;
    }

    .mobile-menu-close:hover {
        background: #f0f0f0;
        color: #000;
    }

    /* Responsive Breakpoints */
    @media (max-width: 1200px) {
        .custom-navbar {
            padding: 15px 40px;
        }

        .container {
            padding: 30px 40px;
        }

        .rooms-grid {
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }
    }

    @media (max-width: 968px) {
        .custom-navbar {
            padding: 15px 20px;
        }

        .navbar-menu {
            display: none;
        }

        .mobile-menu-toggle {
            display: block;
        }

        .navbar-actions {
            gap: 15px;
        }

        .navbar-actions .phone-number {
            display: none;
        }

        .container {
            padding: 20px;
        }

        .search-input-wrapper {
            max-width: 100%;
        }

        .filter-tabs {
            gap: 8px;
            margin-bottom: 25px;
        }

        .tab-btn {
            padding: 8px 16px;
            font-size: 14px;
        }

        .rooms-grid {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .room-card {
            margin: 0 auto;
        }

        .room-content {
            padding: 16px;
        }

        .room-title {
            font-size: 18px;
        }

        .price-amount {
            font-size: 20px;
        }

        .room-actions {
            flex-direction: column;
            gap: 8px;
        }

        .btn-detail,
        .btn-booking {
            width: 100%;
            padding: 10px;
            font-size: 13px;
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

        .container {
            padding: 15px;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-input-wrapper input {
            padding: 10px 15px 10px 40px;
            font-size: 14px;
        }

        .filter-tabs {
            flex-wrap: wrap;
            gap: 6px;
        }

        .tab-btn {
            padding: 6px 12px;
            font-size: 13px;
            flex: 1;
            min-width: 80px;
        }

        .rooms-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .room-card {
            max-width: 100%;
        }

        .room-image {
            height: 200px;
        }

        .room-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .room-price {
            align-self: flex-end;
        }

        .room-info {
            font-size: 13px;
        }

        .room-features {
            gap: 6px;
        }

        .feature-tag {
            padding: 4px 8px;
            font-size: 12px;
        }

        .popular-badge,
        .unavailable-badge {
            font-size: 11px;
            padding: 4px 8px;
        }

        .favorite-btn {
            width: 32px;
            height: 32px;
            font-size: 16px;
        }

        /* Modal responsiveness */
        .modal-content {
            width: 95%;
            max-width: none;
            margin: 10px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            padding: 15px;
        }

        .modal-title {
            font-size: 20px;
        }

        .modal-body {
            padding: 15px;
        }

        .detail-image {
            height: 250px;
        }

        .detail-price {
            font-size: 24px;
        }

        .detail-info {
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea {
            padding: 10px;
            font-size: 14px;
        }

        .form-actions {
            flex-direction: column;
            gap: 8px;
        }

        .btn-detail,
        .btn-booking {
            width: 100%;
            padding: 12px;
            font-size: 14px;
        }

        /* Success modal responsiveness */
        .success-modal {
            width: 95%;
            max-width: 400px;
        }

        .success-modal-header {
            padding: 25px 30px;
        }

        .success-modal-title {
            font-size: 24px;
        }

        .success-modal-body {
            padding: 30px;
        }

        .success-message {
            font-size: 16px;
        }

        .success-submessage {
            font-size: 14px;
        }

        .success-actions {
            flex-direction: column;
            gap: 12px;
        }

        .success-btn {
            width: 100%;
            padding: 12px 20px;
            font-size: 14px;
        }

        /* Logout popup responsiveness */
        .logout-popup {
            width: 95%;
            max-width: 350px;
        }

        .logout-popup-header {
            padding: 15px 20px;
        }

        .logout-popup-title {
            font-size: 16px;
        }

        .logout-popup-body {
            padding: 20px;
        }

        .logout-popup-message {
            font-size: 14px;
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

    @media (max-width: 480px) {
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

        .container {
            padding: 10px;
        }

        .search-input-wrapper input {
            padding: 8px 12px 8px 35px;
            font-size: 13px;
        }

        .search-icon {
            width: 16px;
            height: 16px;
            left: 12px;
        }

        .tab-btn {
            padding: 5px 10px;
            font-size: 12px;
            min-width: 70px;
        }

        .room-card {
            border-radius: 8px;
        }

        .room-image {
            height: 180px;
        }

        .room-content {
            padding: 12px;
        }

        .room-title {
            font-size: 16px;
        }

        .price-amount {
            font-size: 18px;
        }

        .price-period {
            font-size: 12px;
        }

        .room-info {
            font-size: 12px;
        }

        .feature-tag {
            padding: 3px 6px;
            font-size: 11px;
        }

        .btn-detail,
        .btn-booking {
            padding: 8px;
            font-size: 12px;
        }

        .modal-content {
            width: 98%;
            margin: 5px;
        }

        .modal-header {
            padding: 12px;
        }

        .modal-title {
            font-size: 18px;
        }

        .modal-body {
            padding: 12px;
        }

        .success-modal {
            width: 98%;
        }

        .success-modal-header {
            padding: 20px 15px;
        }

        .success-modal-title {
            font-size: 20px;
        }

        .success-modal-body {
            padding: 20px 15px;
        }

        .success-message {
            font-size: 15px;
        }

        .success-submessage {
            font-size: 13px;
        }

        .success-btn {
            padding: 10px 15px;
            font-size: 13px;
        }

        .logout-popup {
            width: 98%;
        }

        .logout-popup-header {
            padding: 12px 15px;
        }

        .logout-popup-title {
            font-size: 15px;
        }

        .logout-popup-body {
            padding: 15px;
        }

        .logout-popup-actions {
            padding: 12px 15px 15px;
        }

        .logout-popup-btn {
            padding: 8px;
            font-size: 13px;
        }
    }

    .hidden {
        display: none !important;
    }

/* Modal Styles */
.modal {
    display: none;
    position: fixed !important;
    z-index: 999999 !important;
    left: 0 !important;
    top: 0 !important;
    width: 100% !important;
    height: 100% !important;
    background-color: rgba(0, 0, 0, 0.75) !important;
    justify-content: center !important;
    align-items: center !important;
    overflow-y: auto !important;
}

    .modal-content {
        background: white;
        border-radius: 12px;
        max-width: 600px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        position: relative;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .modal-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 28px;
        cursor: pointer;
        color: #666;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-btn:hover {
        color: #000;
    }

    .modal-body {
        padding: 20px;
    }

    .detail-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .detail-price {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .detail-info {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        font-size: 16px;
        color: #666;
    }

    .detail-features {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .detail-feature {
        padding: 8px 16px;
        background: #f5f5f5;
        border-radius: 8px;
        font-size: 14px;
        color: #666;
    }

    /* Booking Form Styles */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #1a1a1a;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #000;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
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

    /* Success Modal Styles */
    .success-modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.7);
        backdrop-filter: blur(8px);
        z-index: 1200;
        justify-content: center;
        align-items: center;
        animation: fadeIn 0.4s ease-out;
    }

    .success-modal {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        border: 1px solid #e0e0e0;
        max-width: 450px;
        width: 90%;
        animation: successSlideIn 0.5s ease-out;
        transform: scale(0.8);
        transition: transform 0.3s ease-out;
    }

    .success-modal.show {
        transform: scale(1);
    }

    .success-modal-header {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        padding: 30px 40px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .success-modal-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: shimmer 2s infinite;
    }

    .success-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        position: relative;
        z-index: 2;
        animation: checkmarkBounce 0.6s ease-out 0.3s both;
    }

    .success-modal-title {
        color: white;
        font-weight: 700;
        font-size: 28px;
        margin: 0;
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .success-modal-body {
        padding: 40px;
        text-align: center;
    }

    .success-message {
        font-size: 18px;
        color: #1a1a1a;
        margin-bottom: 8px;
        font-weight: 600;
        line-height: 1.4;
    }

    .success-submessage {
        font-size: 16px;
        color: #666;
        margin-bottom: 30px;
        line-height: 1.5;
    }

    .success-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .success-btn {
        padding: 14px 30px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid;
        text-decoration: none;
        display: inline-block;
    }

    .success-btn-primary {
        background: #28a745;
        border-color: #28a745;
        color: white;
    }

    .success-btn-primary:hover {
        background: #218838;
        border-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
    }

    .success-btn-secondary {
        background: white;
        border-color: #e0e0e0;
        color: #666;
    }

    .success-btn-secondary:hover {
        background: #f8f9fa;
        border-color: #ccc;
        color: #333;
        transform: translateY(-2px);
    }

    @keyframes successSlideIn {
        from {
            opacity: 0;
            transform: scale(0.8) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes checkmarkBounce {
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

        <button class="mobile-menu-toggle" onclick="toggleMobileMenu()" aria-label="Toggle mobile menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div>
    <div class="mobile-menu">
        <button class="mobile-menu-close" onclick="toggleMobileMenu()" aria-label="Close mobile menu">&times;</button>
        <ul class="mobile-menu-list">
            <li class="mobile-menu-item"><a href="{{ route('home') }}" class="mobile-menu-link">Beranda</a></li>
            <li class="mobile-menu-item"><a href="{{ route('rooms') }}" class="mobile-menu-link active">Kamar</a></li>
            <li class="mobile-menu-item"><a href="{{ route('fasilitas') }}" class="mobile-menu-link">Fasilitas</a></li>
            <li class="mobile-menu-item"><a href="{{ route('location') }}" class="mobile-menu-link">Lokasi</a></li>
            <li class="mobile-menu-item"><a href="{{ route('contact') }}" class="mobile-menu-link">Kontak</a></li>
            <li class="mobile-menu-item"><a href="{{ route('payments.index') }}" class="mobile-menu-link">Pembayaran</a></li>
        </ul>
        <div class="mobile-menu-actions">
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
    </div>


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
@endif

<script>
    function toggleMobileMenu() {
        const overlay = document.querySelector('.mobile-menu-overlay');
        const menu = document.querySelector('.mobile-menu');
        const body = document.body;

        if (overlay && menu) {
            const isOpen = overlay.style.display === 'block';

            if (isOpen) {
                // Close menu
                overlay.style.display = 'none';
                menu.classList.remove('show');
                body.style.overflow = '';
            } else {
                // Open menu
                overlay.style.display = 'block';
                menu.classList.add('show');
                body.style.overflow = 'hidden';
            }
        }
    }

    // Close mobile menu when clicking overlay
    document.addEventListener('click', function(e) {
        const overlay = document.querySelector('.mobile-menu-overlay');
        const menu = document.querySelector('.mobile-menu');
        const toggle = document.querySelector('.mobile-menu-toggle');

        if (overlay && e.target === overlay) {
            overlay.style.display = 'none';
            menu.classList.remove('show');
            document.body.style.overflow = '';
        }
    });

    // Close mobile menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const overlay = document.querySelector('.mobile-menu-overlay');
            const menu = document.querySelector('.mobile-menu');

            if (overlay && overlay.style.display === 'block') {
                overlay.style.display = 'none';
                menu.classList.remove('show');
                document.body.style.overflow = '';
            }
        }
    });
</script>

<!-- Main Content -->
<div class="container">
    <!-- Search Bar -->
    <div class="search-container">
        <div class="search-input-wrapper">
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            <input type="text" id="searchInput" placeholder="Cari jenis kamar...">
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <button class="tab-btn active" data-filter="all">Semua</button>
        <button class="tab-btn" data-filter="available">Tersedia</button>
        <button class="tab-btn" data-filter="popular">Populer</button>
    </div>

    <!-- Rooms Grid -->
    <div class="rooms-grid">
        @foreach($rooms as $room)
            <div class="room-card" data-status="{{ $room->is_available ? 'available' : 'unavailable' }}" data-type="{{ $room->display_type }}" data-popular="{{ $room->is_popular && $room->is_available ? 'true' : 'false' }}">
                <div class="room-image">
<img src="{{ $room->imageUrl ?: 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=600' }}" alt="{{ $room->display_type }}">
                    @if($room->is_popular && $room->is_available)
                        <div class="popular-badge">⭐ Populer</div>
                    @endif
                    @if(!$room->is_available)
                        <div class="unavailable-badge">Tidak Tersedia</div>
                    @endif
                    <button class="favorite-btn">♡</button>
                </div>
                <div class="room-content">
                    <div class="room-header">
                        <h3 class="room-title">{{ $room->display_type }}</h3>
                        <div class="room-price">
                            <div class="price-amount">Rp {{ number_format($room->price / 1000, 0) }}rb</div>
                            <div class="price-period">/bulan</div>
                        </div>
                    </div>
                    <div class="room-info">
                        <span>{{ $room->size }}</span>
                        <span>•</span>
                        <span>{{ $room->capacity }} orang</span>
                    </div>
                    <div class="room-features">
                        @php
                            $facilities = is_array($room->facilities) ? $room->facilities : json_decode($room->facilities, true) ?? [];
                        @endphp
                        @foreach(array_slice($facilities, 0, 4) as $facility)
                            <span class="feature-tag">{{ $facility }}</span>
                        @endforeach
                        @if(count($facilities) > 4)
                            <span class="feature-tag">🏷️ +{{ count($facilities) - 4 }} lagi</span>
                        @endif
                    </div>
                    <div class="room-actions">
                        <button 
                            class="btn-detail" 
                            data-title="{{ $room->display_type }}"
                            data-image="{{ $room->image ? asset('storage/' . $room->image) : 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=600' }}"
                            data-price="Rp {{ number_format($room->price / 1000, 0) }}rb"
                            data-size="{{ $room->size }}"
                            data-capacity="{{ $room->capacity }} orang"
                            data-features='@json($facilities)'
                            data-roomtype="{{ $room->display_type }}"
                        >Detail Kamar</button>
                        @if(!Auth::user() || !Auth::user()->is_admin)
                        <button class="btn-booking" onclick="openBookingModal('{{ $room->display_type }}')" {{ !$room->is_available ? 'disabled' : '' }}>{{ $room->is_available ? 'Booking Sekarang' : 'Tidak Tersedia' }}</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

<script>
    // Store booked dates for current booking modal room type
    let bookedDates = [];

    function openBookingModal(roomType) {
        fetch(`/api/booked-dates?room_type=${encodeURIComponent(roomType)}`)
            .then(response => response.json())
            .then(data => {
                bookedDates = data.booked_dates || [];
                // Initialize booking modal elements
                showBookingModal(roomType);
            })
            .catch(error => {
                console.error('Error fetching booked dates:', error);
                // fallback show modal anyway
                showBookingModal(roomType);
            });
    }

    function showBookingModal(roomType) {
        const bookingModal = document.getElementById('bookingModal');
        if (!bookingModal) return;

        // Reset form and errors
        const form = bookingModal.querySelector('#bookingForm');
        form.reset();
        clearBookingErrors();

        // Set hidden room_type input
        const roomTypeInput = form.querySelector('input[name="room_type"]');
        if (roomTypeInput) {
            roomTypeInput.value = roomType;
        }

        // Disable booked dates in check-in and check-out inputs
        setupDateInputs();

        bookingModal.style.display = 'flex';
    }

    function setupDateInputs() {
        const checkInInput = document.querySelector('#bookingForm input[name="check_in_date"]');
        const checkOutInput = document.querySelector('#bookingForm input[name="check_out_date"]');

        if (!checkInInput || !checkOutInput) return;

        // Remove any existing min/max and event listener for clarity
        checkInInput.removeAttribute('min');
        checkOutInput.removeAttribute('min');
        checkInInput.removeAttribute('max');
        checkOutInput.removeAttribute('max');

        // Function to disable booked dates on change and on initial
        function disableBookedDatesOnInput() {
            const checkInDate = new Date(checkInInput.value);
            const checkOutDate = new Date(checkOutInput.value);
            const today = new Date();
            today.setHours(0,0,0,0);

            // Set min for checkInInput to today + 1 day
            const minCheckInDate = new Date(today.getTime() + 24*60*60*1000);
            checkInInput.min = minCheckInDate.toISOString().split('T')[0];

            // Set min for checkOutInput to day after checkInInput
            if (checkInInput.value) {
                const minCheckOutDate = new Date(checkInDate.getTime() + 24*60*60*1000);
                checkOutInput.min = minCheckOutDate.toISOString().split('T')[0];
            } else {
                checkOutInput.min = '';
            }

            // Optionally: Add checks for if check-out is before check-in reset it
            if (checkOutInput.value && checkInInput.value && checkOutDate <= checkInDate) {
                checkOutInput.value = '';
            }
        }

        // Attach event listeners
        checkInInput.addEventListener('change', disableBookedDatesOnInput);
        checkOutInput.addEventListener('change', disableBookedDatesOnInput);

        disableBookedDatesOnInput();

        // Additional code to gray out disabled dates in browser's native datepicker is limited,
        // so you may consider using a JS date picker library for better UI/disable of booked dates.
        // Otherwise, validate on submit if dates are overlapping too.
    }

    function clearBookingErrors() {
        const errorElems = document.querySelectorAll('.booking-error');
        errorElems.forEach(elem => elem.textContent = '');
    }

    // Booking form submission with error handling for overlap
    const bookingForm = document.getElementById('bookingForm');
    if (bookingForm) {
        bookingForm.addEventListener('submit', function(event) {
            event.preventDefault();

            clearBookingErrors();

            const formData = new FormData(bookingForm);
            fetch(bookingForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => { throw data; });
                }
                return response.json();
            })
            .then(data => {
                alert(data.message || 'Booking berhasil dibuat!');
                closeBookingModal();
                // Optional: reload page or update UI
                location.reload();
            })
            .catch(errorData => {
                if(errorData && errorData.errors) {
                    Object.entries(errorData.errors).forEach(([key, messages]) => {
                        const errorElem = document.querySelector(`.booking-error.${key}`);
                        if(errorElem) {
                            errorElem.textContent = messages.join(', ');
                        }
                    });
                } else if(errorData && errorData.message) {
                    alert(errorData.message);
                } else {
                    alert('Terjadi kesalahan saat melakukan booking.');
                }
            });
        });
    }

    function closeBookingModal() {
        const bookingModal = document.getElementById('bookingModal');
        if (bookingModal) {
            bookingModal.style.display = 'none';
        }
    }
</script>
    </div>
</div>

<style>
.booking-error {
    color: #dc3545;
    font-weight: 600;
    margin-bottom: 15px;
}
</style>

<script>
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const filterBtns = document.querySelectorAll('.tab-btn');
    const roomCards = document.querySelectorAll('.room-card');

    // Function to filter rooms based on search and filter
    function filterRooms() {
        const searchTerm = searchInput.value.toLowerCase();
        const activeFilter = document.querySelector('.tab-btn.active').dataset.filter;

        roomCards.forEach(card => {
            const roomType = card.dataset.type.toLowerCase();
            const roomStatus = card.dataset.status;
            const isPopular = card.dataset.popular === 'true';

            // Check search match
            const matchesSearch = roomType.includes(searchTerm);

            // Check filter match
            let matchesFilter = false;
            if (activeFilter === 'all') {
                matchesFilter = true;
            } else if (activeFilter === 'available') {
                matchesFilter = roomStatus.includes('available');
            } else if (activeFilter === 'popular') {
                matchesFilter = isPopular;
            }

            // Show card if it matches both search and filter
            if (matchesSearch && matchesFilter) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Search input event listener
    searchInput.addEventListener('input', filterRooms);

    // Filter button functionality
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            btn.classList.add('active');

            // Apply filtering
            filterRooms();
        });
    });

    // Favorite button functionality
    const favBtns = document.querySelectorAll('.favorite-btn');
    favBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            btn.textContent = btn.textContent === '♡' ? '♥' : '♡';
            btn.style.color = btn.textContent === '♥' ? '#dc3545' : '#000';
        });
    });

    // Bind event listeners for Detail Kamar buttons
    document.addEventListener('DOMContentLoaded', function() {
        const detailButtons = document.querySelectorAll('.btn-detail');
        detailButtons.forEach(button => {
            button.addEventListener('click', function() {
                const title = button.getAttribute('data-title');
                const image = button.getAttribute('data-image');
                const price = button.getAttribute('data-price');
                const size = button.getAttribute('data-size');
                const capacity = button.getAttribute('data-capacity');
                const features = JSON.parse(button.getAttribute('data-features'));
                const roomType = button.getAttribute('data-roomtype');
                openDetailModal(title, image, price, size, capacity, features, roomType);
            });
        });
    });

    function openDetailModal(title, image, price, size, capacity, features, roomType) {
        console.log("openDetailModal called with:", title, image, price, size, capacity, features, roomType);
        const modal = document.getElementById('detailModal');
        if (!modal) {
            console.error("Modal element with id 'detailModal' not found!");
            return;
        }
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalImage').src = image;
        document.getElementById('modalPrice').textContent = price;
        document.getElementById('modalSize').textContent = size;
        document.getElementById('modalCapacity').textContent = capacity;

        const featuresContainer = document.getElementById('modalFeatures');
        featuresContainer.innerHTML = '';
        features.forEach(feature => {
            const featureDiv = document.createElement('div');
            featureDiv.className = 'detail-feature';
            featureDiv.textContent = feature;
            featuresContainer.appendChild(featureDiv);
        });

    const bookingBtn = document.getElementById('modalBookingBtn');
    if(bookingBtn) {
        bookingBtn.setAttribute('onclick', `openBookingModalFromDetail('${roomType}')`);
    }

        // Force show modal
        modal.style.display = 'flex';
        modal.style.opacity = '1';
        modal.style.visibility = 'visible';
    }

    function closeModal() {
        document.getElementById('detailModal').style.display = 'none';
    }

function openBookingModal(roomType) {
        // Create booking modal
        const modal = document.createElement('div');
        modal.className = 'modal';
        modal.id = 'bookingModal';
        modal.innerHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Booking ${roomType}</h2>
                    <button class="close-btn" onclick="closeBookingModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="bookingForm" method="POST">
                        @csrf
                        <input type="hidden" name="room_type" value="${roomType}">

                        <div class="form-group">
                            <label for="check_in_date">Tanggal Check-in</label>
                            <input type="date" id="check_in_date" name="check_in_date" required
                                   min="${new Date().toISOString().split('T')[0]}">
                        </div>

                        <div class="form-group">
                            <label for="check_out_date">Tanggal Check-out</label>
                            <input type="date" id="check_out_date" name="check_out_date" required>
                        </div>

                        <div class="form-group">
                            <label for="payment_method">Metode Pembayaran</label>
                            <select id="payment_method" name="payment_method" required onchange="showPaymentInfo()">
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="transfer_bank">Transfer Bank</option>
                                <option value="e_wallet">E-Wallet (GoPay, OVO, Dana)</option>
                                <option value="cash">Tunai</option>
                            </select>
                        </div>

                        <div id="paymentInfo" class="payment-info-section" style="display: none;">
                            <div id="bankInfo" style="display: none;">
                                <h4 style="color: #1a1a1a; margin-bottom: 15px;">Informasi Rekening Bank</h4>
                                <div class="bank-accounts">
                                    <div class="bank-account">
                                        <strong>BCA</strong><br>
                                        No. Rekening: 1234567890<br>
                                        Atas Nama: PT. Lagita Kost<br>
                                        Cabang: Jakarta Pusat
                                    </div>
                                    <div class="bank-account" style="margin-top: 15px;">
                                        <strong>Mandiri</strong><br>
                                        No. Rekening: 0987654321<br>
                                        Atas Nama: PT. Lagita Kost<br>
                                        Cabang: Jakarta Pusat
                                    </div>
                                    <div class="bank-account" style="margin-top: 15px;">
                                        <strong>BNI</strong><br>
                                        No. Rekening: 1122334455<br>
                                        Atas Nama: PT. Lagita Kost<br>
                                        Cabang: Jakarta Pusat
                                    </div>
                                </div>
                                <p style="color: #666; font-size: 14px; margin-top: 15px;">
                                    <strong>Catatan:</strong> Setelah transfer, silakan upload bukti pembayaran di halaman Pembayaran untuk konfirmasi.
                                </p>
                            </div>
                            <div id="ewalletInfo" style="display: none;">
                                <h4 style="color: #1a1a1a; margin-bottom: 15px;">Informasi E-Wallet</h4>
                                <div class="ewallet-accounts">
                                    <div class="ewallet-account">
                                        <strong>GoPay</strong><br>
                                        Nomor: 0877-6100-1778<br>
                                        Atas Nama: Lagita Kost
                                    </div>
                                    <div class="ewallet-account" style="margin-top: 15px;">
                                        <strong>OVO</strong><br>
                                        Nomor: 0877-6100-1778<br>
                                        Atas Nama: Lagita Kost
                                    </div>
                                    <div class="ewallet-account" style="margin-top: 15px;">
                                        <strong>Dana</strong><br>
                                        Nomor: 0877-6100-1778<br>
                                        Atas Nama: Lagita Kost
                                    </div>
                                </div>
                                <p style="color: #666; font-size: 14px; margin-top: 15px;">
                                    <strong>Catatan:</strong> Setelah transfer, silakan upload bukti pembayaran di halaman Pembayaran untuk konfirmasi.
                                </p>
                            </div>
                            <div id="cashInfo" style="display: none;">
                                <h4 style="color: #1a1a1a; margin-bottom: 15px;">Pembayaran Tunai</h4>
                                <p style="color: #666; margin-bottom: 15px;">
                                    Anda dapat melakukan pembayaran tunai langsung ke lokasi kost setelah booking dikonfirmasi oleh admin.
                                </p>
                                <p style="color: #666; font-size: 14px;">
                                    <strong>Catatan:</strong> Admin akan menghubungi Anda untuk konfirmasi pembayaran tunai.
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="notes">Catatan Tambahan (Opsional)</label>
                            <textarea id="notes" name="notes" rows="3" placeholder="Tambahkan catatan khusus..."></textarea>
                        </div>

                        <div id="bookingError" class="booking-error" style="color: red; margin-bottom: 15px; display: none;"></div>

                        <div class="form-actions">
                            <button type="button" class="btn-detail" onclick="closeBookingModal()">Batal</button>
                            <button type="submit" class="btn-booking">Konfirmasi Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        `;

        document.body.appendChild(modal);
        modal.style.display = 'flex';

        // Set minimum check-out date to be after check-in
        document.getElementById('check_in_date').addEventListener('change', function() {
            document.getElementById('check_out_date').min = this.value;
        });

        // Handle form submission
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            submitBooking();
        });
    }
    
    function openBookingModalFromDetail(roomType) {
        closeModal();
        openBookingModal(roomType);
    }

    function closeBookingModal() {
        const modal = document.getElementById('bookingModal');
        if (modal) {
            modal.remove();
        }
    }

    function showPaymentInfo() {
        const paymentMethod = document.getElementById('payment_method').value;
        const paymentInfo = document.getElementById('paymentInfo');
        const bankInfo = document.getElementById('bankInfo');
        const ewalletInfo = document.getElementById('ewalletInfo');
        const cashInfo = document.getElementById('cashInfo');

        // Hide all payment info sections
        bankInfo.style.display = 'none';
        ewalletInfo.style.display = 'none';
        cashInfo.style.display = 'none';

        if (paymentMethod === 'transfer_bank') {
            bankInfo.style.display = 'block';
            paymentInfo.style.display = 'block';
        } else if (paymentMethod === 'e_wallet') {
            ewalletInfo.style.display = 'block';
            paymentInfo.style.display = 'block';
        } else if (paymentMethod === 'cash') {
            cashInfo.style.display = 'block';
            paymentInfo.style.display = 'block';
        } else {
            paymentInfo.style.display = 'none';
        }
    }

    function submitBooking() {
        const form = document.getElementById('bookingForm');
        const submitBtn = form.querySelector('.btn-booking');
        const originalText = submitBtn.textContent;

        // Disable button and show loading
        submitBtn.disabled = true;
        submitBtn.textContent = 'Memproses...';

        const formData = new FormData(form);

        fetch('{{ route("booking.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            const bookingErrorDiv = document.getElementById('bookingError');
            if (bookingErrorDiv) bookingErrorDiv.style.display = 'none';
            if (data.success) {
                closeBookingModal();
                Swal.fire({
                    title: 'Berhasil Booking!',
                    text: 'Anda berhasil booking! Silahkan klik "Hubungi Admin" untuk bukti pembayaran.',
                    icon: 'success',
                    confirmButtonText: 'Hubungi Admin',
                    showCancelButton: true,
                    cancelButtonText: 'Tutup',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open('https://wa.me/6287761001778?text=Halo%20Admin%20Lagita%20Kost,%20saya%20ingin%20upload%20bukti%20pembayaran%20untuk%20booking%20kamar', '_blank');
                    }
                });
            } else {
                // Handle validation errors or other errors
                let errorMessages = '';
                if (data.errors) {
                    errorMessages = Object.values(data.errors).join('<br>');
                } else {
                    errorMessages = data.message || 'Terjadi kesalahan yang tidak diketahui.';
                }

                if (bookingErrorDiv) {
                    bookingErrorDiv.innerHTML = errorMessages;
                    bookingErrorDiv.style.display = 'block';
                } else {
                    Swal.fire({
                        title: 'Gagal Booking',
                        text: errorMessages.replace(/<br>/g, '\\n'),
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const bookingErrorDiv = document.getElementById('bookingError');
            if (bookingErrorDiv) {
                bookingErrorDiv.innerHTML = 'Terjadi kesalahan saat melakukan booking.';
                bookingErrorDiv.style.display = 'block';
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Terjadi kesalahan saat melakukan booking.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .finally(() => {
            // Re-enable button
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        });
    }

    // Logout popup functions
    function showLogoutPopup() {
        document.getElementById('logoutPopup').style.display = 'flex';
    }

    function hideLogoutPopup() {
        document.getElementById('logoutPopup').style.display = 'none';
    }

    // Close modal/popup when clicking outside
    window.onclick = function(event) {
        const detailModal = document.getElementById('detailModal');
        if (event.target == detailModal) {
            detailModal.style.display = 'none';
        }

        const bookingModal = document.getElementById('bookingModal');
        if (event.target == bookingModal) {
            closeBookingModal();
        }

        const logoutPopup = document.getElementById('logoutPopup');
        if (event.target === logoutPopup) {
            hideLogoutPopup();
        }
    }
</script>

<!-- Detail Modal -->
<div id="detailModal" class="modal" style="border: 3px solid red; background-color: rgba(0, 0, 0, 0.85) !important; z-index: 1000000 !important;">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle" class="modal-title">Detail Kamar</h2>
            <button class="close-btn" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <img id="modalImage" class="detail-image" src="" alt="Room Image">
            <div id="modalPrice" class="detail-price">Rp 0rb</div>
            <div class="detail-info">
                <span id="modalSize">0 m²</span>
                <span>•</span>
                <span id="modalCapacity">0 orang</span>
            </div>
            <div class="detail-features">
                <h4 style="margin-bottom: 10px; color: #1a1a1a;">Fasilitas Kamar:</h4>
                <div id="modalFeatures"></div>
            </div>
            <div class="form-actions">
                <button class="btn-detail" onclick="closeModal()">Tutup</button>
                @if(!Auth::user() || !Auth::user()->is_admin)
                <button id="modalBookingBtn" class="btn-booking" onclick="openBookingModalFromDetail('')">Booking Sekarang</button>
                @endif
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
    // Logout popup event listener for clicking outside
    document.getElementById('logoutPopup').addEventListener('click', function(e) {
        if (e.target === this) {
            hideLogoutPopup();
        }
    });

    // Success Modal Functions
    function showSuccessModal() {
        document.getElementById('successModalOverlay').style.display = 'flex';
        document.getElementById('successModal').classList.add('show');
    }

    function closeSuccessModal() {
        document.getElementById('successModalOverlay').style.display = 'none';
        document.getElementById('successModal').classList.remove('show');
    }

    function contactAdmin() {
        window.open('https://wa.me/6287761001778?text=Halo%20Admin%20Lagita%20Kost,%20saya%20ingin%20kirim%20bukti%20pembayaran%20untuk%20booking%20kamar', '_blank');
    }
</script>

<!-- Success Modal -->
<div id="successModalOverlay" class="success-modal-overlay">
    <div class="success-modal" id="successModal">
        <div class="success-modal-header">
            <div class="success-icon">✓</div>
            <h2 class="success-modal-title">Booking Berhasil!</h2>
        </div>
        <div class="success-modal-body">
            <div class="success-message">Anda berhasil booking!</div>
            <div class="success-submessage">Silahkan klik "Hubungi Admin" untuk kirim bukti pembayaran.</div>
            <div class="success-actions">
                <button type="button" class="success-btn success-btn-secondary" onclick="contactAdmin()">Hubungi Admin</button>
                <button type="button" class="success-btn success-btn-primary" onclick="closeSuccessModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection
