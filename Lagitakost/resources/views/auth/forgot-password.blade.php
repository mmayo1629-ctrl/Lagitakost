<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Lagita Kost</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #a8c5ff 0%, #e4c5ff 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .back-button {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #0056b3;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 20px;
            transition: color 0.3s;
        }

        .back-button:hover {
            color: #004494;
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 28px;
            color: #333;
            font-weight: 600;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 30px;
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 1px solid #ddd;
            border-radius: 12px;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #0056b3;
        }

        .form-control::placeholder {
            color: #999;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: #0056b3;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: #004494;
        }

        .info-box {
            background: #e8f4fd;
            border: 1px solid #b3d9ff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .info-box p {
            margin: 0;
            font-size: 14px;
            color: #0056b3;
            line-height: 1.5;
        }

        .alert {
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('login') }}" class="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali ke Login
        </a>

        <h1>Lupa Password</h1>

        <p class="subtitle">
            Masukkan email yang terdaftar untuk menerima kode OTP reset password
        </p>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="info-box">
            <p>
                <strong>Catatan:</strong> Kode OTP akan dikirim ke email Anda dan berlaku selama 10 menit.
                Pastikan email yang Anda masukkan sudah terdaftar di sistem.
            </p>
        </div>

        <form method="POST" action="{{ route('password.send-otp') }}">
            @csrf

            <div class="form-group">
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan email Anda"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <button type="submit" class="btn-submit">Kirim Kode OTP</button>
        </form>
    </div>
</body>
</html>
