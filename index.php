
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JoaoG</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <input type="text" id="nome" name="nome" placeholder="Digite seu nome">
        <input type="number" id="idade" name="idade" placeholder="Digite sua idade">

        <button type="submit">Enviar</button>
        <?php
            $nome = "";
            $idade = 0;
            $resultado = "";
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $nome =$_POST["nome"];
                $idade =$_POST["idade"];
                if  ($idade >=18){
                    $verificar = "Você é maior de idade";
                }
                else  {
                    $resultado - "Você é menor de idade";
                }
            }
            
        ?>
    </form>
    <?php if($resultado != "") { ?>
        <div class = "card">
            <h1>nome: <?=$nome?></h1>
            <p>idade: <?=$idade?></p>
            <p> <?=$resultado?></p>
        </div>

        <?php } ?>
    <div class="card">
        <h1>nome: <?=$nome?></h1>
        <p>idade: <?=$idade?></p>
        <p> <?=$verificar?></p>
    </div>
</body>
</html>