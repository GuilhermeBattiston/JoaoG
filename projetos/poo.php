<!--
    P = Programação
    O = Orietntada
    O = Objetos
-->
<?php 

abstract class Personagem {
    public $nome;
    private $vida;
    public $dano;

    public function __construct($nome, $vida, $dano)
    {
        $this->nome = $nome;
        $this->vida = $vida;
        $this->dano = $dano;
    }

    public function getVida(){
        return $this->vida;
    }

    public function setVida($vida){
        if ($vida < 0){
            echo "Você morreu";
            return;
        }
        $this->vida = $vida;
    }

    abstract public function atacar(){
        
    }
}

class Guerreiro extends Personagem{
    
    public function atacar(){
        echo "$this->nome realizou um ataque com sua espada!";
    }
    public function defender(){
        echo "$this->nome levantou o escudo";
    }
}

class Mago extends Personagem{
    public function atacar()
    {
        echo "$this->nome lançou bola de fogo";
    }
}

class Curandeiro extends Personagem{
    public function atacar()
    {
        echo "$this->nome lançou bola de fogo";
    }
    public function curar(Personagem $alvo, int $quantidade){
        $novaVida = $alvo->getVida() + $quantidade;
        $alvo->setVida($novaVida);
        echo "$this->nome curoru {$alvo->nome} em $quantidade HP!\n";
    }
}

$guerreiro = new Guerreiro("Joao", 1000000000, 1000000);
$mago = new Mago("Pou", 30, 50);
$curandeiro = new Curandeiro("Adolf", 100, 3);
$personagens = [$guerreiro, $mago, $personagem];

foreach($persomagens as $p) {
    $p->atacar();
}

?>