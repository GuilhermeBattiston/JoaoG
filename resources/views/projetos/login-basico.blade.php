<<<<<<< HEAD
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
=======
<?php $mensagem = $mensagem ?? ''; $erro = ''; ?>
>>>>>>> df0f77ec3d5938d164180aa3a178fd3b71c1ff1c
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link rel="stylesheet" href="/resources/css/login-basico.css">
    <title>login</title>
</head>
<body>
    <div class="container">
        <form method="POST">
            <input type="text" id="name" name="usuario" placeholder="Digite seu usuário"> <br><br>
            <input type="text" id="senha" name="senha" placeholder="Digite sua senha"> <br><br>
=======
    @vite(['resources/css/login.css'])
    <title>login</title>
</head>
<body>
    @include('projetos.erros')
    <div class="container">
        <form method="POST">
            @csrf
            <label for="name">Digite seu usuário</label>
        <input type="text" id="name" name="usuario" placeholder="Digite seu usuário"> <br><br>
            <label for="senha">Digite sua senha</label>
        <input type="password" id="senha" name="senha" placeholder="Digite sua senha"> <br><br>
>>>>>>> df0f77ec3d5938d164180aa3a178fd3b71c1ff1c
            <button type="submit">Enviar</button>

            <h2><?= $mensagem ?></h2>
            <h2><?= $erro ?></h2>
            
<<<<<<< HEAD
            <a href="../../../index.php" class="bt-voltar">Voltar ao início</a>
=======
            <a href="{{ route('portfolio') }}" class="bt-voltar">Voltar ao início</a>
>>>>>>> df0f77ec3d5938d164180aa3a178fd3b71c1ff1c
        </form>
    </div>

</body>
</html>