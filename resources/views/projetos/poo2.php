<?php

    // SISTEMA DE CONTROLE DE AUTOMAÇÃO INDUSTRIAL

    // 1. CLASSE ABSTRATA

    abstract class Maquina {
        public $nome;
        private $producao;

        public function __construct($nome) {
            $this->nome=$nome;
            $this->producao=0;
        }

        // ENCAPSULAMENTO
        public function getProducao() {
            return $this->producao;
        }

        //ENCAPSULAMENTO - ALTERAÇÃO CONTROLADA
        public function registrarProducao($quantidade) {
            if ($quantidade <= 0) {
                return false;
            }

            $this->producao += $quantidade;
            return true;
        }

        //Abstração
        abstract public function operar();
    }

     // 2. HERANÇA
    class Esteira extends Maquina {
        public function operar() {
            return "Transportando peças...";
        }
    }

    class Prensa extends Maquina {
        public function operar() {
            return "Prensando peças...";
        }
    }

    class RoboSoldagem extends Maquina {
        public function operar() {
            return "Soldando peças...";
        }
    }

    // 3. SESSÃO = ARMAZENAMENTO TEMPORÁRIO

    if (!isset($_SESSION["maquinas"])) {
        $_SESSION["maquinas"] = [];
    }

    $mensagem = "";

    // 4. RECEBER FORMULÁRIO VIA PASSWORD_BCRYPT
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = $_POST["nome"] ?? "";
        $tipo = $_POST["tipo"] ?? "";
        $quantidade = $_POST["quantidade"] ?? null;

        if (
            $nome === "" ||
            $quantidade === false ||
            $quantidade <= 0
        ) {
            $mensagem = "Preencha os campos corretamente!";
        } else {
            // CRIANDO OBJETOS COM BSE NO FORMULÁRIO
            if ($tipo == "esteira") {

                $maquina = new Esteira($nome);

            } elseif ($tipo == "prensa") {

                $maquina = new Prensa($nome);

            } elseif ($tipo == "robosoldagem") {

                $maquina = new RoboSoldagem($nome);

            }

            // EXECUTANDO OS MÉTODOS DO OBJETO
            $maquina->registrarProducao($quantidade);

            // GUARDANDO O OBJETO NA SESSÃO
            $_SESSION["maquinas"][] = $maquina;

            $mensagem = "Maquina cadastrada com sucesso!";
        }
    }

    // Evitar interpretar textos como HTML
    function escapar ($texto) {
        return htmlspecialchars (
            (string) $texto,
            ENT_QUOTES,
            "UTF-8");
    }
    
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Automação Industrial</title>
</head>
<body>
    <header>
        <h1>Controle de automação industrial</h1>
        <p>Cadastre máquinas e acompanhe a produção</p>
    </header>

    <?php if (!empty($mensagem)): ?>
        <p><strong><?php echo escapar($mensagem); ?></strong></p>
    <?php endif; ?>

    <h2>Cadastrar nova máquina</h2>
    <form method="POST" action="">
        <label for="nome">Nome da máquina</label><br>
        <input type="text" id=nome name="nome" required><br><br>

        <label for="tipo">Tipo da máquina></label><br>
        <select id="tipo" name="tipo" required><br><br>
            <option value="esteira">Esteira</option>
            <option value="prensa">Prensa</option>
            <option value="robosoldagem">Robô de Soldagem</option>
        </select><br><br>

        <label for="quantidade">Quantidade Produzida</label><br>
        <input type="number" id="quantidade" name="quantidade" min="1" required>

        <button type="submit">Cadastrar e registrar produção</button>
    </form>

    <hr>

    <h2>Máquinas Cadastradas</h2>

    <?php if (empty($_SESSION["maquinas"])): ?>
        <p>Nenhuma máquina cadastrada até o momento.</p>
    <?php else: ?>
        <table border="1">
            <thread>
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Ação / Operação</th>
                    <th>Produção Total</th>
                </th>
            </thread>
            <tbody>
                <?php foreach ($_SESSION["maquinas"] as $maq): ?>
                    <tr>
                        <td><?php echo escapar ($maq->nome); ?></td>
                        <td><?php echo escapar (get_class($maq)); ?></td>
                        <td><?php echo escapar ($maq->operar()); ?></td>
                        <td><?php echo escapar ($maq->getProducao()); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>