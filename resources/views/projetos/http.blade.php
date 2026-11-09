<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
$metodo = $_SERVER['REQUEST_METHOD'];
$caminho = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($caminho === '/chamados' && $metodo === 'GET') {
    http_response_code(200);
    echo json_encode([['id'=>1,'titulo'=>'Computador sem rede']], JSON_UNESCAPED_UNICODE);
    exit;
}
if ($caminho === '/chamados' && $metodo === 'POST') {
    $dados = json_decode(file_get_contents('php://input'), true);
    if (!is_array($dados) || !is_string($dados['titulo'] ?? null) || trim($dados['titulo']) === '') {
        http_response_code(400);
        echo json_encode(['erro'=>'Título obrigatório']); exit;
    }
    http_response_code(201);
    echo json_encode(['id'=>2,'titulo'=>trim($dados['titulo'])], JSON_UNESCAPED_UNICODE); exit;
}
http_response_code(404);
echo json_encode(['erro'=>'Rota não encontrada']);

/* 
EXECUÇÃO/TESTE:
curl -i http://seudominio.devlook.xyz/chamados
curl -i -X POST http://seudominio.devlook.xyz/chamados -H "Content-Type: application/json" -d '{"titulo":"Impressora falhando"}'
curl -i http://seudominio.devlook.xyz/inexistente


curl -i http://look.devlook.xyz/chamados
curl -i -X POST http://look.devlook.xyz/chamados -H "Content-Type: application/json" -d '{"titulo":"Impressora falhando"}'
curl -i http://look.devlook.xyz/inexistente
*/


?>