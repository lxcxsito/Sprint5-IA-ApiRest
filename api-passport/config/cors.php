<?php
return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],        // Permite todos los métodos: GET, POST, PUT, DELETE, OPTIONS
    'allowed_origins' => ['http://localhost:3000'], // Solo tu frontend
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0, 
    'supports_credentials' => true, // necesario si usas cookies o auth

];
