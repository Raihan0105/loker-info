<?php

return [

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    // PASTIKAN BLOK INI ADA
    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
    // PASTIKAN BLOK INI ADA
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
],
    'password_timeout' => 10800,

];
