<?php

session_start();

require "conexao.php";

if (!isset($_SESSION["logado"])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {

        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

        if ($usuario == "admin" && $senha == "1234") {

            $_SESSION["logado"] = true;

        } else {

            $mensagem = "Usuário ou senha incorretos!";

        }
    }
}

if (isset($_POST["sair"])) {

    session_destroy();

    header("Location: jogos.php");
    exit;

}

if (isset($_SESSION["logado"])) {

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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastrar"])) {

        $nome = $_POST["nome"];
        $genero = $_POST["genero"];
        $nota = $_POST["nota"];

        $cadastrar = $pdo->prepare("
            INSERT INTO jogos (nome, genero, nota)
            VALUES (?, ?, ?)
        ");

        $cadastrar->execute([$nome, $genero, $nota]);

        $mensagem = "Jogo cadastrado com sucesso!";
    }
    $buscar = "SELECT * FROM jogos";

    $stmt = $pdo->query($buscar);

    $jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Jogos</title>
</head>

<body>

<?php if (!isset($_SESSION["logado"])) { ?>

    <h1>Login</h1>

    <form method="POST">

        Usuário: <input type="text" name="usuario"><br><br>

        Senha: <input type="password" name="senha"><br><br>

        <button type="submit" name="login">Entrar</button>

    </form>
    <?php

    if (isset($mensagem)) {
        echo "<p>$mensagem</p>";
    }
    ?>
<?php } else { ?>

    <h1>Cadastro de jogos</h1>

    <form method="POST">

        Nome do jogo: <input type="text" name="nome"><br><br>
        
        Gênero: <input type="text" name="genero"><br><br>

        Nota: <input type="number" name="nota"><br><br>

        <button type="submit" name="cadastrar">Cadastrar</button>

    </form>
    <form method="POST">
        <button type="submit" name="sair">Sair</button>
    </form>
<?php

    if ($mensagem != "") {
        echo "<p>$mensagem</p>";
    }

    ?>

    <h2>Jogos cadastrados</h2>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Gênero</th>
        <th>Nota</th>
    </tr>

    <?php foreach($jogos as $jogo) { ?>
        <tr>
            <td><?= $jogo["id"] ?></td>
            <td><?= $jogo["nome"] ?></td>
            <td><?= $jogo["genero"] ?></td>
            <td><?= $jogo["nota"] ?></td>
        </tr>

    <?php } ?>
<?php } ?>
</body>
</html>
