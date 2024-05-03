<?php

return [
    'redirect_uri'     => 'http://127.0.0.1:8000/google/callback',
    'auth_config_path' => base_path('clientapi.json'),
    'access_type'      => 'offline',
    'token_model'      => App\Models\Token::class,
];
