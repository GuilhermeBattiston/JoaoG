<?php
require_once __DIR__ . "/../../../app/Models/Chamado.php";

// Instancia o objeto da classe Chamado
$chamadoObj = new Chamado();
$mensagem = "";

// Processa requisições POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $acao = $_POST["acao"] ?? "";

    if ($acao === "cadastrar") {
        $sucesso = $chamadoObj->cadastrarChamados(
            $_POST["nome"] ?? "",
            $_POST["setor"] ?? "",
            $_POST["equipamento"] ?? "",
            $_POST["descricao"] ?? "",
            $_POST["prioridade"] ?? ""
        );

        $mensagem = $sucesso ? "Chamado cadastrado com sucesso!" : "Erro ao cadastrar. Verifique os dados.";
    }
    
    if ($acao === "atualizar") {
        $sucesso = $chamadoObj->atualizarChamado(
            (int) ($_POST["posicao"] ?? -1),
            $_POST["status"] ?? ""
        );

        $mensagem = $sucesso ? "Status atualizado!" : "Não foi possível atualizar.";
    }

    if ($acao === "excluir") {
        $sucesso = $chamadoObj->excluirChamado((int) ($_POST["posicao"] ?? -1));

        $mensagem = $sucesso ? "Chamado excluído!" : "Não foi possível excluir.";
    }
}

// Carrega a lista atualizada e o relatório
$chamados = $chamadoObj->lerChamados();
$relatorio = $chamadoObj->gerarRelatorio();

function escapar($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/helpdesk.css">
    <title>Sistema de Chamados</title>
</head>
<body>

    <?php if (!empty($mensagem)): ?>
        <div style="padding: 10px; background-color: #f0f0f0; margin-bottom: 15px;">
            <strong><?php echo escapar($mensagem); ?></strong>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>Setor da empresa:</label>
        <select name="setor" id="setor">
            <option value="producao">Produção</option>
            <option value="administrativo">Administrativo</option>
            <option value="logistica">Logística</option>
            <option value="financeiro">Financeiro</option>
            <option value="ti">TI</option>
        </select>

        <label>Equipamento afetado:</label>
        <select name="equipamento" id="equipamento">
            <option value="computador">Computador</option>
            <option value="impressora">Impressora</option>
            <option value="rede">Rede</option>
            <option value="sistema">Sistema</option>
            <option value="outro">Outro</option>
        </select>

        <label>Descrição do problema:</label>
        <textarea name="descricao" required></textarea>

        <label>Prioridade:</label>
        <select name="prioridade" id="prioridade">
            <option value="baixa">Baixa</option>
            <option value="media">Média</option>
            <option value="alta">Alta</option>
        </select>

        <input type="hidden" name="acao" value="cadastrar">
        <button type="submit">Enviar</button>
        <a href="/index.php" class="bt-voltar">Voltar ao início</a>
    </form>

    <h2>Lista Dos Chamados</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Setor</th>
                <th>Equipamento</th>
                <th>Descrição</th>
                <th>Prioridade</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($chamados as $posicao => $chamado): ?>
                <tr>
                    <td><?php echo escapar($posicao); ?></td>
                    <td><?php echo escapar($chamado['nome'] ?? ''); ?></td>
                    <td><?php echo escapar($chamado['setor'] ?? ''); ?></td>
                    <td><?php echo escapar($chamado['equipamento'] ?? ''); ?></td>
                    <td><?php echo nl2br(escapar($chamado['descricao'] ?? '')); ?></td>
                    <td><?php echo escapar($chamado['prioridade'] ?? ''); ?></td>
                    
                    <td>
                        <form method="POST">
                            <input type="hidden" name="acao" value="atualizar">
                            <input type="hidden" name="posicao" value="<?php echo $posicao; ?>">
                            
                            <select name="status">
                                <option value="Aberto" <?php if(($chamado['status'] ?? '') === 'Aberto') echo 'selected'; ?>>Aberto</option>
                                <option value="Em andamento" <?php if(($chamado['status'] ?? '') === 'Em andamento') echo 'selected'; ?>>Em andamento</option>
                                <option value="Resolvido" <?php if(($chamado['status'] ?? '') === 'Resolvido') echo 'selected'; ?>>Resolvido</option>
                            </select>
                            <button type="submit">OK</button>
                        </form>
                    </td>

                    <td>
                        <form method="POST" onsubmit="return confirm('Deseja realmente excluir este chamado?');">
                            <input type="hidden" name="acao" value="excluir">
                            <input type="hidden" name="posicao" value="<?php echo $posicao; ?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>   

    <div>
        <h3>Relatório de Atendimentos</h3>
        <p>Total de chamados: <?php echo escapar($relatorio["total"] ?? 0); ?></p>
        <p>Abertos: <?php echo escapar($relatorio["abertos"] ?? 0); ?></p>
        <p>Em andamento: <?php echo escapar($relatorio["andamento"] ?? 0); ?></p>
        <p>Resolvidos: <?php echo escapar($relatorio["resolvidos"] ?? 0); ?></p>
    </div>

</body>
</html>
