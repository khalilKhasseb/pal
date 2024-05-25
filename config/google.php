<?php

return [
    'redirect_uri'     => 'https://dev.palgbc.org/google/callback',
    'auth_config_path' => base_path('clientapi.json'),
    'access_type'      => 'offline',
    'token_model'      => App\Models\Token::class,
];
