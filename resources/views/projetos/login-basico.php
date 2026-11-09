<?php
$usuario = "";
$senha = "";
$mensagem = "";
$erro = "";

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    if ($usuario == "alunosenai" && $senha == "senhasenai"){
        $mensagem = "Login realizado com sucesso!";
    }
    else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/login-basico.css">
    <title>login</title>
</head>
<body>
    <div class="container">
        <form method="POST">
            <input type="text" id="name" name="usuario" placeholder="Digite seu usuário"> <br><br>
            <input type="text" id="senha" name="senha" placeholder="Digite sua senha"> <br><br>
            <button type="submit">Enviar</button>

            <h2><?= $mensagem ?></h2>
            <h2><?= $erro ?></h2>
            
            <a href="../../../index.php" class="bt-voltar">Voltar ao início</a>
        </form>
    </div>

</body>
</html>