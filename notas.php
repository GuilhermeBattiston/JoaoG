<?php
$nome = "";
$idade = "";
$media = "";
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $nota1 = $_POST["nota1"];
    $nota2 = $_POST["nota2"];
    $nota3 = $_POST["nota3"];
    $nota4 = $_POST["nota4"];
    $nota5 = $_POST["nota5"];
    $media = $_POST["média"];

    

    if ($media >= 7) {
        $resultado = "Você está aprovado";
    } elseif ($media >=5 & $media <7) {
        $resultado = "Você está de recuperação";
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

    <form method="POST">
        <input type="text" name="nome" placeholder="Digite seu nome">
        <input type="number" name="idade" placeholder="Digite sua idade">
        <input type="number" name="Nota 1" placeholder="Digite a primeira nota">
        <input type="number" name="Nota 2" placeholder="Digite a segunda nota">
        <input type="number" name="Nota 3" placeholder="Digite a terceira nota">
        <input type="number" name="Nota 4" placeholder="Digite a quarta nota">
        <input type="number" name="Nota 5" placeholder="Digite a quintaa nota">

        <button type="submit">Enviar</button>
    </form>

    <?php if ($resultado != "") { ?>

        <div class="card">
            <h1>Nome: <?= $nome ?></h1>
            <p>Idade: <?= $idade ?></p>
            <p>Média: <?= $media ?></p>
            <p><?= $resultado ?></p>
        </div>

    <?php } ?>

</body>
</html>
