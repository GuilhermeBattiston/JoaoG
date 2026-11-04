<?php 

    function apresentarSistema() {
        echo "Bem vindo(a) ao Hekp Desk!";
    }

    apresentarSistema();

    function abrirChamado($nome, $problema) {
        echo "$nome abriu um chamado: $problema";
    }

    //$nome = $_POST["nome"];
    //$problema = $_POST["problema"];

    abrirChamado("Lucas", "Impressora não funciona");

    function contarChamados($quantidade){
        return "Existem $quantidade chamados registrados";
    }

    $resultado = contarChamados(5);
    //echo $resultado;
?>