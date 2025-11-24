<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode OTP Reset Password</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #a8c5ff 0%, #e4c5ff 100%);
            padding: 30px 20px;
            text-align: center;
            color: #333;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        .otp-code {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 36px;
            font-weight: bold;
            padding: 20px 40px;
            border-radius: 8px;
            display: inline-block;
            margin: 20px 0;
            letter-spacing: 4px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        .message {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 6px;
            font-size: 14px;
            margin: 20px 0;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .footer p {
            margin: 5px 0;
        }
        .brand {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Lagita Kost</h1>
        </div>

        <div class="content">
            <h2>Kode OTP Reset Password</h2>

            <p class="message">
                Halo <strong>{{ $user->name }}</strong>,<br>
                Kami menerima permintaan reset password untuk akun Anda.
            </p>

            <div class="otp-code">
                {{ $otp }}
            </div>

            <p class="message">
                Masukkan kode OTP di atas untuk melanjutkan proses reset password.
                Kode ini akan kadaluarsa dalam 10 menit.
            </p>

            <div class="warning">
                <strong>Peringatan:</strong> Jangan bagikan kode OTP ini kepada siapapun.
                Jika Anda tidak meminta reset password, abaikan email ini.
            </div>
        </div>

        <div class="footer">
            <p><span class="brand">Lagita Kost</span> - Kost Nyaman untuk Mahasiswi</p>
            <p>Jika Anda memiliki pertanyaan, hubungi kami di support@lagitakost.com</p>
            <p>&copy; 2025 Lagita Kost. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
