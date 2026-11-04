<?php

$caminhoModelo = __DIR__ . "/../../../app/Models/Chamado.php";
require_once $caminhoModelo;

$modelo = new Chamado();
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $acao = $_POST["acao"] ?? "";

    if ($acao === "cadastrar") {
        $sucesso = $modelo->cadastrarChamados(
            $_POST["nome"] ?? "",
            $_POST["setor"] ?? "",
            $_POST["equipamento"] ?? "",
            $_POST["descricao"] ?? "",
            $_POST["prioridade"] ?? ""
        );
    } elseif ($acao === "atualizar") {
        $posicao = filter_input(INPUT_POST, "posicao", FILTER_VALIDATE_INT);
        $sucesso = $posicao !== false && $posicao !== null
            ? $modelo->atualizarChamado($posicao, $_POST["status"] ?? "")
            : false;
    } elseif ($acao === "excluir") {
        $posicao = filter_input(INPUT_POST, "posicao", FILTER_VALIDATE_INT);
        $sucesso = $posicao !== false && $posicao !== null
            ? $modelo->excluirChamado($posicao)
            : false;
    } else {
        $sucesso = false;
    }

    $mensagem = $sucesso
        ? "OperaÃ§Ã£o realizada com sucesso!"
        : "NÃ£o foi possÃ­vel realizar a operaÃ§Ã£o.";
}

$chamados = $modelo->lerChamados();
$relatorio = $modelo->gerarRelatorio();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk TI - Suporte TÃ©cnico</title>
    <link rel="stylesheet" href="/resources/css/helpdesk.css">
