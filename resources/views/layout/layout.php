<?php

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/layout.css">
    <title>Layout de Atividades | Meu Portfólio</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <h2 class="logo">
                Meu portfólio
            </h2>
            <ul class="menu">
                <li>
                    <a href="../index.php">Início</a>
                </li>
                <li>
                    <a href="../index.php#projetos">Projetos</a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="pagina-projeto">
        <section class="cabecalho-projeto">
            <p class="projeto-tipo">
                Projeto
            </p>
            <h1>
                Cadastro de Jogos
            </h1>
            <p>
                Atividade desenvolvida durante as aulas
                de Desenvolvimento de Sistemas.
            </p>
        </section>

        <section class="conteudo-projeto">
            <h2>Cadastro de Jogos</h2>
            <form method="POST">
                <input type="text" id="usuario" name="usuario" placeholder="Digite o usuário"> <br><br>    
                <input type="text" id="senha" name="senha" placeholder="Digite a senha"> <br><br>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome do jogo"> <br><br>
                <input type="text" id="genero" name="genero" placeholder="Digite o gênero do jogo"> <br><br>
                <input type="number" id="nota" name="nota" placeholder="Digite a nota do jogo"> <br><br>
                <input type="number" id="ano_lancamento" name="ano_lancamento" placeholder="Digite o ano do lançamento">
                <button type="submit">Enviar</button>
            </form>
        </section>

        <div class="voltar-projetos">
            <a href="../index.php#projetos"> ← Voltar para projetos</a>
        </div>
    </main>

    <footer>
        <p>Desenvolvido por <a href="felipeg315.devlook.xyz">Felipe Pantarotti</a>• 2026</p>

    </footer>

</body>
</html>
