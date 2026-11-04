<?php

require __DIR__ . "/../../../config/conexao.php";

session_start();
if (empty($_SESSION["autenticado"])) {
    header("Location: login.php");
    exit;
}

$pdo->exec("CREATE TABLE IF NOT EXISTS jogos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    genero VARCHAR(50),
    nota INT,
    ano_lancamento INT
)");

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $genero = $_POST["genero"];
    $nota = $_POST["nota"];
    $ano_lancamento = $_POST["ano_lancamento"];

    $sql = "INSERT INTO jogos (nome, genero, nota, ano_lancamento)
            VALUES ('$nome', '$genero', $nota, $ano_lancamento)";
    $pdo->exec($sql);

    $mensagem = "Jogo cadastrado com sucesso!";
}

// Buscar jogos cadastrados no banco de dados   
$buscar = "SELECT * FROM jogos";

// exec() = executa algo quando vocÃª NÃƒO espera retorno de dados
// query() = executa algo quando vocÃª QUER retorno de dados
$stmt = $pdo->query($buscar);

$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de jogos</title>
    <link rel="stylesheet" href="/resources/css/jogos.css?v=20261027">
</head>
<body>
    <nav>
    <a href="/index.php">PÃ¡gina inicial</a>
    </nav>
    <h1>Cadastrar jogo</h1>

    <form method="POST">
        <label for="nome">Nome do jogo</label>
        <input type="text" id="nome" name="nome" maxlength="100" required>

        <label for="genero">GÃªnero</label>
        <input type="text" id="genero" name="genero" maxlength="50" required>

        <label for="nota">Nota</label>
        <input type="number" id="nota" name="nota" step="1" required>

        <label for="ano_lancamento">Ano de lanÃ§amento</label>
        <input type="number" id="ano_lancamento" name="ano_lancamento" step="1" required>

        <button type="submit">Cadastrar</button>
    </form>

    <?php
    if ($mensagem != "") {
        echo "<p>" . $mensagem . "</p>";
    }
    ?>

    <div class = "tabela_jogos">
        <h2>Jogos cadastrados</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Gênero</th>
                <th>Ano de lançamento</th>
                <th>Nota</th>
            </tr>
            
            <!-- foreach() -> Para cada item na lista , faÃ§a algo com X variavel -->
            <?php foreach($jogos as $jogo) { ?>
                <tr>
                    <td><?= $jogo["id"] ?></td>
                    <td><?= $jogo["nome"] ?></td>
                    <td><?= $jogo["genero"] ?></td>
                    <td><?= $jogo["ano_lancamento"] ?></td>
                    <td><?= $jogo["nota"] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>

