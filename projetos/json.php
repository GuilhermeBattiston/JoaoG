<?php
    $caminho = __DIR__ . "/dados.json";

    $json = file_get_contents(@$caminho);

    $alunos = json_decode($json, true);

    if($_SERVER["REQUEST_METHOD"]=="POST"){
            $novoAluno=[
                "nome" => $_POST["nome"],
                "idade" => $_POST["idade"],
                "curso" => $_POST["curso"]
            ];
        
        
    
        $alunos[] = $novoAluno;

        $jsonAtualizado = json_encode($alunos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents($caminho, $jsonAtualizado);
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome">
        <label>Idade:</label>
        <input type="number" name="idade">
        <label>Curso:</label>
        <input type="text" name="curso">
        <button type="submit">Cadastrar</button>
    </form>

    <h2>Alunos Cadastrados</h2>
    <?php foreach($alunos as $aluno) { ?>
        <h3><?= $aluno["nome"] ?></h3>
        <p>Idade<?= $aluno["idade"] ?></p>
        <p>Curso<?= $aluno["curso"] ?></p>
    <?php } ?>
</body>
</html>