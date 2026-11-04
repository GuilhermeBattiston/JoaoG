<?php
    //INFORMAR QUE A RESPOSTA SERÁ EM JSON
    header('Content-Type: application/json; charset=utf-8');

    //DEFINIR O MÉTODO UTILIZADO NA REQUISIÇÃO
    $metodo = $_SERVER['REQUEST_METHOD'];

    //LISTA DE CHAMADOS DE EXEMPLO
    $chamados = [
        [
            "id" => 1,
            "titulo" => "Computador sem internet"
        ],
        [
            "id" => 2,
            "titulo" => "Impressora atolada"
        ]
    ];

    //VERIFICAR O MÉTODO DA REQUISIÇÃO, E EXECUTAR X AÇÕES
    if ($metodo === 'GET') {
        //DEFINE O CÓDGO DE STATUS HTTP DESSA REQUISIÇÃO
        http_response_code(200);
        //POR QUE NÃO PRECISO UTILIZAR JSON_PRETTY_PRINT? pretty_print é utilizado para interpretação visual por humanos, maquinas nao necessitam dos espaços para entender
        echo json_encode($chamados, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    //SE POST
    if ($metodo === 'POST') {
        //LÊ O CONTEÚDO ENVIADO NO BODY DA REQUISIÇÃO
        //php://input permite ler o corpo bruto da requisição
        $conteudo = file_get_contents('php://input');

        //Converte JSON em /ARRAY PHP
        $dados = json_decode($conteudo, true);

        //Verifica se os dados são válidos
        if (!is_array($dados) || // O JSON não foi convertido em array
        !isset($dados['titulo']) || // O titulo não foi informado ou é nulo
        !is_string($dados['titulo']) || // O título não é um texto
        trim($dados['titulo']) === '') // O título está vazio ou contém apenas espaços
        ) {
            http_response_code(400); 
            echo json_encode(["erro" => "Título obrigatório"]);
            exit;
        }
        // Simula a criação de um chamado novo
        $novoChamado = [
            "id" => 3,
            "titulo" => trim($dados['titulo'])
        ];
        http_response_code(201);
        echo json_encode($novoChamado, JSON_UNESCAPED_UNICODE);
        exit;
    }
    header('Allow: GET, POST');
    http_response_code(405);
    
?>
