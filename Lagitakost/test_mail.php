<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\Mail;

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    Mail::raw('Test email from LagitaKost - ' . date('Y-m-d H:i:s'), function($message) {
        $message->to('mayoshaquille@gmail.com')->subject('Test Email - LagitaKost');
    });
    echo "Email sent successfully!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
