<?php
$nome = "";
$idade = "";
$media = "";
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nome = $_GETT["nome"];
    $idade = $_GET["idade"];
    $nota1 = $_GET["nota1"];
    $nota2 = $_GET["nota2"];
    $nota3 = $_GET["nota3"];
    $nota4 = $_GET["nota4"];
    $nota5 = $_GET["nota5"];
   

    $media = (($nota1*2) + ($nota2*3) + ($nota3*1) + ($nota4*1) + ($nota5*3))/10;

    

    if ($media >= 7) {
        $resultado = "Você está aprovado";
    } 
    elseif ($media >=5 && $media <7) {
        $resultado = "Você está de recuperação";
    }
    else {
        $resultado= "Você está de reprovado";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JoaoG</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="card1">
        <form method="GETT">
            <input type="text" name="nome" placeholder="Digite seu nome">
            <input type="number" name="idade" placeholder="Digite sua idade"><br><br>
            <input type="number" name="nota1" placeholder="Digite a primeira nota"><br><br>
            <input type="number" name="nota2" placeholder="Digite a segunda nota"><br><br>
            <input type="number" name="nota3" placeholder="Digite a terceira nota"><br><br>
            <input type="number" name="nota4" placeholder="Digite a quarta nota"><br><br>
            <input type="number" name="nota5" placeholder="Digite a quintaa nota"><br><br>

            <button type="submit">Enviar</button>
        </form>
    </div>

    <?php if ($resultado != "") { ?>

        <div class="card2">
            <h2>Nome: <?= $nome ?></h2>
            <p>Idade: <?= $idade ?></p>
            <p>Média: <?= $media ?></p>
            <p><?= $resultado ?></p>
        </div>

    <?php } ?>

</body>
</html>
