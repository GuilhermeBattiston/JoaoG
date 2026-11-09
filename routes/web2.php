<?php

    require_once __DIR__ . '/../app/Http/Controllers/PortfolioController.php';
    require_once __DIR__ . '/../app/Http/Controllers/HelpdeskController.php';

    // Listando em arrays as rotas que vamos criar
    return [
        'GET' => [
            'portfolio' => [new PortfolioController(), 'index'],
            'helpdesk' => [new HelpdeskController(), 'index'],
            // 'idade' => [],
            // 'jogos' => [],
            // 'login-basico' => [],
            // 'notas' => [],
        ],
    //     'POST' => [
    //         'helpdesk' => [new HelpdeskController(), '']
    //     ]
    ];

?>
