<?php

return [
    'minutes' => 60,
    'numer_pass' => 8,
    'accept_default' => 0,
    'accept' => 1,
    'cancel' => 2,
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
        'category' => 'category.jpg',
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
