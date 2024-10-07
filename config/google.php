<?php

return [
    'redirect_uri'     => env('GOOGLE_API_REDIRECT_URI' , 'http://127.0.0.1:8000/google/callback'),
    'auth_config_path' => env('GOOGLE_CONFIG_PATH' , base_path('clientapi.json')),
    'access_type'      => env("GOOGLE_ACCESS_TYPE" ,'offline'),
    'token_model'      => App\Models\Token::class,

    'cap' => [
        'site_key' => env('C_SITE_KEY'),
        'site_secret' => env('C_SITE_SECRET')
    ]
];
