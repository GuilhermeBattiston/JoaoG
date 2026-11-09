<?php $mensagem = session('mensagem', ''); $maquinas = session('maquinas', []); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/style.css'])
    <title>Produção</title>
</head>
<body>
    @include('projetos.erros')
    <form method="POST">
            @csrf

        <label for="nome">Nome da máquina</label>
        <input type="text" id="nome" name="nome" required>

        <label for="tipo">Tipo da máquina</label>
        <select name="tipo" id="tipo" required>
            <option value="esteira">Esteira</option>
            <option value="prensa">Prensa</option>
            <option value="robosoldagem">Robô de Soldagem</option>
        </select>

        <label for="quantidade">Quantidade da produção</label>
        <input type="number" id="quantidade" name="quantidade" min="1" required>

        <button type="submit">Registro da Produção</button>
    </form>

    <?php if ($mensagem !== ""): ?>
    <p><?= e($mensagem) ?></p>
    <?php endif; ?>

    <?php if (!empty($maquinas)): ?>
    <div class="tabela-container" role="region" aria-label="Registros cadastrados" tabindex="0"><table>
        <thead>
            <tr>
                <th>Nome da Máquina</th>
                <th>Tipo</th>
                <th>Quantidade Produzida</th><th>Operação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($maquinas as $maquina): ?>
                <tr>
                    <td><?= e($maquina['nome']) ?></td>
                    <td>{{ ['esteira' => 'Esteira', 'prensa' => 'Prensa', 'robosoldagem' => 'Robô de Soldagem'][$maquina['tipo']] }}</td>
                    <td><?= $maquina['quantidade'] ?> unidades</td>
                    <td><?= ['esteira' => 'Transportando peças...', 'prensa' => 'Prensando peças...', 'robosoldagem' => 'Soldando peças...'][$maquina['tipo']] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table></div>
<?php endif; ?>
<a href="{{ route('portfolio') }}">Voltar ao início</a>
</body>
</html>
