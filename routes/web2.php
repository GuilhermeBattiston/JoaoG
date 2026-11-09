<?php

use App\Http\Controllers\HelpdeskController;
use App\Http\Controllers\PortfolioController;

// Listando em arrays as rotas que vamos criar
return [
    'GET' => [
        'portfolio' => [new PortfolioController, 'index'],
        'helpdesk' => [new HelpdeskController, 'index'],
        // 'idade' => [],
        // 'jogos' => [],
        // 'login-basico' => [],
        // 'notas' => [],
    ],
    //     'POST' => [
    //         'helpdesk' => [new HelpdeskController(), '']
    //     ]
];
