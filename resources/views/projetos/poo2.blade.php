<<<<<<< HEAD
<?php
// ==========================================
// SISTEMA DE CONTROLE DE PRODUÇÃO INDUSTRIAL
// ==========================================

// 1. CLASSE ABSTRATA
abstract class Maquina {
    public $nome;
    private $producao;

    public function __construct($nome){
        $this->nome = $nome;
        $this->producao = 0;
    }

    public function getProducao(){
        return $this->producao;
    }

    public function registrarProducao($quantidade){
        if ($quantidade <= 0){
            return false;
        }

        $this->producao += $quantidade;
        return true;
    }

    // ABSTRAÇÃO
    abstract public function operar();
}

// 2. HERANÇA
class Esteira extends Maquina {
    public function operar(){
        return "Transportando peças...";
    }
}

class Prensa extends Maquina {
    public function operar(){
        return "Prensando peças...";
    }
}

class RoboSoldagem extends Maquina {
    public function operar(){
        return "Soldando peças...";
    }
}

// 3. SESSÃO = ARMAZENAMENTO TEMPORÁRIO
if (!isset($_SESSION["máquinas"])){
    $_SESSION["máquinas"] = [];
}

$mensagem = "";

// 4. RECEBER FORMULÁRIO VIA POST
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = $_POST["nome"] ?? "";
    $tipo = $_POST["tipo"] ?? "";
    $quantidade = $_POST["quantidade"] ?? null;

    if ($nome === "" ||
        $quantidade === false ||
        $quantidade <= 0){
        $mensagem = "Preencha os campos corretamente!";
    }
    else {
        // CRIANDO OBJETOS COM BASE NO FORMULÁRIO
        if ($tipo === "esteira"){
            $maquina = new Esteira($nome);
        }
        else if ($tipo === "prensa"){
            $maquina = new Prensa($nome);
        }
        else if ($tipo === "robosoldagem"){
            $maquina = new RoboSoldagem($nome);
        }

    // EXECUTANDO OS MÉTODOS DO OBJETO
    $maquina->registrarProducao($quantidade);

    // GUARDANDO O OBJETO NA SESSÃO
    $_SESSION["máquinas"][] = $maquina;

    $mensagem = "Máquina cadastrada com sucesso!";


    }
}

// EVITAR INTERPRETAR TEXTOS COMO HTML
function escapar($texto){
    return htmlspecialchars((string) $texto, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/poo2.css">
    <title>Produção</title>
</head>
<body>
    <form method="POST">

        <label>Nome da máquina</label>
        <input type="text" id ="nome" name="nome" required>

        <label>Tipo da máquina</label>
        <select type="text" name="tipo" id="tipo" required>
=======
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
>>>>>>> df0f77ec3d5938d164180aa3a178fd3b71c1ff1c
            <option value="esteira">Esteira</option>
            <option value="prensa">Prensa</option>
            <option value="robosoldagem">Robô de Soldagem</option>
        </select>

<<<<<<< HEAD
        <label>Quantidade da produção</label>
=======
        <label for="quantidade">Quantidade da produção</label>
>>>>>>> df0f77ec3d5938d164180aa3a178fd3b71c1ff1c
        <input type="number" id="quantidade" name="quantidade" min="1" required>

        <button type="submit">Registro da Produção</button>
    </form>

    <?php if ($mensagem !== ""): ?>
<<<<<<< HEAD
    <p><?= escapar($mensagem) ?></p>
    <?php endif; ?>

    <?php if (!empty($_SESSION["máquinas"])): ?>
    <table>
=======
    <p><?= e($mensagem) ?></p>
    <?php endif; ?>

    <?php if (!empty($maquinas)): ?>
    <div class="tabela-container" role="region" aria-label="Registros cadastrados" tabindex="0"><table>
>>>>>>> df0f77ec3d5938d164180aa3a178fd3b71c1ff1c
        <thead>
            <tr>
                <th>Nome da Máquina</th>
                <th>Tipo</th>
<<<<<<< HEAD
                <th>Quantidade Produzida</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION["máquinas"] as $maquina): ?>
                <tr>
                    <td><?= escapar($maquina->nome) ?></td>
                    <td><?= ($maquina) ?></td>
                    <td><?= $maquina->getProducao() ?> unidades</td>
                    <td><?= $maquina->operar() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
=======
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
>>>>>>> df0f77ec3d5938d164180aa3a178fd3b71c1ff1c
</body>
</html>