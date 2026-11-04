<?php

    $nome = "";
    $idade = 0;
    $resposta= "";
    if ($_SERVER ["REQUEST_METHOD"]=="POST"){
        $nome = $_POST["nome"];
        $idade = $_POST["idade"];
         if ($idade >= 18){
            $resposta="Você é maior de idade";
        }
        else{
            $resposta="Você é menor de idade";    
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/resources/css/style.css">
    <title>Verificador de Idade</title>
</head>
<body>
    <nav>
    <a href="/index.php">Página inicial</a>
    </nav>
    <form method="POST">
        <input type = "text" id="nome" name="nome" placeholder="Digite seu nome">
        <input type = "number" id="idade" name="idade" placeholder="Digite sua idade">
        <button type="submit">Verificar</button>
    </form>
    <div class = "container">
        

        <?php  if($resposta != "") { ?>
            <h2>O nome é: <?= $nome ?> </h2>
            <h2>A idade é: <?= $idade ?> anos </h2>
            <h2> <?= $resposta ?> </h2>

        <?php } ?>
    </div>
</body>
</html>
