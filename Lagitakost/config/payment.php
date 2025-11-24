<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Payment Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains payment-related configuration for the application.
    |
    */

    'methods' => [
        'transfer_bank' => [
            'name' => 'Transfer Bank',
            'description' => 'Transfer ke rekening bank',
            'enabled' => true,
        ],
        'e_wallet' => [
            'name' => 'E-Wallet',
            'description' => 'GoPay, OVO, Dana, dll',
            'enabled' => true,
        ],
        'cash' => [
            'name' => 'Tunai',
            'description' => 'Pembayaran langsung',
            'enabled' => true,
        ],
    ],

    'bank_accounts' => [
        [
            'bank_name' => 'BCA',
            'account_number' => '1234567890',
            'account_holder' => 'PT. Lagita Kost',
            'branch' => 'Jakarta Pusat',
        ],
        [
            'bank_name' => 'Mandiri',
            'account_number' => '0987654321',
            'account_holder' => 'PT. Lagita Kost',
            'branch' => 'Jakarta Pusat',
        ],
        [
            'bank_name' => 'BNI',
            'account_number' => '1122334455',
            'account_holder' => 'PT. Lagita Kost',
            'branch' => 'Jakarta Pusat',
        ],
    ],

    'e_wallets' => [
        [
            'name' => 'GoPay',
            'account' => '0812-3456-7890',
            'account_holder' => 'PT. Lagita Kost',
        ],
        [
            'name' => 'OVO',
            'account' => '0812-3456-7890',
            'account_holder' => 'PT. Lagita Kost',
        ],
        [
            'name' => 'Dana',
            'account' => '0812-3456-7890',
            'account_holder' => 'PT. Lagita Kost',
        ],
    ],
];
