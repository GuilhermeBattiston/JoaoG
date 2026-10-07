<?php
    $caminho = __DIR__ . "/dados.json";

    $json = file_get_contents(@$caminho);

    $alunos = json_decode($json, true);

    $novoAluno=[
    "nome" => "João",
    "idade" => 23,
    "curso" => "Desenvolvimento de sistemas"
    ];

    $alunos[] = $novoAluno;

    $jsonAtualizado = json_encode($alunos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    file_put_contents($caminho, $jsonAtualizado)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>