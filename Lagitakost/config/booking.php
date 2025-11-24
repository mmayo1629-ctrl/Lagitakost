<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Room Types and Prices
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for room types and their monthly prices.
    | Prices are in Indonesian Rupiah (IDR).
    |
    */

    'room_types' => [
        'Tipe A' => 500000,
        'Tipe B' => 850000,
        'Tipe C' => 650000,
        'Tipe D' => 800000,
        'Tipe E' => 700000,
        'Tipe F' => 500000,
    ],

    /*
    |--------------------------------------------------------------------------
    | Days in Month for Price Calculation
    |--------------------------------------------------------------------------
    |
    | Number of days used to calculate daily price from monthly price.
    |
    */

    'days_in_month' => 30,
];
