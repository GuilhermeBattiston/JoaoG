<?php
$nome = "";
$idade = "";
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];

    if ($idade >= 18) {
        $resultado = "Você é maior de idade";
    } else {
        $resultado = "Você é menor de idade";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Idade | Portfólio</title>
    <link rel="stylesheet" href="../css/projetos.css">
</head>

<body class="pagina-projeto">
    <header>
        <nav class="navbar" aria-label="Navegação principal">
            <a href="../index.php" class="logo">Meu Portfólio</a>
            <a href="../index.php#projetos">Voltar aos projetos &rarr;</a>
        </nav>
    </header>
    <main>
        <h1>Verificação de Idade</h1>

    <form method="POST">
        <input type="text" name="nome" placeholder="Digite seu nome">

        <input type="number" name="idade" placeholder="Digite sua idade">

        <button type="submit">Enviar</button>

    </form>

    <?php if ($resultado != "") { ?>

        <div class="card">
            <h1>Nome: <?= $nome ?></h1>
            <p>Idade: <?= $idade ?></p>
            <p><?= $resultado ?></p>
        </div>

    <?php } ?>

    </main>
</body>
</html>
