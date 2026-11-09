<!-- 
P = Programação
O = Orientada
O = Objetos
-->

<?php

// ENCAPSULAMENTO
// Proteger informações para que não sejam alteradas de qualquer jeito.
// HERANÇA
// Criar uma classe nova aproveitando características de outro.
// POLIMORFISMO
// Permitir que objetos diferentes respondam à mesma ação de maneiras diferentes.
// ABSTRAÇÃO 
// Mostrar o que é necessário e esconder detalhes complicados de funcionamento.

abstract class Personagem {
    public $nome;
    private $vida;
    public $dano;
    
    public function __construct($nome,$vida,$dano){
        $this->nome = $nome;
        $this->vida = $vida;
        $this->dano = $dano;
    }

    // GETTER
    public function getVida(){
        return $this->vida;
    }

    // SETTER
    public function setVida($vida){
        if ($vida < 0){
            echo "Vida não pode ser menor que 0!";
            return;
        }

        $this->vida = $vida;
    }

    // Toda classe filha deverá implementar atacar()
    abstract public function atacar();
}
class Guerreiro extends Personagem {
    // Sobreescrevendo o método da classe pai
    public function atacar(){
        echo "$this->nome atacou com uma espada!\n";
    }
    public function defender(){
        echo "$this->nome levantou o escudo!\n";
    }
}
class Mago extends Personagem {
    // Sobreescrevendo o método da classe pai
    public function atacar(){
        echo "$this->nome lançou uma bola de fogo!\n";
    }
}
class Curandeiro extends Personagem {
    // Sobreescrevendo o método da classe pai
    public function atacar(){
        echo "$this->nome atacou com uma faca!\n";
    }
    public function curar(Personagem $alvo, int $quantidade){
        $novaVida = $alvo->getVida() + $quantidade;
        $alvo->setVida($novaVida);
        echo "$this->nome curou {$alvo->nome} em $quantidade HP!\n";
    }
}

$guerreiro = new Guerreiro("Felipe", 100, 30);
$mago = new Mago("Pedro", 50, 15);
$curandeiro = new Curandeiro("Sebastian", 50, 15);

$personagens = [$guerreiro, $mago, $curandeiro];

foreach($personagens as $p){
    $p->atacar();
}

$guerreiro->setVida(60);

echo "Vida antes da cura: " . $guerreiro->getVida() . "\n";

$curandeiro->curar($guerreiro, 50);

echo "Vida depois da cura: " . $guerreiro->getVida() . "\n";

// 1. O que é uma classe?
// Um molde para criar objetos

// 2. O que significa new Personagem()?
// Criar um objeto da classe Personagem

// 3. Para que serve $this->nome?
// Acessar o nome do objeto atual

// 4. O que significa extends?
// Herdar características e métodos de outra classe

?>