<?php

return [
    'disable' => env('CAPTCHA_DISABLE', false),
    'characters' => ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
        'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd',
        'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's',
        't', 'u', 'v', 'w', 'x', 'y', 'z', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
<<<<<<< HEAD
    //'fontsDirectory' => dirname(__DIR__) . '/assets/fonts',
    //'bgsDirectory' => dirname(__DIR__) . '/assets/backgrounds',
    'defaultoriginal' => [
=======
    'fontsDirectory' => dirname(__DIR__) . '/assets/fonts',
    'bgsDirectory' => dirname(__DIR__) . '/assets/backgrounds',
    'default' => [
>>>>>>> fc01ef197783576ca65074e4264f59b7ee02a501
        'length' => 6,
        'width' => 345,
        'height' => 65,
        'quality' => 90,
        'math' => false,
        'expire' => 60,
        'encrypt' => false,
    ],
<<<<<<< HEAD
	'default' => [
        'characters' => ['0','1','2', '3', '4','5', '6', '7', '8', '9'],
        'length' => 4,
        'width' => 150,
        'height' => 70,
        'quality' => 90,
        'bgImage' => false,
        'bgColor' => '#ffffff',
        'lines' => 0,
        'fontColors' => ['#000000', '#c0392b', '#16a085', '#c0392b', '#8e44ad', '#303f9f', '#f57c00', '#795548'],
        'math' => false,
        'expire' => 300,
        'encrypt' => false,
    ],
=======
>>>>>>> fc01ef197783576ca65074e4264f59b7ee02a501
    'flat' => [
        'length' => 6,
        'fontColors' => ['#2c3e50', '#c0392b', '#16a085', '#c0392b', '#8e44ad', '#303f9f', '#f57c00', '#795548'],
        'width' => 345,
        'height' => 65,
        'math' => false,
        'quality' => 100,
        'lines' => 6,
        'bgImage' => true,
        'bgColor' => '#28faef',
        'contrast' => 0,
    ],
    'mini' => [
        'length' => 3,
        'width' => 60,
        'height' => 32,
    ],
    'inverse' => [
        'length' => 5,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
        'sensitive' => true,
        'angle' => 12,
        'sharpen' => 10,
        'blur' => 2,
        'invert' => false,
        'contrast' => -5,
    ],
    'math' => [
        'length' => 9,
        'width' => 120,
        'height' => 36,
        'quality' => 90,
    ],
];
