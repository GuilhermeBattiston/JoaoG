<?php

session_start();

$usuarioCorreto = "leomzito";
$senhaCorreta = "0795";
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST["usuario"] ?? "";
    $senha = $_POST["senha"] ?? "";

    if ($usuario === $usuarioCorreto && $senha === $senhaCorreta) {
        session_regenerate_id(true);
        $_SESSION["autenticado"] = true;
        header("Location: jogos.php");
        exit;
    }

    $mensagem = "Usuário ou senha incorretos";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link rel="stylesheet" href="/resources/css/login.css?v=20261027">
</head>
<body>
    <nav><a href="/index.php">Página inicial</a></nav>
    <div class="caixa-login">
        <h1>Login</h1>
        <form method="POST" action="login.php">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <button type="submit">Entrar</button>
        </form>
        <p id="mensagem"><?= htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8") ?></p>
    </div>
</body>
</html>



