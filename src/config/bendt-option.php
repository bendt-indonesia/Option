<?php
return [
    'api_route' => true,
    'migration' => true,
    'access_role' => false, //enable role access on API Request
    'class' => [
        'store' => \App\Store::class,
    ],
];
