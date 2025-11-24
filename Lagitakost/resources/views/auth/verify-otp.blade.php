<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Lagita Kost</title>
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

        .otp-input-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        .otp-input {
            width: 50px;
            height: 50px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            transition: border-color 0.3s;
        }

        .otp-input:focus {
            outline: none;
            border-color: #0056b3;
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
            margin-bottom: 15px;
        }

        .btn-submit:hover {
            background: #004494;
        }

        .resend-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .resend-text {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .btn-resend {
            background: none;
            border: none;
            color: #0056b3;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: underline;
            transition: color 0.3s;
        }

        .btn-resend:hover {
            color: #004494;
        }

        .countdown {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
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

        .info-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .info-box p {
            margin: 0;
            font-size: 14px;
            color: #856404;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('password.request') }}" class="back-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>

        <h1>Verifikasi OTP</h1>

        <p class="subtitle">
            Masukkan kode OTP yang dikirim ke email Anda
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
                <strong>Penting:</strong> Kode OTP berlaku selama 10 menit.
                Pastikan untuk memeriksa folder spam jika tidak menemukan email.
            </p>
        </div>

        <form method="POST" action="{{ route('password.verify-otp') }}" id="otpForm">
            @csrf

            <div class="otp-input-container">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
                <input type="text" class="otp-input" maxlength="1" pattern="[0-9]" inputmode="numeric">
            </div>

            <input type="hidden" name="otp" id="otp">

            <button type="submit" class="btn-submit">Verifikasi OTP</button>
        </form>

        <div class="resend-container">
            <p class="resend-text">Tidak menerima kode OTP?</p>
            <button type="button" class="btn-resend" id="resendBtn" onclick="resendOtp()">
                Kirim Ulang Kode OTP
            </button>
            <div class="countdown" id="countdown"></div>
        </div>
    </div>

    <script>
        // OTP input handling
        const otpInputs = document.querySelectorAll('.otp-input');
        const otpHidden = document.getElementById('otp');
        const resendBtn = document.getElementById('resendBtn');
        const countdownEl = document.getElementById('countdown');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                // Only allow numbers
                e.target.value = e.target.value.replace(/[^0-9]/g, '');

                // Auto focus next input
                if (e.target.value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }

                // Update hidden input
                updateOtpValue();
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });

            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const paste = e.clipboardData.getData('text');
                const digits = paste.replace(/[^0-9]/g, '').slice(0, 6);

                digits.split('').forEach((digit, i) => {
                    if (otpInputs[index + i]) {
                        otpInputs[index + i].value = digit;
                    }
                });

                updateOtpValue();

                // Focus last filled input or next empty
                const nextIndex = Math.min(index + digits.length, otpInputs.length - 1);
                otpInputs[nextIndex].focus();
            });
        });

        function updateOtpValue() {
            const otp = Array.from(otpInputs).map(input => input.value).join('');
            otpHidden.value = otp;
        }

        // Resend OTP functionality
        let countdown = 60; // 60 seconds cooldown

        function startCountdown() {
            resendBtn.disabled = true;
            resendBtn.style.color = '#999';
            resendBtn.style.cursor = 'not-allowed';

            const timer = setInterval(() => {
                countdownEl.textContent = `Kirim ulang dalam ${countdown} detik`;
                countdown--;

                if (countdown < 0) {
                    clearInterval(timer);
                    resendBtn.disabled = false;
                    resendBtn.style.color = '#0056b3';
                    resendBtn.style.cursor = 'pointer';
                    countdownEl.textContent = '';
                    countdown = 60;
                }
            }, 1000);
        }

        function resendOtp() {
            fetch('{{ route("password.resend-otp") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Kode OTP baru telah dikirim!');
                    startCountdown();
                } else {
                    alert('Gagal mengirim ulang kode OTP. Silakan coba lagi.');
                }
            })
            .catch(error => {
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        }

        // Start countdown on page load
        startCountdown();
    </script>
</body>
</html>
