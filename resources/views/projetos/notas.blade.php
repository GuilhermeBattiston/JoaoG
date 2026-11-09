<?php
$nome = "";
$idade = 0;
$nota1 = 0;
$nota2 = 0;
$nota3 = 0;
$nota4 = 0;
$nota5 = 0;
$media = 0;
$resultado = "";
$situacao = "";
$erro = "";
$pontos = 0;
$resultado_class = "";
$frequencia = 0;

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $nome = $_POST["name"];
        $idade = $_POST["idade"];
        $nota1 = $_POST["nota1"];
        $nota2 = $_POST["nota2"];
        $nota3 = $_POST["nota3"];
        $nota4 = $_POST["nota4"];
        $nota5 = $_POST["nota5"];
        $frequencia = $_POST["frequencia"];
   
     if ($idade <= 0){
        $erro = "A idade deve ser maior que 0";
    }
    else if ($nota1 < 0 or $nota1 > 10 or
        $nota2 < 0 or $nota2 > 10 or
        $nota3 < 0 or $nota3 > 10 or
        $nota4 < 0 or $nota4 > 10 or
        $nota5 < 0 or $nota5 > 10){
        $erro = "A nota deve ser de 0 a 10";
    }
    else {
        $media = ($nota1 * 2 + $nota2 * 3 + $nota3 * 1 + $nota4 * 1 + $nota5 * 3) / 10;
        }
        if ($media == 10 && $frequencia >= 75){
            $resultado = "Aprovado com excelência!";
            $resultado_class = "excelencia";
        }
        else if ($media >= 7 && $frequencia < 75){
            $resultado = "Reprovado por frequência";
            $resultado_class = "reprovado_frequencia";
        }
        else if ($media >= 7){
            $resultado = "Aprovado";
            $resultado_class = "aprovado";
        }
        else if ($media >= 5){
            $resultado = "Recuperação";
            $resultado_class = "recuperar";
            $pontos = 7 - $media;
        }
        else {
            $resultado = "Reprovado";
            $resultado_class = "reprovado";
            $pontos = 7 - $media;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/notas.css">
    <title>Verificador de notas</title>
</head>
<body>
<div class="container">          
    <form method="POST">
        <input type="text" id="name" name="name" placeholder="Digite seu nome"> <br><br>
        <input type="number" id="idade" name="idade" placeholder="Digite sua Idade"> <br><br>
        <input type="number" id="frequencia" name="frequencia" placeholder="Digite sua Frequencia %"> <br><br>
        <input type="number" step="any" id="nota1" name="nota1" placeholder="Digite sua primeira nota"> <br><br>
        <input type="number" step="any" id="nota2" name="nota2" placeholder="Digite sua segunda nota"> <br><br>
        <input type="number" step="any" id="nota3" name="nota3" placeholder="Digite sua terceira nota"> <br><br>
        <input type="number" step="any" id="nota4" name="nota4" placeholder="Digite sua quarta nota"> <br><br>
        <input type="number" step="any" id="nota5" name="nota5" placeholder="Digite sua quinta nota"> <br><br>

        <button type="submit">Enviar</button>
    </form>

    <h2>Aluno: <?= $nome ?></h2>
    <h2>Idade:<?= $idade ?></h2>
    <h2>Frequência do aluno: <?= $frequencia ?>%</h2>
    <h2>Média calculada:<?= $media ?></h2>
    <h2>Faltam <?= $pontos ?> para atingir a média</h2>
    <h2>Situação do aluno: <span class="<?= $resultado_class ?>"><?= $resultado ?></span></h2>
    <h2><?= $erro ?></h2>

    <a href="../../../index.php" class="bt-voltar">Voltar ao início</a>
</div>
</body>
</html>