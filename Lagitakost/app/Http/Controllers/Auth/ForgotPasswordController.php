<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate 6-digit OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store OTP in session with expiration (10 minutes)
        Session::put('reset_otp', [
            'code' => $otp,
            'email' => $request->email,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP email
        try {
            Mail::to($user->email)->send(new SendOtp($otp, $user));

            return redirect()->route('password.verify-otp')->with('success', 'Kode OTP telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mengirim email. Silakan coba lagi.']);
        }
    }

    public function showVerifyOtpForm()
    {
        // Check if OTP session exists
        if (!Session::has('reset_otp')) {
            return redirect()->route('password.request')->withErrors(['message' => 'Sesi reset password telah berakhir.']);
        }

        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $sessionOtp = Session::get('reset_otp');

        if (!$sessionOtp) {
            return back()->withErrors(['otp' => 'Sesi reset password telah berakhir.']);
        }

        // Check if OTP has expired
        if (now()->isAfter($sessionOtp['expires_at'])) {
            Session::forget('reset_otp');
            return back()->withErrors(['otp' => 'Kode OTP telah kadaluarsa.']);
        }

        // Check if OTP matches
        if ($request->otp !== $sessionOtp['code']) {
            return back()->withErrors(['otp' => 'Kode OTP tidak valid.']);
        }

        // OTP verified, proceed to reset password
        Session::put('otp_verified', true);

        return redirect()->route('password.reset-form');
    }

    public function showResetPasswordForm()
    {
        // Check if OTP was verified
        if (!Session::has('otp_verified')) {
            return redirect()->route('password.request')->withErrors(['message' => 'Verifikasi OTP diperlukan.']);
        }

        return view('auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $sessionOtp = Session::get('reset_otp');

        if (!$sessionOtp || !Session::has('otp_verified')) {
            return redirect()->route('password.request')->withErrors(['message' => 'Sesi reset password tidak valid.']);
        }

        // Update user password
        $user = User::where('email', $sessionOtp['email'])->first();
        $user->password = bcrypt($request->password);
        $user->save();

        // Clear session
        Session::forget(['reset_otp', 'otp_verified']);

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
    }

    public function resendOtp()
    {
        $sessionOtp = Session::get('reset_otp');

        if (!$sessionOtp) {
            return response()->json(['success' => false, 'message' => 'Sesi reset password tidak ditemukan.']);
        }

        $user = User::where('email', $sessionOtp['email'])->first();

        // Generate new OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Update session
        Session::put('reset_otp', [
            'code' => $otp,
            'email' => $sessionOtp['email'],
            'expires_at' => now()->addMinutes(10),
        ]);

        // Send new OTP email
        try {
            Mail::to($user->email)->send(new SendOtp($otp, $user));

            return response()->json(['success' => true, 'message' => 'Kode OTP baru telah dikirim ke email Anda.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal mengirim email. Silakan coba lagi.']);
        }
    }
}
