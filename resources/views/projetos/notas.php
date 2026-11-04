<?php

    $nome = "";
    $idade = 0;
    $resposta= "";
    $falta="";
    $frequencia=0;
    if ($_SERVER ["REQUEST_METHOD"]=="POST"){
        $nome = $_POST["nome"] ?? 0;
        $idade = $_POST["idade"] ?? 0;
        $nota1 = $_POST["nota1"] ?? 0;
        $nota2 = $_POST["nota2"] ?? 0;
        $nota3 = $_POST["nota3"] ?? 0;
        $nota4 = $_POST["nota4"] ?? 0;
        $nota5 = $_POST["nota5"] ?? 0;

        if ($idade <= 0){
            echo "A idade deve ser maior que zero!";
        }

        elseif ($nota1 < 0 || $nota1 > 10 ||
            $nota2 < 0 || $nota2 > 10 ||
            $nota3 < 0 || $nota3 > 10 ||
            $nota4 < 0 || $nota4 > 10 ||
            $nota5 < 0 || $nota5 > 10) 
        {
            echo "Os valores das notas devem ser de zero a dez!";
        }

        $frequencia = $_POST["frequencia"] ?? 0;
        if ($frequencia > 100 || $frequencia < 0){
            echo "Os valores da frequência devem ser de zero a cem!";
        }

        $media = (($nota1 * 2) + ($nota2 * 3) + ($nota3 * 1) + ($nota4 * 1) + ($nota5 * 3)) / 10;

        if ($media == 10){
            $resposta="APROVADO COM EXCELÊNCIA";
        }
        elseif ($media < 10 && $media >= 7){
            $resposta="APROVADO";
        }
        elseif ($media < 7 && $media >= 5){
            $resposta="RECUPERAÇÃO";    
            $falta=(7-$media);
        }
        else{
            $resposta="REPROVADO";
            $falta=(7-$media);
        }

        if ($frequencia < 0 || $frequencia > 100) {
        echo "A frequência deve estar entre 0% e 100%.";
        }

        if ($frequencia < 75) {
                $resposta = "REPROVADO POR FREQUÊNCIA";

            } elseif ($media >= 7) {
            if ($media == 10) {
                $resposta = "APROVADO COM EXCELÊNCIA";
            } else {
                $resposta = "APROVADO";
            }

            } elseif ($media >= 5) {
                $resposta = "RECUPERAÇÃO";
                $falta = 7 - $media;

            } else {
                $resposta = "REPROVADO";
                $falta = 7 - $media;
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
    <form method="POST">
        <input type = "text" id="nome" name="nome" placeholder="Digite o nome">
        <input type = "number" id="idade" name="idade" placeholder="Digite a idade">
        <input type = "number" id="nota1" name="nota1" min="0" max="10" placeholder="Digite a nota 1">
        <input type = "number" id="nota2" name="nota2" min="0" max="10" placeholder="Digite a nota 2">
        <input type = "number" id="nota3" name="nota3" min="0" max="10" placeholder="Digite a nota 3">
        <input type = "number" id="nota4" name="nota4" min="0" max="10" placeholder="Digite a nota 4">
        <input type = "number" id="nota5" name="nota5" min="0" max="10" placeholder="Digite a nota 5">
        <input type="number" id="frequencia" name="frequencia" min="0" max="100" step="0.1" required placeholder="Digite a frequência do aluno (0% a 100%)">
        <button type="submit">Verificar</button>
    </form>
    <div class = "container">
        

        <?php  if($resposta != "") { ?>
            <h2>O nome é: <?= $nome ?> </h2>
            <h2>A idade é: <?= $idade ?> anos </h2>
            <h2>A frequência é: <?= $frequencia ?>% </h2>
            <h2>A média é: <?= $media ?> </h2>
            <?php
                $classeSituacao = "reprovado";

                if ($resposta == "APROVADO" || $resposta == "APROVADO COM EXCELÊNCIA") {
                    $classeSituacao = "aprovado";
                } elseif ($resposta == "RECUPERAÇÃO") {
                    $classeSituacao = "recuperacao";
                }
            ?>
            <h2 class="situacao <?= $classeSituacao ?>"><?= $resposta ?></h2>
            <?php if ($falta !== "") { ?>
            <h2>Faltaram <?= number_format($falta, 1, ',', '') ?> ponto(s) para atingir a média 7</h2>

            <?php } ?>
        <?php } ?>
    </div>
</body>
</html>
