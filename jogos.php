
<?php

require "conexao.php";

$sql = "
CREATE TABLE IF NOT EXISTS jogos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    genero VARCHAR(50),
    nota INT
)
";

$pdo->exec($sql);

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $genero = $_POST["genero"];
    $nota = $_POST["nota"];

    $cadastrar = "INSERT INTO jogos (nome, genero, nota)
    VALUES ('$nome', '$genero', '$nota')";

    $pdo->exec($cadastrar);

    $mensagem = "Jogo cadastrado com sucesso!";
}

$buscar = "SELECT * FROM jogos";

$stmt = $pdo->query($buscar);

$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC)

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Jogos</title>
</head>

<body>

<h1>Cadastro de jogos</h1>

<form method="POST">

    Nome do jogo:
    <input type="text" name="nome">
    <br><br>

    Gênero:
    <input type="text" name="genero">
    <br><br>

    Nota:
    <input type="number" name="nota">
    <br><br>

    <button type="submit">Cadastrar</button>

</form>

<h2>Jogos cadastrados</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Gênero</th>
        <th>Nota</th>
    </tr>
    <?php foreach($jogos as $jogo) { ?>
        <tr>
            <td><?= $jogo["id"]?></td>
            <td><?= $jogo["nome"]?></td>            
            <td><?= $jogo["genero"]?></td> 
            <td><?= $jogo["nota"]?></td>       
        </tr>
    <?php } ?>
</table>

<?php

if ($mensagem != "") {
    echo "<p>$mensagem</p>";
}

?>

</body>
</html>
