<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Lagita Kost</title>
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
            margin-bottom: 20px;
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

        .password-strength {
            margin-top: 5px;
            font-size: 12px;
            display: none;
        }

        .password-strength.weak {
            color: #dc3545;
        }

        .password-strength.medium {
            color: #ffc107;
        }

        .password-strength.strong {
            color: #28a745;
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

        .password-requirements {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .password-requirements h4 {
            margin: 0 0 10px 0;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .requirements-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .requirements-list li {
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .requirements-list li.valid {
            color: #28a745;
        }

        .requirements-list li.valid::before {
            content: '✓';
            color: #28a745;
            font-weight: bold;
        }

        .requirements-list li::before {
            content: '○';
            color: #ccc;
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
        <a href="{{ route('password.verify-otp') }}" class="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>

        <h1>Reset Password</h1>

        <p class="subtitle">
            Masukkan password baru untuk akun Anda
        </p>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="password-requirements">
            <h4>Ketentuan Password:</h4>
            <ul class="requirements-list">
                <li id="req-length">Minimal 8 karakter</li>
                <li id="req-uppercase">Mengandung huruf besar (A-Z)</li>
                <li id="req-lowercase">Mengandung huruf kecil (a-z)</li>
                <li id="req-number">Mengandung angka (0-9)</li>
                <li id="req-match">Konfirmasi password cocok</li>
            </ul>
        </div>

        <form method="POST" action="{{ route('password.reset') }}">
            @csrf

            <div class="form-group">
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="Password baru"
                    required
                >
            </div>

            <div class="form-group">
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-control"
                    placeholder="Konfirmasi password baru"
                    required
                >
            </div>

            <button type="submit" class="btn-submit">Reset Password</button>
        </form>
    </div>

    <script>
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        const requirements = {
            length: document.getElementById('req-length'),
            uppercase: document.getElementById('req-uppercase'),
            lowercase: document.getElementById('req-lowercase'),
            number: document.getElementById('req-number'),
            match: document.getElementById('req-match')
        };

        function checkPassword() {
            const value = password.value;
            const confirmValue = confirmPassword.value;

            // Check length
            const hasLength = value.length >= 8;
            requirements.length.classList.toggle('valid', hasLength);

            // Check uppercase
            const hasUppercase = /[A-Z]/.test(value);
            requirements.uppercase.classList.toggle('valid', hasUppercase);

            // Check lowercase
            const hasLowercase = /[a-z]/.test(value);
            requirements.lowercase.classList.toggle('valid', hasLowercase);

            // Check number
            const hasNumber = /\d/.test(value);
            requirements.number.classList.toggle('valid', hasNumber);

            // Check match
            const matches = value === confirmValue && value !== '';
            requirements.match.classList.toggle('valid', matches);
        }

        password.addEventListener('input', checkPassword);
        confirmPassword.addEventListener('input', checkPassword);
    </script>
</body>
</html>