</head>
<body>

    <!-- NAVBAR FIXA -->
    <header>
        <div class="navbar">
            <div class="logo">Helpdesk <span>TI</span></div>
            <ul class="menu">
                <li><a href="/index.php">Página inicial</a></li>
                <li><a href="#inicio">Início</a></li>
                <li><a href="#relatorio">Relatório</a></li>
                <li><a href="#novo-chamado">Novo Chamado</a></li>
                <li><a href="#chamados">Chamados</a></li>
            </ul>
        </div>
    </header>

    <!-- INÃCIO / HERO -->
    <section class="inicio" id="inicio">
        <div class="inicio-conteudo">
            <p class="saudacao">Setor de Tecnologia da InformaÃ§Ã£o</p>
            <h1>Gerenciamento de Chamados</h1>
            <p>Registre problemas técnicos, acompanhe o andamento dos atendimentos e gerencie o suporte da empresa em um só lugar.</p>
            <a href="#novo-chamado" class="botao">Abrir Chamado</a>
        </div>
    </section>

    <!-- SEÃ‡ÃƒO RELATÃ“RIO -->
    <section class="secao" id="relatorio">
        <h2 class="titulo-secao">Relatório de Atendimentos</h2>
        <p class="subtitulo-secao">Resumo estatístico dos chamados registrados no sistema</p>
        
        <div class="relatorio-container">
            <div class="card-stat">
                <h3>Total Registrados</h3>
                <div class="card-stat-numero"><?php echo $relatorio["total"]; ?></div>
            </div>
            <div class="card-stat abertos">
                <h3>Abertos</h3>
                <div class="card-stat-numero"><?php echo $relatorio["abertos"]; ?></div>
            </div>
            <div class="card-stat em-andamento">
                <h3>Em Andamento</h3>
                <div class="card-stat-numero"><?php echo $relatorio["andamento"]; ?></div>
            </div>
            <div class="card-stat resolvidos">
                <h3>Resolvidos</h3>
                <div class="card-stat-numero"><?php echo $relatorio["resolvidos"]; ?></div>
            </div>
        </div>
    </section>

    <!-- SESSÃO FORMULÁRIO (DESTAQUE) -->
    <section class="secao-destaque" id="novo-chamado">
        <h2 class="titulo-secao">Abrir Novo Chamado</h2>
        <p class="subtitulo-secao">Preencha o formulário abaixo para solicitar suporte técnico</p>

        <div class="formulario-card">
            <?php if ($mensagem !== ""): ?>
                <p class="mensagem" role="status"><?php echo htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8"); ?></p>
            <?php endif; ?>
            <form method="POST">
                <input type="hidden" name="acao" value="cadastrar">

                <div class="form-grid">
                    <div class="form-group">
                        <label for="nome">Nome do Solicitante:</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>
                    </div>

                    <div class="form-group">
                        <label for="setor">Setor da Empresa:</label>
                        <select name="setor" id="setor">
                            <option value="Produção">Produção</option>
                            <option value="Administrativo">Administrativo</option>
                            <option value="Logística">Logística</option>
                            <option value="Financeiro">Financeiro</option>
                            <option value="TI">TI</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="equipamento">Equipamento Afetado:</label>
                        <select name="equipamento" id="equipamento">
                            <option value="Computador">Computador</option>
                            <option value="Impressora">Impressora</option>
                            <option value="Rede">Rede</option>
                            <option value="Sistema">Sistema</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="prioridade">Prioridade:</label>
                        <select name="prioridade" id="prioridade">
                            <option value="Baixa">Baixa</option>
                            <option value="Média">Média</option>
                            <option value="Alta">Alta</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="descricao">Descrição do Problema:</label>
                        <textarea id="descricao" name="descricao" placeholder="Descreva detalhadamente a falha ou solicitação..." required></textarea>
                    </div>
                </div>

                <button type="submit" class="botao">Enviar Chamado</button>
            </form>
        </div>
    </section>

    <!-- SESSÃO LISTAGEM DE CHAMADOS -->
    <section class="secao" id="chamados">
        <h2 class="titulo-secao">Lista de Chamados</h2>
        <p class="subtitulo-secao">Consulte, altere o status ou exclua os chamados registrados</p>

        <div class="tabela-container">
            <table>
                <thead>
                    <tr>
                        <th># ID</th>
                        <th>Solicitante</th>
                        <th>Setor</th>
                        <th>Equipamento</th>
                        <th>Descrição</th>
                        <th>Prioridade</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($chamados)): ?>
                        <tr>
                            <td colspan="8" style="text-align: center; color: #777; padding: 30px;">
                                Nenhum chamado registrado atÃ© o momento.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($chamados as $posicao => $chamado): ?>
                            <tr>
                                <td><strong>#<?php echo $posicao; ?></strong></td>
                                <td><strong><?php echo htmlspecialchars($chamado['nome']); ?></strong></td>
                                <td><?php echo ucfirst($chamado['setor']); ?></td>
                                <td><?php echo ucfirst($chamado['equipamento']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($chamado['descricao'])); ?></td>
                                <td>
                                    <?php 
                                        $prioridadeClass = strtolower($chamado['prioridade']);
                                        if ($prioridadeClass == 'mÃ©dia' || $prioridadeClass == 'media') $prioridadeClass = 'media';
                                    ?>
                                    <span class="badge badge-prioridade-<?php echo $prioridadeClass; ?>">
                                        <?php echo ucfirst($chamado['prioridade']); ?>
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" class="form-inline">
                                        <input type="hidden" name="acao" value="atualizar">
                                        <input type="hidden" name="posicao" value="<?php echo $posicao; ?>">
                                        
                                        <select name="status">
                                            <option value="Aberto" <?php if($chamado['status'] == 'Aberto') echo 'selected'; ?>>Aberto</option>
                                            <option value="Em andamento" <?php if($chamado['status'] == 'Em andamento') echo 'selected'; ?>>Em andamento</option>
                                            <option value="Resolvido" <?php if($chamado['status'] == 'Resolvido') echo 'selected'; ?>>Resolvido</option>
                                        </select>
                                        <button type="submit" class="botao-atualizar">OK</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="acao" value="excluir">
                                        <input type="hidden" name="posicao" value="<?php echo $posicao; ?>">
                                        <button type="submit" class="botao-excluir">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- RODAPÉ -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Helpdesk TI - Sistema de Gerenciamento de Chamados Técnicos</p>
    </footer>

</body>
</html>

