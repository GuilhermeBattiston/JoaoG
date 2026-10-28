<?php 
session_start();

abstract class Maquina {
    public $nome;
    private $producao;

    public function __construct($nome)
    {
        $this->nome = $nome;
        $this->producao = 0;
    }

    public function getProducao(){
        return $this->producao;
    }

    public function registrarProducao($quantidade){
        if ($quantidade <=0) {
            return false;
        }
        $this->producao += $quantidade;
        return true;
    }


    abstract public function operar();
}

class Esteira extends Maquina{
    public function operar() {
        return "Transportando peças...";
    }
}


class Prensa extends Maquina{
    public function operar() {
        return "Prensando peças...";
    }
}


class RoboSoldagem extends Maquina{
    public function operar() {
        return "Soldando peças...";
    }
}

if (!isset($_SESSION["maquinas"])){
    $_SESSION["maquinas"] = [];
}

$mensagem = "";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $nome = $_POST["nome"] ?? "";
    $tipo = $_POST["tipo"] ?? "";
    $quantidade = $_POST["quantidade"] ?? null;

    if(
        $nome === "" ||
        $quantidade === false ||
        $quantidade <= 0
    ) {
        $mensagem = "Preencha os campos corretamente";
    } else{
        if ($tipo === "esteira"){
            $maquina = new Esteira($nome);
        } elseif ($tipo === "prensa"){
            $maquina = new Prensa($nome);
        } elseif ($tipo === "roboSolda"){
            $maquina = new RoboSoldagem($nome);
        }


        $maquina->registrarProducao($quantidade);

        $_SESSION["maquinas"][] = $maquina;

        $mensagem = "Máquina cadastrada com sucesso!";
    }
}

function escapar($texto){
    return htmlspecialchars(
        (string) $texto,
        ENT_QUOTES,
        "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Máquinas</title>
    <link rel="stylesheet" href="/css/poo2.css">
</head>
<body>
    <div class="container">
        
        <h1>Controle de Máquinas Industriais</h1>
        <h2>Cadastrar Máquina</h2>

        <form method="POST">

            <label for="nome">Nome da Máquina</label>
            <input type="text" id="nome" name="nome" required>

            <br><br>

            <label>Tipo de Máquina</label>
            <select name="tipo" required>
                <option value="esteira">Esteira</option>
                <option value="prensa">Prensa</option>
                <option value="roboSolda">Robo Soldagem</option>
            </select>

            <br><br>

            <label>Quantidade Produzida</label>
            <input type="number" name="quantidade" min="1" required>

            <br><br>

            <button type="submit">Cadastrar</button>
        </form>
        <p><?php echo escapar($mensagem)?></p>

        <h2>Máquinas Cadastradas</h2>

        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Produção</th>
                <th>Operação</th>
            </tr>

            <?php foreach ($_SESSION["maquinas"] as $maquina) {?>
                <tr>
                    <td><?php echo escapar($maquina->nome);?></td>
                    <td><?php echo escapar(get_class($maquina));?></td>
                    <td><?php echo escapar($maquina->getProducao());?></td>
                    <td><?php echo escapar($maquina->operar());?></td>
                </tr>

            <?php }?>
        </table>
    </div>
</body>
</html>

