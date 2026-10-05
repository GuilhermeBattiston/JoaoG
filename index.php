<?php
    require "conexao.php";
    
    echo "Sistema conectado";

    $sql = "CREATE TABLE IF NOT EXISTS teste (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100),
        idade INT
    )";

    $pdo->exec($sql);

    echo "Tabela criada com sucesso";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/index.css">
    <title>Document</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <h2 class="logo">Meu Portifólio</h2>

            <ul class="menu">
                <li><a href="#inicio">Verificador de Idade</a><br><br></li>
                <li><a href="#sobre">Verificador de Notas</a><br><br></li>
                <li><a href="#habilidades">Desafio-Notas</a><br><br></li>
                <li><a href="#projetos">Login</a><br><br></li>
                <li><a href="#contato">Jogos(MySql)</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="inicio" class="inicio">
            <div class="inicio-conteudo">
                <p class="saudacao">Olá! Eu sou</p>
                <h1>João Guilherme P. Lopes</h1>

                <p>
                    Aluno de Análise e Desenvolvimento de Sistemas4
                </p>

                <a href="#projetos" class="botao">
                    Veja meus projetos
                </a>
            </div>
        </section>
        <section id="sobre" class="secao">
            <h2 class="titulo-secao">Sobre mim</h2>
            <div class="sobre-conteudo">
                <h3>Quem sou eu?</h3>
                <p>
                    Meu nome é João Guilherme Prado Lopes e sou aluno
                    de Analise de Desenvolvimento de Sistemas
                </p>

                <p> Atualmente estou ainda tendo aulas e não conclui o curso. 
                    Este portfólio reúne alguns dos projetos dsenvolvidos por mim
                     durante o curso
                </p>
                <p>
                    Meu objetivo é continuar evoluindo como desenvolvedor
                    durante a duração do curso
                </p>
            </div>
        </section>
        
        <section id="habilidades" class="secao-destaque">
            <h2 class="titulo-secao">Minhas habilidades</h2>
            <p class="subtitulo-secao">
                Algumas tecnologias que estou estudando:
            </p>
            <div class="lista-habilidades">
                <div class="habilidade">
                    HTML
                </div>
                <div class="habilidade">
                    CSS
                </div>
                <div class="habilidade">
                    PHP
                </div>
                <div class="habiliade">
                    PYTHON
                </div>
                <div class="habiliade">
                    NODE.JS
                </div>
                <div class="habiliade">
                    REACT
                </div>
            </div>
        </section>
        <section id="projetos" class="secao">
            <h2 class="titulo-secao">Meus Projetos</h2>
            <p class="subtitulo-secao">
                Alguns projetos desenvolvidos durante o curso.
            </p>

            <div class="projetos-container">
                <div class="projetos-container">
                    <div class="projeto-numero">
                        01
                    </div>
                    <h3>Verificação de Idade</h3>
                    <p>
                        Sistema desenvolvido para praticar
                        formulário e manipulação de dados.
                    </p>
                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>PHP</span>
                    </div>
                    <a href="projetos/idades.php" class="link-projeto">
                        Ver projeto ->
                    </a>
                </div>
            </div>
             <div class="projetos-container">
                <div class="projetos-container">
                    <div class="projeto-numero">
                        02
                    </div>
                    <h3>Cadastro de Jogos</h3>
                    <p>
                        Sistema desenvolvido para praticar
                        formulário e manipulação de dados integrado
                        com um banco sql que requer senha
                        e usuário para acesar.
                    </p>
                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>PHP</span>
                        <span>SQL</span>
                    </div>
                    <a href="projetos/jogos.php" class="link-projeto">
                        Ver projeto ->
                    </a>
                </div>
            </div>
            <div class="projetos-container">
                <div class="projetos-container">
                    <div class="projeto-numero">
                        03
                    </div>
                    <h3>Verificação de Notas</h3>
                    <p>
                        Sistema desenvolvido para praticar
                        formulário e manipulação de dados.
                    </p>
                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>PHP</span>
                    </div>
                    <a href="projetos/idades.php" class="link-projeto">
                        Ver projeto ->
                    </a>
                </div>
            </div>
            <div class="projetos-container">
                <div class="projetos-container">
                    <div class="projeto-numero">
                        04
                    </div>
                    <h3>Verificação de Login</h3>
                    <p>
                        Sistema desenvolvido para praticar
                        formulário e manipulação de dados e login.
                    </p>
                    <div class="tecnologias">
                        <span>HTML</span>
                        <span>CSS</span>
                        <span>PHP</span>
                    </div>
                    <a href="projetos/senha.php" class="link-projeto">
                        Ver projeto ->
                    </a>
                </div>
            </div>
        </section>
        <section id="contato" class="secao">
            <h2 class="titulo-secao">Contato</h2>
            <p class="subtitulo-secao">
                Quer entrar em contato comigo?
            </p>
            <div  class="contato-container">
                <div class="contato-item">
                    <h3>Email:</h3>
                    <p>joaoguilhermepradolopes@gmail.com</p>
                </div>
                <div class="contato-item">
                    <h3>Github:</h3>
                    <p>github.com/GuilhermeBattiston</p>
                </div>
            </div>

        </section>
    </main>
</body>
</html>