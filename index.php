<?php
    require "conexao.php";
    
    echo "Sistema conectado";

    $sql = "CREATE TABLE IF NOT EXISTS teste (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100),
        idade INT
    )";

    $pdo->exec($sql);

    echo "Tabela criada com sucesso";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="/projetos/idade.php">Verificador de Idade</a><br><br>
    <a href="/projetos/notas.php">Verificador de Notas</a><br><br>
    <a href="/projetosa/notas-desafio.php">Desafio-Notas</a><br><br>
    <a href="/projetos/senha.php">Login</a><br><br>
    <a href="/projetos/jogos.php">Jogos(MySql)</a>
    
</body>
</html>