<?php $nome = $nome ?? ''; $resultado = $resultado ?? ''; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/style.css'])
    <title>Verificador de idade</title>
</head>
<body>
    @include('projetos.erros')
    <div class="container">
        

    <form method="POST">
            @csrf
        
        <label for="name">Digite seu nome</label>
        <input type="text" id="name" name="name" placeholder="Digite seu nome">

        <label for="idade">Digite sua Idade</label>
        <input type="number" id="idade" name="idade" placeholder="Digite sua Idade">

        <button type="submit">Enviar</button>

        
    </form>

    <?php if ($resultado != "") { ?>

        <h2>{{ $nome }} é <?= $resultado ?>.</h2>

    <?php } ?>
    <a href="{{ route('portfolio') }}" class="bt-voltar">Voltar ao início</a>
    </div>
</body>
</html>