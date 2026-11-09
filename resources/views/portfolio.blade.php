<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['/resources/css/index.css'])
    <link rel="stylesheet" href="/resources/css/index.css">
    <title>Portfólio</title>
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

                <p class="saudacao">Olá! Eu sou</p>
                <h1>Felipe Pantarotti</h1>
                <h2>Desenvolvedor em formação</h2>
                <p>Estou em constante aprendizado na área de desenvolvimento de sistemas. 
                    Busco aprimorar minhas habilidades em programação, 
                    desenvolver soluções criativas e transformar ideias em projetos funcionais.
                </p>

                <a href="#projetos" class="botao">
                    Ver meus projetos
                </a>
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
                        Meu nome é Felipe Pantarotti e sou estudante de Desenvolvimento de Sistemas, com foco em programação e desenvolvimento web.
                        Estou sempre buscando aprender novas tecnologias, aperfeiçoar minhas habilidades e colocar meus conhecimentos em prática 
                        por meio de projetos que envolvam lógica de programação, criação de interfaces e desenvolvimento de sistemas.
                        Este portfólio reúne alguns dos meus projetos, minha evolução como desenvolvedor e minha dedicação em construir soluções cada vez melhores. 
                        Estou em busca de oportunidades para adquirir experiência, colaborar com equipes e crescer profissionalmente na área de tecnologia. 
                    </p>
                </div>
            </div>
        </section>

        <section id="habilidades" class="secao secao-destaque">
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
                <div class="habilidade">
                    JAVA SCRIPT
                </div>
                <div class="habilidade">
                    REACT
                </div>
                <div class="habilidade">
                    LINGUAGEM C
                </div>
                <div class="habilidade">
                    PYTHON
                </div>
            </div>
        </section>
        
        <section>
            <section id="projetos" class="secao">
                <h2 class="titulo-secao">Meus Projetos</h2>
                <p class="subtitulo-secao">
                    Alguns projetos desenvolvidos durantes as aulas.
                </p>
                <div class="projetos-container">
                    <!-- PROJETO 1 -->
                     <div class="projeto-card">
                        <div class="projeto-numero">
                            01
                        </div>
                        <h3>Verificação de Idade</h3>
                        <p>
                            Aplicação desenvolvida em PHP que verifica se uma pessoa é maior ou menor de idade 
                            com base na idade informada, utilizando formulários HTML e estilização em CSS.
                        </p>
                        <div class="tecnologia">
                            <span>HTML</span>
                            <span>CSS</span>
                            <span>PHP</span>
                        </div>
                        <a href=" {{ route('helpdesk') }}" class="link-projeto">
                            Ver projeto
                        </a>

                     </div>
                     <!-- PROJETO 2 -->
                     <div class="projeto-card">
                        <div class="projeto-numero">
                            02
                        </div>
                        <h3>Verificador de notas escolares</h3>
                        <p>
                            Sistema em PHP que calcula a média ponderada de um aluno e determina sua situação escolar 
                            com base nas notas e na frequência, exibindo os resultados dinamicamente.
                        </p>
                        <div class="tecnologia">
                            <span>HTML</span>
                            <span>CSS</span>
                            <span>PHP</span>
                        </div>
                        <a href="/resources/views/projetos/notas.php" class="link-projeto">
                            Ver projeto
                        </a>
                     </div>

                     <!-- PROJETO 3 -->
                     <div class="projeto-card">
                        <div class="projeto-numero">
                            03
                        </div>
                        <h3>Sistema de login básico</h3>
                        <p>
                            Aplicação em PHP que verifica as credenciais informadas pelo usuário 
                            e exibe mensagens de sucesso ou erro, com interface estilizada em CSS.
                        <div class="tecnologia">
                            <span>HTML</span>
                            <span>CSS</span>
                            <span>PHP</span>
                        </div>
                        <a href="/resources/views/projetos/login-basico.php" class="link-projeto">
                            Ver projeto
                        </a>
                     </div>

                     <!-- PROJETO 4 -->
                     <div class="projeto-card">
                        <div class="projeto-numero">
                            04
                        </div>
                        <h3>Cadastro de jogos</h3>
                        <p>
                            Sistema desenvolvido em PHP e SQL para cadastrar e listar jogos eletrônicos, 
                            armazenando informações como nome, gênero, nota e ano de lançamento.
                        </p>
                        <div class="tecnologia">
                            <span>HTML</span>
                            <span>CSS</span>
                            <span>PHP</span>
                        </div>
                        <a href="/resources/views/projetos/jogos.php" class="link-projeto">
                            Ver projeto
                        </a>
                     </div>

                     <!-- PROJETO 5 -->
                     <div class="projeto-card">
                        <div class="projeto-numero">
                            05
                        </div>
                        <h3>Sistema Help Desk para Gerenciar Chamados</h3>
                        <p>
                            Aplicação em PHP para gerenciar chamados de suporte técnico, permitindo cadastrar solicitações, 
                            atualizar status, excluir registros e visualizar relatórios de atendimento com armazenamento em JSON.
                        </p>
                        <div class="tecnologia">
                            <span>HTML</span>
                            <span>CSS</span>
                            <span>PHP</span>
                            <span>JSON</span>
                        </div>
                        <a href="/resources/views/projetos/helpdesk.php" class="link-projeto">
                            Ver projeto
                        </a>
                     </div>

                     <!-- PROJETO 6 -->
                     <div class="projeto-card">
                        <div class="projeto-numero">
                            06
                        </div>
                        <h3>Sistema para gerenciar Cadastro de máquinas</h3>
                        <p>
                            Sistema em PHP que permite cadastrar máquinas industriais, registrar a quantidade produzida e visualizar os dados dinamicamente, 
                            aplicando conceitos de Programação Orientada a Objetos, como herança, abstração e polimorfismo.
                        </p>
                        <div class="tecnologia">
                            <span>HTML</span>
                            <span>CSS</span>
                            <span>PHP</span>
                        </div>
                        <a href="/resources/views/projetos/poo2.php" class="link-projeto">
                            Ver projeto
                        </a>
                     </div>
                </div>
            </section>

            <section id=contato class="secao secao-destaque">
                <h2 class="titulo-secao">Contato</h2>
                <p class="subtitulo-secao">
                    Quer entrar em contato comigo?
                </p>
                <div class="contato-container">
                    <div class="contato-item">
                        <h3>Email</h3>
                        <p>felipepantarotti@gmail.com</p>
                    </div>
                    <div class="contato-item">
                        <h3>GitHub</h3>
                        <p>github.com/FelipePantarotti</p>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <footer>
        <p>
            Desenvolvido por <a href="felipeg315.devlook.xyz"> Felipe Pantarotti</a> • 2026
        </p>
    </footer>
</body>
</html>