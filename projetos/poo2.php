<?php 

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
    <title>Document</title>
</head>
<body>
    
</body>
</html>

