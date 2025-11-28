<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Lagita Kost</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e3f2fd 0%, #f5f9fc 100%);
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .navbar {
            background: white;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo {
            width: 40px;
            height: 40px;
            background: #5b9bd5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo svg {
            width: 24px;
            height: 24px;
            fill: white;
        }

        .brand-name {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .nav-buttons {
            display: flex;
            gap: 15px;
        }

        .nav-btn {
            padding: 10px 28px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            border: none;
        }

        .btn-signin {
            background: white;
            color: #1a1a1a;
            border: 2px solid #e0e0e0;
        }

        .btn-signin:hover {
            border-color: #5b9bd5;
            color: #5b9bd5;
        }

        .btn-signup {
            background: #5b9bd5;
            color: white;
            border: 2px solid #5b9bd5;
        }

        .btn-signup:hover {
            background: #4a8bc2;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            text-align: center;
        }

        .welcome-title {
            font-size: 56px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .welcome-subtitle {
            font-size: 20px;
            color: #666;
            margin-bottom: 50px;
            font-weight: 500;
        }

        .illustration {
            margin-bottom: 50px;
            animation: float 3s ease-in-out infinite;
        }

        .illustration svg {
            width: 400px;
            height: auto;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .cta-button {
            background: #5b9bd5;
            color: white;
            padding: 18px 60px;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(91, 155, 213, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .cta-button:hover {
            background: #4a8bc2;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(91, 155, 213, 0.4);
        }

        @media (max-width: 1200px) {
            .navbar {
                padding: 18px 50px;
            }

            .welcome-title {
                font-size: 50px;
            }

            .illustration svg {
                width: 350px;
            }
        }

        @media (max-width: 968px) {
            .navbar {
                padding: 15px 30px;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
                padding: 15px 20px;
            }

            .logo-section {
                order: 1;
            }

            .nav-buttons {
                order: 2;
                gap: 12px;
            }

            .welcome-title {
                font-size: 42px;
            }

            .welcome-subtitle {
                font-size: 17px;
                margin-bottom: 40px;
            }

            .illustration svg {
                width: 320px;
            }

            .cta-button {
                padding: 16px 50px;
                font-size: 17px;
            }

            .nav-btn {
                padding: 9px 22px;
                font-size: 14px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 12px 15px;
            }

            .logo-section {
                gap: 10px;
            }

            .brand-name {
                font-size: 20px;
            }

            .brand-tagline {
                font-size: 11px;
            }

            .nav-buttons {
                gap: 10px;
            }

            .nav-btn {
                padding: 8px 18px;
                font-size: 13px;
            }

            .main-content {
                padding: 30px 15px;
            }

            .welcome-title {
                font-size: 36px;
                margin-bottom: 12px;
            }

            .welcome-subtitle {
                font-size: 15px;
                margin-bottom: 35px;
            }

            .illustration {
                margin-bottom: 40px;
            }

            .illustration svg {
                width: 280px;
            }

            .cta-button {
                padding: 14px 40px;
                font-size: 16px;
            }
        }

        @media (max-width: 640px) {
            .navbar {
                padding: 10px 12px;
            }

            .logo {
                width: 35px;
                height: 35px;
                font-size: 13px;
            }

            .brand-name {
                font-size: 18px;
            }

            .brand-tagline {
                font-size: 10px;
            }

            .nav-buttons {
                gap: 8px;
            }

            .nav-btn {
                padding: 7px 16px;
                font-size: 12px;
            }

            .main-content {
                padding: 25px 12px;
            }

            .welcome-title {
                font-size: 32px;
                margin-bottom: 10px;
            }

            .welcome-subtitle {
                font-size: 14px;
                margin-bottom: 30px;
            }

            .illustration svg {
                width: 250px;
            }

            .cta-button {
                padding: 12px 35px;
                font-size: 15px;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 8px 10px;
            }

            .logo {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .brand-name {
                font-size: 16px;
            }

            .brand-tagline {
                font-size: 9px;
            }

            .nav-buttons {
                flex-wrap: wrap;
                justify-content: center;
            }

            .nav-btn {
                padding: 6px 14px;
                font-size: 11px;
                min-width: 70px;
            }

            .main-content {
                padding: 20px 10px;
            }

            .welcome-title {
                font-size: 28px;
                margin-bottom: 8px;
            }

            .welcome-subtitle {
                font-size: 13px;
                margin-bottom: 25px;
            }

            .illustration svg {
                width: 220px;
            }

            .cta-button {
                padding: 10px 30px;
                font-size: 14px;
            }
        }

        @media (max-width: 360px) {
            .navbar {
                padding: 6px 8px;
            }

            .logo {
                width: 28px;
                height: 28px;
                font-size: 10px;
            }

            .brand-name {
                font-size: 14px;
            }

            .brand-tagline {
                font-size: 8px;
            }

            .nav-btn {
                padding: 5px 12px;
                font-size: 10px;
                min-width: 60px;
            }

            .main-content {
                padding: 15px 8px;
            }

            .welcome-title {
                font-size: 24px;
            }

            .welcome-subtitle {
                font-size: 12px;
                margin-bottom: 20px;
            }

            .illustration svg {
                width: 180px;
            }

            .cta-button {
                padding: 8px 25px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo-section">
            <div class="logo">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 22V12H15V22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="brand-name">Lagita Kost</div>
        </div>

        <div class="nav-buttons">
            <a href="{{ route('login') }}" class="nav-btn btn-signin">Sign in</a>
            <a href="{{ route('register') }}" class="nav-btn btn-signup">Sign up</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="welcome-title">Welcome to<br>Lagita Kost</h1>
        <p class="welcome-subtitle">Comfort First, Price Friendly</p>

        <a href="{{ route('login') }}" class="cta-button">
                Get Started
        </a>

        <div class="illustration">
            <svg viewBox="0 0 500 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Plant -->
                <ellipse cx="50" cy="340" rx="20" ry="8" fill="#4a8bc2"/>
                <path d="M40 340 Q35 320 30 310 Q28 300 32 295" stroke="#5b9bd5" stroke-width="3" fill="none"/>
                <path d="M50 340 Q48 315 45 300 Q43 285 47 275" stroke="#5b9bd5" stroke-width="3" fill="none"/>
                <ellipse cx="32" cy="300" rx="8" ry="15" fill="#81c784" opacity="0.7"/>
                <ellipse cx="47" cy="280" rx="8" ry="15" fill="#66bb6a" opacity="0.7"/>

                <!-- Person -->
                <circle cx="140" cy="250" r="30" fill="#2c3e50"/>
                <path d="M140 250 Q145 255 150 260 L150 270 Q150 275 145 275 L135 275 Q130 275 130 270 L130 260 Q135 255 140 250" fill="#f8b88b"/>
                <ellipse cx="140" cy="290" rx="45" ry="50" fill="#5b9bd5"/>
                <path d="M95 310 L120 330 Q125 335 130 330 L140 300" fill="#5b9bd5"/>
                <path d="M185 310 L175 350 Q173 355 168 352 L155 330" fill="#5b9bd5"/>
                <rect x="160" y="285" width="60" height="8" rx="4" fill="#f8b88b"/>

                <!-- Monitor -->
                <rect x="220" y="200" width="200" height="140" rx="8" fill="#455a64"/>
                <rect x="230" y="210" width="180" height="110" rx="4" fill="#e3f2fd"/>

                <!-- House Cards -->
                <g id="card1">
                    <rect x="245" y="230" width="45" height="50" rx="6" fill="#90caf9"/>
                    <path d="M267.5 235 L280 247 L255 247 Z" fill="white"/>
                    <rect x="250" y="265" width="10" height="3" rx="1.5" fill="white" opacity="0.7"/>
                    <rect x="250" y="270" width="15" height="3" rx="1.5" fill="white" opacity="0.7"/>
                </g>

                <g id="card2">
                    <rect x="300" y="230" width="45" height="50" rx="6" fill="#b3d9f2"/>
                    <rect x="310" y="240" width="25" height="15" rx="3" fill="white" opacity="0.6"/>
                    <rect x="305" y="260" width="10" height="3" rx="1.5" fill="white" opacity="0.5"/>
                    <rect x="305" y="265" width="15" height="3" rx="1.5" fill="white" opacity="0.5"/>
                    <rect x="305" y="270" width="20" height="3" rx="1.5" fill="white" opacity="0.5"/>
                </g>

                <g id="card3">
                    <rect x="355" y="230" width="45" height="50" rx="6" fill="#cce7f5"/>
                    <rect x="365" y="240" width="25" height="15" rx="3" fill="white" opacity="0.6"/>
                    <rect x="360" y="260" width="10" height="3" rx="1.5" fill="white" opacity="0.5"/>
                    <rect x="360" y="265" width="15" height="3" rx="1.5" fill="white" opacity="0.5"/>
                    <rect x="360" y="270" width="20" height="3" rx="1.5" fill="white" opacity="0.5"/>
                </g>

                <!-- Monitor Stand -->
                <rect x="295" y="340" width="60" height="8" rx="4" fill="#455a64"/>
                <rect x="310" y="348" width="30" height="4" rx="2" fill="#607d8b"/>
            </svg>
        </div>
    </div>
</body>
</html>