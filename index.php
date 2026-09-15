
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JoaoG</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $nome = "João";
    $idade = "20";
    $verificar = "";
    if  ($idade >=18){
        $verificar = "Você é maior de idade";
    }
    else {
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