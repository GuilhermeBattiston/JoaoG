<?php

function apresentarSistema()
{
    echo 'Bem vindo(a) ao Help Desk!';
}

apresentarSistema();

function abrirChamado($nome, $problema)
{
    echo "$nome abriu um chamado: $problema";
}

abrirChamado('Felipe', 'Impressora não funciona');

function contarChamados($quantidade)
{
    return "Existem $quantidade chammados registrados";
}

$resultado = contarChamados(5);
// echo $resultado;
