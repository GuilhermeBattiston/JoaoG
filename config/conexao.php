<?php

$host = "localhost";
$banco = "luiz315"; //luiz315
$usuario = "luiz315"; //luiz315
$senha = "315!@#"; //315!@#

/* PDO = PHP Data Objects, é uma extensão do PHP que fornece uma inteface para acessar 
bancos de dados e extensões de bancos de dados. Ela permite que você se conecte a diferentes 
tipos de bancos de dados usando uma sintaxe consistente, tornando o código mais portátil e 
fácil de manter. */

try{
    $pdo = new PDO ("mysql:host=$host;dbname=$banco; charset=utf8mb4", $usuario, $senha);

    $pdo ->setAttribute(
        PDO::ATTR_ERRMODE, 
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $erro) {
    echo "Erro ao conectar:".$erro->getMessage();
}
