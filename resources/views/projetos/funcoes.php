<?php

    function apresentarSistema(){
        echo "Bem vindo(a) ao Help Desk!";
    }

    apresentarSistema();

    function abrirChamado($nome, $problema){
        echo "$nome abriu um chamado: $problemas";
    }

    abrirChamado("Felipe", "Impressora não funciona");

    function contarChamados($quantidade){
        return "Existem $quantidade chammados registrados";
    }

    $resultado = contarChamados(S);
    // echo $resultado;

?>