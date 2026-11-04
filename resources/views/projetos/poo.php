<?php
// POO = Programação orientada a objetos

    // ENCAPSULAMENTO
    // Proteger informações para que não sejam alteradas de qualquer jeito
    // HERANÇA
    // Criar uma classe nova aproveitando caracterÃ­sticas de outra
    // POLIMORFISMO
    // Permitir que objetos diferentes respondam a mesma ação de maneiras diferentes
    // ABSTRAÇÃO
    // Mostrar o que é necessário e esconder detalhes complicados de funcionamento

    // Exemplo com POO
    abstract class Personagem {
        public $nome;
        private $vida = 100;
        public $dano = 10;

        public function __construct($nome, $vida, $dano) {
            $this->nome = $nome;
            $this->vida = $vida;
            $this->dano = $dano;
        }

        //GETTER
        public function getVida() {
            return $this->vida;
        }

        //SETTER
        public function setVida($vida) {
            if ($vida < 0) {
                echo "A vida não pode ser negativa!\n";
                return;
            }

            $this->vida=$vida;
        }

        // Toda classe filha deverá implementar atacar()
        abstract public function atacar();
    }
class Guerreiro extends Personagem {
        // Sobrescrevendo o método da classe pai
        public function atacar() {
            echo "$this->nome atacou com uma espada!\n";
        }

        public function defender() {
            echo "$this->nome levantou o escudo!";
        }
    }  

    class Mago extends Personagem {
        // Sobrescrevendo o método da classe pai
        public function atacar() {
            echo "$this->nome lançou uma bola de fogo!\n";
        }
    }

    class Curandeiro extends Personagem {
        // Sobrescrevendo o método da classe pai
        public function atacar() {
            echo "$this->nome atacou com uma faca!\n";
        }
    
        public function curar(Personagem $alvo, int $quantidade) {
            $novaVida = $alvo->getVida() + $quantidade;
            $alvo->setVida($novaVida);
            echo "$this->nome curou {$alvo->nome} em $quantidade pontos!\n";
        }
    }

    $guerreiro = new Guerreiro("Luiz", 100, 10);
    $mago = new Mago("Aurora", 50, 5);
    $curandeiro = new Curandeiro("Chloe", 30,3);

    $personagens = [$guerreiro, $mago, $curandeiro];

    foreach ($personagens as $p) {
        $p->atacar();
    }

    $guerreiro->setVida(60);

    echo "Vida antes da cura: " . $guerreiro->getVida() . "\n";

    $curandeiro->curar($guerreiro, 50);

    echo "Vida depois da cura: " . $guerreiro->getVida() . "\n";

    // https://luiz315.devlook.xyz/resources/views/projetos/poo.php

    //1. O que é uma classe?
    //Um molde para criar objetos

    //2. O que significa new Personagem()?
    //Criar um objeto da classe Personagem

    //3. Para que serve $this->nome?
    //Acessar o nome do objeto atual

    //4. O que significa extends?
    //Herdar caracterí­sticas e métodos de outra classe
?>


