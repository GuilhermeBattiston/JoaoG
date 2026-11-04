<?php

    $nome = "";
    $idade = 0;
    $resposta= "";
    if ($_SERVER ["REQUEST_METHOD"] == "GET" && isset($_GET["nome"], $_GET["idade"], $_GET["nota1"], $_GET["nota2"], $_GET["nota3"], $_GET["nota4"], $_GET["nota5"])){
        $nome = $_GET["nome"];
        $idade = $_GET["idade"];
        $nota1 = $_GET["nota1"];
        $nota2 = $_GET["nota2"];
        $nota3 = $_GET["nota3"];
        $nota4 = $_GET["nota4"];
        $nota5 = $_GET["nota5"];
        $media = (($nota1 * 2) + ($nota2 * 3) + ($nota3 * 1) + ($nota4 * 1) + ($nota5 * 3)) / 10;
         if ($media >= 7){
            $resposta="APROVADO";
        }
        elseif ($media < 7 && $media >= 5){
            $resposta="RECUPERAÇÃO";    
        }
        else{
            $resposta="REPROVADO";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/style.css">
    <title>Verificador de Notas</title>
</head>
<body>
    <nav>
    <a href="/index.php">Página inicial</a>
    </nav>
    <form method="GET">
        <input type = "text" id="nome" name="nome" placeholder="Digite o nome">
        <input type = "number" id="idade" name="idade" placeholder="Digite a idade">
        <input type = "number" id="nota1" name="nota1" placeholder="Digite a nota 1">
        <input type = "number" id="nota2" name="nota2" placeholder="Digite a nota 2">
        <input type = "number" id="nota3" name="nota3" placeholder="Digite a nota 3">
        <input type = "number" id="nota4" name="nota4" placeholder="Digite a nota 4">
        <input type = "number" id="nota5" name="nota5" placeholder="Digite a nota 5">
        <button type="submit">Verificar</button>
    </form>
    <div class = "container">
        

        <?php  if($resposta != "") { ?>
            <h2>O nome é: <?= $nome ?> </h2>
            <h2>A idade é: <?= $idade ?> anos </h2>
            <h2>A média é: <?= $media ?> </h2>
            <h2> <?= $resposta ?> </h2>

        <?php } ?>
    </div>
</body>
</html>
