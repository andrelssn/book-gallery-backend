<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Permite todos os métodos (GET, POST, PUT, DELETE, etc.)
    'allowed_methods' => ['*'],

    // Permite qualquer origem (ou troque por ['https://seusite.com'])
    'allowed_origins' => ['*'],

    // Se quiser permitir apenas domínios específicos:
    // 'allowed_origins' => ['https://meusite.com', 'https://app.meusite.com'],

    // Permite padrões de origem
    'allowed_origins_patterns' => [],

    // Libera todos os headers, incluindo "Authorization"
    'allowed_headers' => ['*'],

    // Headers que o browser pode acessar na resposta
    'exposed_headers' => ['Authorization'],

    // Tempo que o browser guarda o resultado da preflight request
    'max_age' => 0,

    // Permite envio de cookies/autenticação em CORS
    'supports_credentials' => true,

];
