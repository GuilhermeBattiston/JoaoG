<?php

//dados para conexão mysql
    $host="localhost";
    $banco="joao315";
    $usuario="joao315";
    $senha="315!@#";

    // PDO = php data objects. Serve para coversar com o banco de dados
    try{
        $pdo = new PDO("mysql:host=$host;dbname=$banco;charste=utf8mb4", $usuario,$senha);
        // "->" Serve para puxar algo que pertence aquele objeto
        // PDO::ATTR_ERRMODE - é para configurar o modo de erro do PDO
        // PDO::ERRMODE_EXCEPTION - transforma um erro em exceção
        $pdo->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        echo "Conectado com sucesso";
        
    } 
    catch(PDOException $erro){
        echo "Erro ao conectar:".$erro->getMessage();
    }
    
    