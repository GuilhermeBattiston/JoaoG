
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JoaoG</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="">
        <input type="text" name="$nome" placeholder="Digite seu nome: ">
        <input type= "number" id="$idade" placeholder="Digite sua idade: >
    </form>

    <?php
    $idade = "";
    $verificar = "";
    if  ($idade >=18){
        $verificar = "Você é maior de idade";
    }
    elseif ($idade >=0) {
        $verificar - "Você é menor de idade";
    }
    ?>

    <div class="card">
        <h1>nome: <?=$nome?></h1>
        <p>idade: <?=$idade?></p>
        <p> <?=$verificar?></p>
    </div>
</body>
</html>