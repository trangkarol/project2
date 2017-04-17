<?php

return [
    'minutes' => 60,
    'numer_pass' => 8,
    'accept_default' => 0,
    'defaul_select' => [
        '0' => '',
    ],

    'admin' => [
        'paginate' => 15,
    ],

    'user' => [
        'paginate' => 10,
    ],

    'path' => [
        'file' => base_path() . '/public/Upload/',
        'show' => '/Upload',
        'images' => '/images',
    ],

    'images' => [
        'avatar' => 'avatar.png',
        'product' => 'product.jpg',
    ],

    'mutil-level' => [
        'one' => 0,
        'two' => 1,
    ],

    'role' => [
        'admin' => 0,
        'user' => 1,
    ],
];
