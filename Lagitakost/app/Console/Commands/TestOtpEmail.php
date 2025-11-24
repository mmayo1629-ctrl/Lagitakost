<?php

namespace App\Console\Commands;

use App\Mail\SendOtp;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestOtpEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:otp-email {email?} {otp?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test OTP email sending';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?: 'test@example.com';
        $otp = $this->argument('otp') ?: '123456';

        $this->info("Sending OTP email to: {$email}");
        $this->info("OTP Code: {$otp}");

        $user = (object) ['name' => 'Test User'];

        try {
            Mail::to($email)->send(new SendOtp($otp, $user));
            $this->info('OTP email sent successfully!');
        } catch (\Exception $e) {
            $this->error('Failed to send OTP email: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
        }
    }
}
