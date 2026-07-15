<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Delivery Fee & Platform Fee
    |--------------------------------------------------------------------------
    | Ye values hardcode karne ki bajaye .env se bhi override ho sakti hain,
    | taake future mein pricing change karni ho to code touch na karna pade.
    */
    'delivery_fee' => env('CART_DELIVERY_FEE', 199),
    'platform_fee' => env('CART_PLATFORM_FEE', 15),
    'currency_symbol' => env('CART_CURRENCY_SYMBOL', 'Rs.'),
];