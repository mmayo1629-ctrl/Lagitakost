<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$users = App\Models\User::all();

$output = '';

foreach ($users as $user) {
    $output .= $user->id . ' ' . $user->name . ' ' . $user->email . ' ' . $user->is_admin . "\n";
}

file_put_contents('users.txt', $output);
