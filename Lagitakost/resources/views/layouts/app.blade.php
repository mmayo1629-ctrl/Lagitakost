<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                        {{ __('Logout') }}
                                    </a>

                                    <!-- Logout Modal -->
                                    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-lg">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="logoutModalLabel">
                                                        <i class="fas fa-sign-out-alt me-2"></i>Konfirmasi Logout
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center py-4">
                                                    <div class="mb-3">
                                                        <i class="fas fa-user-circle fa-3x text-muted mb-3"></i>
                                                    </div>
                                                    <h6 class="mb-3">Apakah Anda yakin ingin keluar?</h6>
                                                    <p class="text-muted small mb-0">Anda akan diarahkan ke halaman login setelah logout.</p>
                                                </div>
                                                <div class="modal-footer justify-content-center border-0">
                                                    <button type="button" class="btn btn-outline-secondary px-4 me-2" data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-1"></i>Batal
                                                    </button>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger px-4" id="confirm-logout-btn">
                                                            <i class="fas fa-sign-out-alt me-1"></i>Ya, Keluar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <style>
                                        #logoutModal .modal-content {
                                            border-radius: 15px;
                                            overflow: hidden;
                                        }
                                        #logoutModal .modal-header {
                                            border: none;
                                            border-radius: 15px 15px 0 0;
                                        }
                                        #logoutModal .btn {
                                            border-radius: 25px;
                                            font-weight: 500;
                                            transition: all 0.3s ease;
                                        }
                                        #logoutModal .btn:hover {
                                            transform: translateY(-1px);
                                            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                                        }
                                        #logoutModal .fa-user-circle {
                                            animation: pulse 2s infinite;
                                        }
                                        @keyframes pulse {
                                            0% { transform: scale(1); }
                                            50% { transform: scale(1.05); }
                                            100% { transform: scale(1); }
                                        }
                                        #confirm-logout-btn:hover {
                                            background-color: #dc3545;
                                            border-color: #dc3545;
                                        }
                                    </style>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
