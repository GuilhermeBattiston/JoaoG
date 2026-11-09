<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/helpdesk.css'])
    <title>Sistema de Chamados</title>
</head>
<body>
    @include('projetos.erros')

    <?php if (!empty($mensagem)): ?>
        <div style="padding: 10px; background-color: #f0f0f0; margin-bottom: 15px;">
            <strong><?php echo e($mensagem); ?></strong>
        </div>
    <?php endif; ?>

    <form method="POST" class="formulario-card">
            @csrf
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="setor">Setor da empresa:</label>
        <select name="setor" id="setor">
            <option value="producao">Produção</option>
            <option value="administrativo">Administrativo</option>
            <option value="logistica">Logística</option>
            <option value="financeiro">Financeiro</option>
            <option value="ti">TI</option>
        </select>

        <label for="equipamento">Equipamento afetado:</label>
        <select name="equipamento" id="equipamento">
            <option value="computador">Computador</option>
            <option value="impressora">Impressora</option>
            <option value="rede">Rede</option>
            <option value="sistema">Sistema</option>
            <option value="outro">Outro</option>
        </select>

        <label for="descricao">Descrição do problema:</label>
        <textarea id="descricao" name="descricao" required></textarea>

        <label for="prioridade">Prioridade:</label>
        <select name="prioridade" id="prioridade">
            <option value="baixa">Baixa</option>
            <option value="media">Média</option>
            <option value="alta">Alta</option>
        </select>

        <input type="hidden" name="acao" value="cadastrar">
        <button type="submit" class="botao">Enviar</button>
        <a href="/index.php" class="bt-voltar">Voltar ao início</a>
    </form>

    <h2>Lista Dos Chamados</h2>
    <div class="tabela-container" role="region" aria-label="Registros cadastrados" tabindex="0"><table>
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
                    <td><?php echo e($posicao); ?></td>
                    <td><?php echo e($chamado['nome'] ?? ''); ?></td>
                    <td><?php echo e($chamado['setor'] ?? ''); ?></td>
                    <td><?php echo e($chamado['equipamento'] ?? ''); ?></td>
                    <td><?php echo nl2br(e($chamado['descricao'] ?? '')); ?></td>
                    <td><?php echo e($chamado['prioridade'] ?? ''); ?></td>
                    
                    <td>
                        <form method="POST" class="form-inline">
            @csrf
                            <input type="hidden" name="acao" value="atualizar">
                            <input type="hidden" name="posicao" value="<?php echo $posicao; ?>">
                            
                            <select name="status" aria-label="Status do chamado {{ $posicao }}">
                                <option value="Aberto" <?php if(($chamado['status'] ?? '') === 'Aberto') echo 'selected'; ?>>Aberto</option>
                                <option value="Em andamento" <?php if(($chamado['status'] ?? '') === 'Em andamento') echo 'selected'; ?>>Em andamento</option>
                                <option value="Resolvido" <?php if(($chamado['status'] ?? '') === 'Resolvido') echo 'selected'; ?>>Resolvido</option>
                            </select>
                            <button type="submit" class="botao-atualizar">OK</button>
                        </form>
                    </td>

                    <td>
                        <form method="POST" onsubmit="return confirm('Deseja realmente excluir este chamado?');">
            @csrf
                            <input type="hidden" name="acao" value="excluir">
                            <input type="hidden" name="posicao" value="<?php echo $posicao; ?>">
                            <button type="submit" class="botao-excluir">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table></div>   

    <div>
        <h3>Relatório de Atendimentos</h3>
        <p>Total de chamados: <?php echo e($relatorio["total"] ?? 0); ?></p>
        <p>Abertos: <?php echo e($relatorio["abertos"] ?? 0); ?></p>
        <p>Em andamento: <?php echo e($relatorio["andamento"] ?? 0); ?></p>
        <p>Resolvidos: <?php echo e($relatorio["resolvidos"] ?? 0); ?></p>
    </div>

</body>
</html>
