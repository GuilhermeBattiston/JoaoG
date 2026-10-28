<?php
$nome = "João";
$senha = 1234;
$resultado = "";
$senha_input = "";
$nome_input = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $senha_input = $_POST["senha_input"];
    $nome_input = $_POST["nome_input"];

    if ($senha_input == $senha && $nome_input == $nome) {
        $resultado = 'Seja bem vindo, João';

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
    <title>Verificação de Login | Portfólio</title>
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
        <h1>Verificação de Login</h1>

    <form method="POST">
        <input type="text" id="usuario" name="nome_input" placeholder="Digite seu usuário">

        <input type="number" id="senha" name="senha_input" placeholder="Digite sua senha">

        <button type="submit">Entrar</button>

    </form>

    <?php if ($resultado != "") { ?>
        <div class="card">
            <h1><?= $resultado ?></h1>
        </div>

    <?php } ?>

    </main>
</body>
</html>
    <!-- Com o GET o usuário e senha ficaram aparecendo no url -->