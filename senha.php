<?php
$nome = "João";
$senha = 1234;
$resultado = "";
$senha_input = "";
$nome_input = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $senha_input = $_POST["senha_input"];
    $nome_input = $_POST["nome_input"];

    if ($senha_input == $senha && $nome_input == $nome) {
        $resultado = "Seja bem vindo, João";
    } else {
        $resultado = "Usuário ou senha incorretos";
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
        <input type="text" name="nome_input" placeholder="Digite seu usuário">

        <input type="number" name="senha_input" placeholder="Digite sua senha">

        <button type="submit">Enviar</button>
    </form>

    <?php if ($resultado != "") { ?>
        <div class="card">
            <h1><?= $resultado ?></h1>
        </div>

    <?php } ?>

</body>
</html>
