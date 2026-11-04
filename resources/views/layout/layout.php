<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/layout.css">
</head>
<body>
    <!-- CABEÇALHO -->
    <header>
        <nav class="navbar">
            <h2 class="logo">
                Meu Portfólio
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

    <!-- CONTEÚDO DA ATIVIDADE -->
    <main class="pagina-projeto">
        <!-- CABEÇALHO DA ATIVIDADE -->
        <section class="cabecalho-projeto">
            <p class="projeto-tipo">
                Projeto
            </p>
            <h1>
                Cadastro de jogos
            </h1>
            <p>
                Atividade desenvolvida durante as aulas
                de Desenvolvimento de Sistemas
            </p>
        </section>

        <!-- ATIVIDADE...
            DESENVOLVA O PROJETO A PARTIR DAQUI -->
        <section class="conteudo-projeto">
            <h2>Cadastro de jogos</h2>
            <form method="POST">
                <label for="nome">Nome do jogo</label>
                <input type="text" id="nome" name="nome" maxlength="100" required>

                <label for="genero">Gênero</label>
                <input type="text" id="genero" name="genero" maxlength="50" required>

                <label for="nota">Nota</label>
                <input type="number" id="nota" name="nota" step="1" required>

                <label for="ano_lancamento">Ano de lançamento</label>
                <input type="number" id="ano_lancamento" name="ano_lancamento" step="1" required>

                <button type="submit">Cadastrar</button>
            </form>
        </section>

        <!-- FIM DA ATIVIDADE -->
        <div class="voltar-projetos">
            <a href="../index.php#projetos">Voltar para projetos</a>
        </div>
    </main>

    <!-- RODAPÉ -->
    <footer>
        <p>Desenvolvido por <a href= "https://luiz315.devlook.xyz/">Leomzito</a> - 2026</p>
    </footer>
</body>
</html>