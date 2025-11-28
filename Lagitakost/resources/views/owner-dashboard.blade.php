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

    /* Owner Dashboard Styles */
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 80px;
    }

    .dashboard-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .dashboard-title {
        font-size: 36px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .dashboard-subtitle {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 40px;
        margin-bottom: 50px;
    }

    .room-management-section {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        margin-bottom: 30px;
    }

    .room-management-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .room-management-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .room-types-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    .room-type-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #e9ecef;
        transition: all 0.3s;
    }

    .room-type-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .room-type-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .room-type-name {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .room-type-price {
        font-size: 14px;
        color: #666;
        font-weight: 600;
    }

    .room-type-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }

    .room-type-stat {
        text-align: center;
        padding: 10px;
        background: white;
        border-radius: 8px;
    }

    .room-type-stat .stat-number {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        display: block;
        margin-bottom: 2px;
    }

    .room-type-stat .stat-label {
        font-size: 11px;
        color: #666;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .room-type-actions {
        display: flex;
        gap: 10px;
    }

    .view-rooms-btn,
    .add-room-type-btn {
        flex: 1;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.3s;
    }

    .view-rooms-btn {
        background: #1a1a1a;
        color: white;
    }

    .view-rooms-btn:hover {
        background: #333;
        transform: translateY(-1px);
    }

    .add-room-type-btn {
        background: #28a745;
        color: white;
    }

    .add-room-type-btn:hover {
        background: #218838;
        transform: translateY(-1px);
    }

    .main-content {
        display: grid;
        gap: 30px;
    }

    .content-card {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .card-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 25px;
    }

    .card-title {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .card-subtitle {
        font-size: 14px;
        color: #666;
        margin: 5px 0 0 0;
    }

    .view-all-btn {
        background: #f8f9fa;
        color: #1a1a1a;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
    }

    .view-all-btn:hover {
        background: #e9ecef;
    }

    .recent-activity {
        margin-bottom: 30px;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.3s;
    }

    .activity-item:hover {
        background: #f8f9fa;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 45px;
        height: 45px;
        background: #e3f2fd;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1976d2;
        flex-shrink: 0;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-size: 16px;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 3px;
    }

    .activity-description {
        font-size: 14px;
        color: #666;
        margin-bottom: 3px;
    }

    .activity-time {
        font-size: 12px;
        color: #999;
    }

    .sidebar {
        display: grid;
        gap: 30px;
    }

    .quick-actions {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .quick-actions h3 {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 20px;
    }

    .action-btn {
        width: 100%;
        padding: 15px 20px;
        background: #1a1a1a;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .action-btn:hover {
        background: #333;
        transform: translateY(-2px);
    }

    .action-btn.secondary {
        background: white;
        color: #1a1a1a;
        border: 2px solid #e0e0e0;
    }

    .action-btn.secondary:hover {
        background: #f8f9fa;
        border-color: #1a1a1a;
    }

    .system-status {
        background: white;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }

    .system-status h3 {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 20px;
    }

    .status-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .status-item:last-child {
        border-bottom: none;
    }

    .status-label {
        font-size: 15px;
        color: #333;
        font-weight: 500;
    }

    .status-indicator {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .status-dot.online {
        background: #22c55e;
    }

    .status-dot.offline {
        background: #ef4444;
    }

    .status-text {
        font-size: 14px;
        font-weight: 500;
    }

    .status-text.online {
        color: #22c55e;
    }

    .status-text.offline {
        color: #ef4444;
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

        .dashboard-container {
            padding: 25px 20px;
        }

        .dashboard-header {
            margin-bottom: 30px;
        }

        .dashboard-title {
            font-size: 28px;
        }

        .dashboard-subtitle {
            font-size: 16px;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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

        .dashboard-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .room-management-section {
            padding: 20px;
        }

        .room-management-title {
            font-size: 18px;
        }

        .room-types-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 15px;
        }

        .room-type-card {
            padding: 18px;
        }

        .room-type-name {
            font-size: 16px;
        }

        .room-type-price {
            font-size: 13px;
        }

        .room-type-stats {
            gap: 12px;
        }

        .room-type-stat .stat-number {
            font-size: 18px;
        }

        .room-type-stat .stat-label {
            font-size: 10px;
        }

        .view-rooms-btn,
        .add-room-type-btn {
            padding: 8px 12px;
            font-size: 12px;
        }

        .content-card {
            padding: 20px;
        }

        .card-title {
            font-size: 20px;
        }

        .card-subtitle {
            font-size: 14px;
        }

        .activity-item {
            padding: 15px;
            gap: 12px;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
        }

        .activity-title {
            font-size: 15px;
        }

        .activity-description {
            font-size: 13px;
        }

        .activity-time {
            font-size: 11px;
        }

        .quick-actions {
            padding: 20px;
        }

        .quick-actions h3 {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .action-btn {
            padding: 12px 15px;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .system-status {
            padding: 20px;
        }

        .system-status h3 {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .status-item {
            padding: 12px 0;
        }

        .status-label {
            font-size: 14px;
        }

        .status-text {
            font-size: 13px;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 20px 15px;
        }

        .dashboard-header {
            margin-bottom: 30px;
        }

        .dashboard-title {
            font-size: 28px;
        }

        .dashboard-subtitle {
            font-size: 14px;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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

        .room-management-section {
            padding: 20px;
            margin-bottom: 20px;
        }

        .room-management-title {
            font-size: 18px;
        }

        .room-types-grid {
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .room-type-card {
            padding: 15px;
        }

        .room-type-name {
            font-size: 16px;
        }

        .room-type-price {
            font-size: 13px;
        }

        .room-type-stats {
            gap: 12px;
            margin-bottom: 15px;
        }

        .room-type-stat .stat-number {
            font-size: 18px;
        }

        .room-type-stat .stat-label {
            font-size: 10px;
        }

        .view-rooms-btn,
        .add-room-type-btn {
            padding: 8px 12px;
            font-size: 12px;
        }

        .content-card {
            padding: 20px;
        }

        .card-title {
            font-size: 20px;
        }

        .card-subtitle {
            font-size: 13px;
        }

        .activity-item {
            padding: 15px;
            gap: 12px;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
        }

        .activity-title {
            font-size: 15px;
        }

        .activity-description {
            font-size: 13px;
        }

        .activity-time {
            font-size: 11px;
        }

        .quick-actions {
            padding: 20px;
        }

        .quick-actions h3 {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .action-btn {
            padding: 12px 15px;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .system-status {
            padding: 20px;
        }

        .system-status h3 {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .status-item {
            padding: 12px 0;
        }

        .status-label {
            font-size: 14px;
        }

        .status-text {
            font-size: 13px;
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
        .dashboard-container {
            padding: 15px 10px;
        }

        .dashboard-header {
            margin-bottom: 25px;
        }

        .dashboard-title {
            font-size: 24px;
        }

        .dashboard-subtitle {
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

        .room-management-section {
            padding: 15px;
            margin-bottom: 15px;
        }

        .room-management-header {
            margin-bottom: 20px;
        }

        .room-management-title {
            font-size: 16px;
        }

        .add-room-btn {
            padding: 8px 16px;
            font-size: 13px;
        }

        .room-types-grid {
            grid-template-columns: 1fr;
            gap: 12px;
            margin-bottom: 15px;
        }

        .room-type-card {
            padding: 12px;
        }

        .room-type-header {
            margin-bottom: 12px;
        }

        .room-type-name {
            font-size: 15px;
        }

        .room-type-price {
            font-size: 12px;
        }

        .room-type-stats {
            gap: 10px;
            margin-bottom: 12px;
        }

        .room-type-stat {
            padding: 8px;
        }

        .room-type-stat .stat-number {
            font-size: 16px;
        }

        .room-type-stat .stat-label {
            font-size: 9px;
        }

        .room-type-actions {
            gap: 8px;
        }

        .view-rooms-btn,
        .add-room-type-btn {
            padding: 6px 10px;
            font-size: 11px;
        }

        .main-content {
            gap: 20px;
        }

        .content-card {
            padding: 15px;
        }

        .card-header {
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 18px;
        }

        .card-subtitle {
            font-size: 12px;
        }

        .view-all-btn {
            padding: 6px 12px;
            font-size: 12px;
        }

        .activity-item {
            padding: 12px;
            gap: 10px;
        }

        .activity-icon {
            width: 35px;
            height: 35px;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-size: 14px;
        }

        .activity-description {
            font-size: 12px;
        }

        .activity-time {
            font-size: 10px;
        }

        .sidebar {
            gap: 20px;
        }

        .quick-actions {
            padding: 15px;
        }

        .quick-actions h3 {
            font-size: 15px;
            margin-bottom: 12px;
        }

        .action-btn {
            padding: 10px 12px;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .system-status {
            padding: 15px;
        }

        .system-status h3 {
            font-size: 15px;
            margin-bottom: 12px;
        }

        .status-item {
            padding: 10px 0;
        }

        .status-label {
            font-size: 13px;
        }

        .status-text {
            font-size: 12px;
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
            <span class="brand-tagline">Owner Dashboard</span>
        </div>
    </a>



    <div class="navbar-actions">
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
                <div class="brand-tagline">Owner Dashboard</div>
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

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1 class="dashboard-title">Selamat Datang, {{ auth()->user()->name }}!</h1>
        <p class="dashboard-subtitle">
            Kelola kost Anda dengan mudah dan efisien dari dashboard owner
        </p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 21V3a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v18a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <path d="M9 7h6"></path>
                    <path d="M9 11h6"></path>
                    <path d="M9 15h4"></path>
                </svg>
            </div>
            <div class="stat-number">{{ $totalRooms ?? 0 }}</div>
            <div class="stat-label">Total Kamar</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 2l-1 1"></path>
                    <path d="M22 8l-1-1"></path>
                    <path d="M18 2l1 1"></path>
                    <path d="M18 8l1-1"></path>
                </svg>
            </div>
            <div class="stat-number">{{ $occupiedRooms ?? 0 }}</div>
            <div class="stat-label">Kamar Terisi</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
            </div>
            <div class="stat-number">{{ \App\Models\Booking::whereMonth('created_at', now()->month)->count() }}</div>
            <div class="stat-label">Booking Bulan Ini</div>
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
            <div class="stat-number">{{ $unreadCount ?? 0 }}</div>
            <div class="stat-label">
                <a href="{{ route('contact-messages.index') }}" style="color: inherit; text-decoration: none;">Pesan Masuk</a>
            </div>
        </div>



        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
            </div>
            <div class="stat-number">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
            <div class="stat-label">Pendapatan Bulan Ini</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
            </div>
            <div class="stat-number">{{ $monthlyBookings ?? 0 }}</div>
            <div class="stat-label">Booking Dikonfirmasi</div>
        </div>
    </div>

    <!-- Room Management Section -->
    <div class="room-management-section">
        <div class="room-management-header">
            <h2 class="room-management-title">Kelola Kamar</h2>
            <a href="{{ route('rooms.create') }}" class="add-room-btn" style="padding: 10px 20px; font-size: 14px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14"></path>
                    <path d="M5 12h14"></path>
                </svg>
                Tambah Kamar Baru
            </a>
        </div>

        <div class="room-types-grid">
            @php
                $roomTypes = config('booking.room_types');
            @endphp
            @foreach($roomTypes as $type => $price)
            <div class="room-type-card">
                <div class="room-type-header">
                    <h3 class="room-type-name">{{ $type }}</h3>
                    <span class="room-type-price">Rp {{ number_format($price, 0, ',', '.') }}/bulan</span>
                </div>
                <div class="room-type-stats">
                    <div class="room-type-stat">
                        <span class="stat-number">{{ \App\Models\Room::where('type', $type)->count() }}</span>
                        <span class="stat-label">Total</span>
                    </div>
                    <div class="room-type-stat">
                        <span class="stat-number">{{ \App\Models\Room::where('type', $type)->where('is_available', true)->count() }}</span>
                        <span class="stat-label">Tersedia</span>
                    </div>
                    <div class="room-type-stat">
                        <span class="stat-number">{{ \App\Models\Room::where('type', $type)->where('is_available', false)->count() }}</span>
                        <span class="stat-label">Terisi</span>
                    </div>
                </div>
                <div class="room-type-actions">
                    <a href="{{ route('rooms.index', ['type' => $type]) }}" class="view-rooms-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 21V3a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v18a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <path d="M9 7h6"></path>
                            <path d="M9 11h6"></path>
                            <path d="M9 15h4"></path>
                        </svg>
                        Lihat Kamar
                    </a>
                    <a href="{{ route('rooms.create', ['type' => $type]) }}" class="add-room-type-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14"></path>
                            <path d="M5 12h14"></path>
                        </svg>
                        Tambah
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('rooms.index') }}" style="background: #f8f9fa; color: #1a1a1a; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 21V3a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v18a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <path d="M9 7h6"></path>
                    <path d="M9 11h6"></path>
                    <path d="M9 15h4"></path>
                </svg>
                Kelola Semua Kamar
            </a>
        </div>
    </div>

    <div class="dashboard-grid">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Recent Activity -->
            <div class="content-card">
                <div class="card-header">
                    <div>
                        <h2 class="card-title">Aktivitas Terbaru</h2>
                        <p class="card-subtitle">Update terkini dari sistem kost</p>
                    </div>
                    <a href="{{ route('activities.index') }}" class="view-all-btn" style="text-decoration: none;">Lihat Semua</a>
                </div>

                <div class="recent-activity">
                    @forelse($recentBookings ?? [] as $booking)
                    <div class="activity-item">
                        <div class="activity-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 21V3a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v18a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <path d="M9 7h6"></path>
                                <path d="M9 11h6"></path>
                                <path d="M9 15h4"></path>
                            </svg>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Booking {{ $booking->room_type }}</div>
                            <div class="activity-description">{{ $booking->user->name }} - Check-in: {{ $booking->check_in_date->format('d/m/Y') }}</div>
                            <div class="activity-time">{{ $booking->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="activity-item">
                        <div class="activity-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M3 21V3a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v18a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <path d="M9 7h6"></path>
                                <path d="M9 11h6"></path>
                                <path d="M9 15h4"></path>
                            </svg>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Belum ada booking</div>
                            <div class="activity-description">Booking kamar akan muncul di sini</div>
                            <div class="activity-time">-</div>
                        </div>
                    </div>
                    @endforelse

                    @forelse($contactMessages ?? [] as $message)
                    <div class="activity-item">
                        <div class="activity-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14,2 14,8 20,8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10,9 9,9 8,9"></polyline>
                            </svg>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">{{ $message->subject }}</div>
                            <div class="activity-description">{{ Str::limit($message->message, 50) }}</div>
                            <div class="activity-time">{{ $message->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="activity-item">
                        <div class="activity-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14,2 14,8 20,8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10,9 9,9 8,9"></polyline>
                            </svg>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Belum ada pesan</div>
                            <div class="activity-description">Pesan dari calon penghuni akan muncul di sini</div>
                            <div class="activity-time">-</div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="content-card">
                <div class="card-header">
                    <div>
                        <h2 class="card-title">Ringkasan Bulan Ini</h2>
                        <p class="card-subtitle">Performa kost bulan Oktober 2025</p>
                    </div>
                </div>

                <div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); margin: 0;">
                    <div class="stat-card" style="padding: 20px; margin: 0;">
                        <div class="stat-number" style="font-size: 32px;">94%</div>
                        <div class="stat-label">Tingkat Hunian</div>
                    </div>
                    <div class="stat-card" style="padding: 20px; margin: 0;">
                        <div class="stat-number" style="font-size: 32px;">4.8</div>
                        <div class="stat-label">Rating Rata-rata</div>
                    </div>
                    <div class="stat-card" style="padding: 20px; margin: 0;">
                        <div class="stat-number" style="font-size: 32px;">98%</div>
                        <div class="stat-label">Kepuasan Pelanggan</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Quick Actions -->
            <div class="quick-actions">
                <h3>Aksi Cepat</h3>
                <a href="{{ route('rooms.create') }}" class="action-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14"></path>
                        <path d="M5 12h14"></path>
                    </svg>
                    Tambah Kamar Baru
                </a>
                <a href="{{ route('rooms.index') }}" class="action-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 21V3a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v18a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <path d="M9 7h6"></path>
                        <path d="M9 11h6"></path>
                        <path d="M9 15h4"></path>
                    </svg>
                    Kelola Kamar
                </a>
                <a href="{{ route('tenants.index') }}" class="action-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 2l-1 1"></path>
                        <path d="M22 8l-1-1"></path>
                        <path d="M18 2l1 1"></path>
                        <path d="M18 8l1-1"></path>
                    </svg>
                    Kelola Penghuni
                </a>
                <a href="{{ route('bookings.index') }}" class="action-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                        <line x1="12" y1="17" x2="12" y2="21"></line>
                    </svg>
                    Booking Kamar Bulan Ini
                </a>
                <a href="{{ route('financial-report') }}" class="action-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 1 0 1.4l-3.77 3.77a6 6 0 0 1-7.94 0L2.3 9.1a1 1 0 0 1 0-1.4l1.6-1.6a1 1 0 0 0 0-1.4l-3.77-3.77a6 6 0 0 1 7.94-7.94l3.76 3.76z"></path>
                    </svg>
                    Laporan Keuangan
                </a>
            </div>

            <!-- System Status -->
            <div class="system-status">
                <h3>Status Sistem</h3>
                <div class="status-item">
                    <span class="status-label">Database</span>
                    <div class="status-indicator">
                        <div class="status-dot online"></div>
                        <span class="status-text online">Online</span>
                    </div>
                </div>
                <div class="status-item">
                    <span class="status-label">Server</span>
                    <div class="status-indicator">
                        <div class="status-dot online"></div>
                        <span class="status-text online">Online</span>
                    </div>
                </div>
                <div class="status-item">
                    <span class="status-label">Email Service</span>
                    <div class="status-indicator">
                        <div class="status-dot online"></div>
                        <span class="status-text online">Online</span>
                    </div>
                </div>
                <div class="status-item">
                    <span class="status-label">Backup System</span>
                    <div class="status-indicator">
                        <div class="status-dot online"></div>
                        <span class="status-text online">Online</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script>
// Mobile Menu Functions
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    const overlay = document.getElementById('mobileMenuOverlay');
    const body = document.body;

    if (menu.classList.contains('active')) {
        closeMobileMenu();
    } else {
        menu.classList.add('active');
        overlay.style.display = 'block';
        body.style.overflow = 'hidden';
    }
}

function closeMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    const overlay = document.getElementById('mobileMenuOverlay');
    const body = document.body;

    menu.classList.remove('active');
    overlay.style.display = 'none';
    body.style.overflow = 'auto';
}

// Close mobile menu on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeMobileMenu();
    }
});

// Close mobile menu when clicking on a menu item
document.querySelectorAll('.mobile-menu-nav a').forEach(link => {
    link.addEventListener('click', closeMobileMenu);
});

function showLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'flex';
}

function hideLogoutPopup() {
    document.getElementById('logoutPopup').style.display = 'none';
}
</script>
