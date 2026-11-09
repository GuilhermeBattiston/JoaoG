<?php $mensagem = session('mensagem', ''); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/jogos.css'])
    <title>Cadastro de jogos</title>
</head>
<body>
    @include('projetos.erros')
<div class="container">
    <form method="POST">
            @csrf
        <label for="usuario">Digite o usuário</label>
        <input type="text" id="usuario" name="usuario" placeholder="Digite o usuário"> <br><br>    
        <label for="senha">Digite a senha</label>
        <input type="password" id="senha" name="senha" placeholder="Digite a senha"> <br><br>
        <label for="nome">Digite o nome do jogo</label>
        <input type="text" id="nome" name="nome" placeholder="Digite o nome do jogo"> <br><br>
        <label for="genero">Digite o gênero do jogo</label>
        <input type="text" id="genero" name="genero" placeholder="Digite o gênero do jogo"> <br><br>
        <label for="nota">Digite a nota do jogo</label>
        <input type="number" id="nota" name="nota" placeholder="Digite a nota do jogo"> <br><br>
        <label for="ano_lancamento">Digite o ano do lançamento</label>
        <input type="number" id="ano_lancamento" name="ano_lancamento" placeholder="Digite o ano do lançamento">
        <button type="submit">Enviar</button>
            
        <a href="{{ route('portfolio') }}" class="bt-voltar">Voltar ao início</a>
    </form>

    <?php if ($mensagem != "") { ?>
        <p>
            <?= $mensagem ?>
        </p>
    <?php } ?>

    <h2>JOGOS CADASTRADOS</h2>
    <div class="tabela-container" role="region" aria-label="Registros cadastrados" tabindex="0"><table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Gênero</th>
            <th>Nota</th>
            <th>Ano de Lançamento</th>
        </tr>

        <!-- foreach() -> Para cada item nessa lista, faça alguma coisa com x variável -->
        <?php foreach($jogos as $jogo) { ?>
            <tr>
                <td><?= $jogo["id"] ?></td>
                <td>{{ $jogo["nome"] }}</td>
                <td>{{ $jogo["genero"] }}</td>
                <td><?= $jogo["nota"] ?></td>
                <td><?= $jogo["ano_lancamento"] ?></td>
            </tr>
        <?php } ?>

    </table></div>
</div>
</body>
</html>
