<?php 

// Dados para conexão mysql
$host = "localhost";
$banco = "felipeg315";
$usuario = "felipeg315";
$senha = "315!@#";

// PDO = PHP Data Objects =  ferramenta do PHP para conversar com banco de dados.
try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8mb4", $usuario,$senha);

    // -> Serve para puxar algo que pertence aquele objeto
    // PDO:: ATTR_ERRMODE - é para configurar o modo de erros do PDO
    // PDO:: ERRMODE_EXCEPTION - é para quando acontecer algum erro, transformar em execução
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    echo "Conectado com sucesso!";

} catch (PDOException $erro){
    
    echo "Erro ao conectar:".$erro->getMessage();

}
