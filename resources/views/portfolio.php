<?php
    require __DIR__ . "/../../config/conexao.php";

    echo "<br>Meu sistema está conectado!";

    $sql = "CREATE TABLE IF NOT EXISTS teste (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        idade INT NOT NULL
    )";

    $pdo->exec($sql);

    echo "<br>Tabela criada com sucesso!";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/index.css">
    <title>Meu Portfólio - Página Inicial</title>
</head>
<body>
    <header>        
        <nav class="navbar">

            <h2 class="logo">Meu Portfólio</h2>

            <ul class="menu">

                <li><a href="#inicio">Início</a></li>
                <li><a href="#sobre">Sobre</a></li>
                <li><a href="#habilidades">Habilidades</a></li>
                <li><a href="#projetos">Projetos</a></li>
                <li><a href="#contato">Contato</a></li>
            </ul>

        </nav>
    </header>
    <main>
        <section id="inicio" class="inicio">
            <div class="inicio-conteudo">

                <p class="saudaçao">Olá, eu sou</p>
                <h1>Luiz Eduardo Oliveira Muraski</h1>
                <h2>Desenvolvedor em formação</h2>
                <p>
                    Estudante de Desenvolvimento de Sistemas
                </p>
                <p>
                    Graduado em Administração
                </p>
                <p>
                    Meu objetivo é continuar evoluindo como
                    desenvolvedor, buscando sempre aprender 
                    novas tecnologias e aprimorar minhas 
                    habilidades.
                </p>
            </div>
        </section>
        
        <section id="sobre" class="secao">
            <h2 class="titulo-secao">Sobre mim</h2>
            <div class="sobre-conteudo">
                <div class="foto">
                    JS
                </div>
                <div class="sobre-texto">
                    <h3>Quem sou eu?</h3>
                    <p>
                        Meu nome é Luiz Eduardo e sou estudante
                        de Desenvolvimento de sistemas.
                    </p>
                    <p>
                        Atualmente estou estudando desenvolvimento 
                        web, programação e criação de sistemas.
                        Este portfólio reúne alguns dos projetos
                        desenvolvidos por mim.
                    </p>
                    <p>
                        Meu objetivo é continuar evoluindo como 
                        desenvolvedor e aprender novas tecnologias.
                    </p>
                </div>
            </div>
        </section>

        <section id="habilidades" class="secao secao-destaque">
            <h2 class="titulo-secao">Minhas habilidades</h2>
            <p class="subtitulo-secao">
                Algumas tecnologias que estou estudadando:
            </p>
            <div class="lista-habilidades" >
                <div class="habilidade">
                    HTML
                </div>
                <div class="habilidade">
                    CSS
                </div>
                <div class="habilidade">
                    PHP
                </div>
            </div>
        </section>

        <section id="projetos" class="secao">
            <h2 class="titulo-secao">Meus projetos</h2>
            <p class="subtitulo-secao">
                Alguns projetos desenvolvidos durante as aulas.
            </p>
            <div class="projetos-container">

                <!--PROJETO 1 -->

                <div class="projeto-card">
                    <div class="projeto-numero">
                        01
                    </div>
                    <h3>Verificação de idade</h3>
                    <p>
                        Sistema desenvolvido para praticar
                        formulários e manipulação de dados.
                    </p>
                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>PHP</span>                        
                    </div>
                    <a href="/resources/views/projetos/idade.php" class="link-projeto">
                        Ver projeto ->
                    </a>
                </div>

                <!--PROJETO 2 -->

                <div class="projeto-card">
                    <div class="projeto-numero">
                        02
                    </div>
                    <h3>Verificação de notas</h3>
                    <p>
                        Sistema desenvolvido para praticar
                        formulários e manipulação de dados.
                        Simulação de notas e média utilizando método POST.
                    </p>
                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>PHP</span>
                    </div>
                    <a href="/resources/views/projetos/notas.php" class="link-projeto">
                        Ver projeto ->
                    </a>
                </div>

                <!--PROJETO 3 -->

                <div class="projeto-card">
                    <div class="projeto-numero">
                        03
                    </div>
                    <h3>Verificação de notas - método GET</h3>
                    <p>
                        Sistema desenvolvido para praticar
                        formulários e manipulação de dados.
                        Simulação de notas e média utilizando método GET.
                    </p>
                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>PHP</span>
                    </div>
                    <a href="/resources/views/projetos/notas_get.php" class="link-projeto">
                        Ver projeto ->
                    </a>
                </div>

                <!--PROJETO 4 -->

                <div class="projeto-card">
                    <div class="projeto-numero">
                        04
                    </div>
                    <h3>Página de login</h3>
                    <p>
                        Sistema desenvolvido para praticar
                        formulários e manipulação de dados.
                        Simulação de login, utilizando usuário e senha.
                    </p>
                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>PHP</span>
                    </div>
                    <a href="/resources/views/projetos/login.php" class="link-projeto">
                        Ver projeto ->
                    </a>
                </div>

                <!--PROJETO 5 -->

                <div class="projeto-card">
                    <div class="projeto-numero">
                        05
                    </div>
                    <h3>Cadastro de jogos</h3>
                    <p>
                        Sistema desenvolvido para praticar
                        formulários e manipulação de dados.
                        Simulação de cadastro de jogos,
                        utilizando banco de dados MySQL, 
                        e bloqueio por login.
                    </p>
                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>PHP</span>
                    </div>
                    <a href="/resources/views/projetos/jogos.php" class="link-projeto">
                        Ver projeto ->
                    </a>
                </div>

                <!--PROJETO 6 -->

                <div class="projeto-card">
                    <div class="projeto-numero">
                        06
                    </div>
                    <h3>Helpdesk de TI</h3>
                    <p>
                        Sistema para registrar chamados de suporte técnico,
                        acompanhar atendimentos e gerenciar o status das solicitações.
                    </p>
                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>PHP</span>
                    </div>
                    <a href="/resources/views/projetos/helpdesk.php" class="link-projeto">
                        Ver projeto ->
                    </a>
                </div>
            </div>
        </section>

        <!-- CONTATO -->

        <section id="contato" class="secao secao-destaque">
            <h2 class="titulo-secao">Contato</h2>
            <p class="subtitulo-secao">
                Entre em contato:
            </p>
            <div class="contato-container">
                <div class="contato-item">
                    <h3>Email</h3>
                    <a href="mailto:leom3108@outlook.com">leom3108@outlook.com</a>
                </div>

                <div class="contato-item">
                    <h3>GitHub</h3>
                    <a href="https://github.com/Leomzito" target="_blank" rel="noopener noreferrer">
                        github.com/Leomzito
                    </a>
                </div>

                <div class="contato-item">
                    <h3>LinkedIn</h3>
                    <a href="https://www.linkedin.com/in/luiz-eduardo-oliveira-muraski-151227184/"
                    target="_blank" rel="noopener noreferrer">
                        Meu perfil no LinkedIn
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!--RODAPÉ -->

    <footer>
        <p>
            Desenvolvido por <a href= "https://luiz315.devlook.xyz/">Leomzito</a> - 2026
        </p>
    </footer>

    <!-- <nav>
    <a href="projetos/idade.php">Verificador de idade</a>
    <a href="projetos/notas.php">Verificador de notas</a>
    <a href="projetos/notas_get.php">Verificador de notas - metodo get</a>
    <a href="projetos/login.php">Página de login</a>
    <a href="projetos/jogos.php">Cadastro de jogos</a>
    </nav> -->
</body>
</html>

