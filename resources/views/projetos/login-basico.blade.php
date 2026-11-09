<?php $mensagem = $mensagem ?? ''; $erro = ''; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <button type="submit">Enviar</button>

            <h2><?= $mensagem ?></h2>
            <h2><?= $erro ?></h2>
            
            <a href="{{ route('portfolio') }}" class="bt-voltar">Voltar ao início</a>
        </form>
    </div>

</body>
</html>