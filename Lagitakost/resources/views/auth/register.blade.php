<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #5b9bd5 0%, #f5f9fc 100%);
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

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 32px;
            color: #333;
        }

        .tab-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }

        .tab-btn {
            flex: 1;
            padding: 12px 20px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .tab-btn.active {
            background: #5b9bd5;
            color: white;
            border-color: #5b9bd5;
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
            border-color: #5b9bd5;
        }

        .form-control::placeholder {
            color: #999;
        }

        .btn-register {
            width: 100%;
            padding: 15px;
            background: #5b9bd5;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background: #4a8bc2;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }

        .login-link a {
            color: #5b9bd5;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
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
        <h1>Form Registrasi</h1>
        
        <div class="tab-buttons">
            <a href="{{ route('login') }}" style="flex: 1; text-decoration: none;">
                <button class="tab-btn" style="width: 100%;">Login</button>
            </a>
            <button class="tab-btn active">Daftar</button>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="form-group">
                <input 
                    type="text" 
                    name="name" 
                    class="form-control" 
                    placeholder="Nama lengkap"
                    value="{{ old('name') }}"
                    required
                >
            </div>

            <div class="form-group">
                <input 
                    type="email" 
                    name="email" 
                    class="form-control" 
                    placeholder="Masukan Email"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <div class="form-group">
                <input 
                    type="password" 
                    name="password" 
                    class="form-control" 
                    placeholder="Masukan Password"
                    required
                >
            </div>

            <div class="form-group">
                <input 
                    type="password" 
                    name="password_confirmation" 
                    class="form-control" 
                    placeholder="Ulangi password"
                    required
                >
            </div>

            <button type="submit" class="btn-register">Daftar</button>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login sekarang</a>
            </div>
        </form>
    </div>
</body>
</html>