<?php $nome = $nome ?? ''; $idade = $idade ?? ''; $frequencia = $frequencia ?? ''; $media = $media ?? ''; $pontos = $pontos ?? ''; $resultado = $resultado ?? ''; $resultado_class = $resultado_class ?? ''; $erro = ''; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/style.css'])
    <title>Verificador de notas</title>
</head>
<body>
    @include('projetos.erros')
<div class="container">          
    <form method="POST">
            @csrf
        <label for="name">Digite seu nome</label>
        <input type="text" id="name" name="name" placeholder="Digite seu nome"> <br><br>
        <label for="idade">Digite sua Idade</label>
        <input type="number" id="idade" name="idade" placeholder="Digite sua Idade"> <br><br>
        <label for="frequencia">Digite sua Frequencia %</label>
        <input type="number" id="frequencia" name="frequencia" placeholder="Digite sua Frequencia %"> <br><br>
        <label for="nota1">Digite sua primeira nota</label>
        <input type="number" step="any" id="nota1" name="nota1" placeholder="Digite sua primeira nota"> <br><br>
        <label for="nota2">Digite sua segunda nota</label>
        <input type="number" step="any" id="nota2" name="nota2" placeholder="Digite sua segunda nota"> <br><br>
        <label for="nota3">Digite sua terceira nota</label>
        <input type="number" step="any" id="nota3" name="nota3" placeholder="Digite sua terceira nota"> <br><br>
        <label for="nota4">Digite sua quarta nota</label>
        <input type="number" step="any" id="nota4" name="nota4" placeholder="Digite sua quarta nota"> <br><br>
        <label for="nota5">Digite sua quinta nota</label>
        <input type="number" step="any" id="nota5" name="nota5" placeholder="Digite sua quinta nota"> <br><br>

        <button type="submit">Enviar</button>
    </form>

    <h2>Aluno: {{ $nome }}</h2>
    <h2>Idade:<?= $idade ?></h2>
    <h2>Frequência do aluno: <?= $frequencia ?>%</h2>
    <h2>Média calculada:<?= $media ?></h2>
    <h2>Faltam <?= $pontos ?> para atingir a média</h2>
    <h2>Situação do aluno: <span class="<?= $resultado_class ?>"><?= $resultado ?></span></h2>
    <h2><?= $erro ?></h2>

    <a href="{{ route('portfolio') }}" class="bt-voltar">Voltar ao início</a>
</div>
</body>
</html>
