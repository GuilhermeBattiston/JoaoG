<?php

session_start();

require __DIR__ . "/../conexao.php";

$mensagem = "";

// LOGIN
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

// SAIR
if (isset($_POST["sair"])) {

    session_destroy();

    header("Location: jogos.php");
    exit;
}

// ÁREA LOGADA
if (isset($_SESSION["logado"])) {

    // Cria a tabela caso ela ainda não exista
    $sql = "
        CREATE TABLE IF NOT EXISTS jogos (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nome VARCHAR(100),
            genero VARCHAR(50),
            nota INT
        )
    ";

    $pdo->exec($sql);

    // CADASTRAR JOGO
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cadastrar"])) {

        $nome = $_POST["nome"];
        $genero = $_POST["genero"];
        $nota = $_POST["nota"];

        if ($nome == "" || $genero == "" || $nota == "") {

            $mensagem = "Preencha todos os campos!";

        } else {

            $cadastrar = $pdo->prepare("
                INSERT INTO jogos (nome, genero, nota)
                VALUES (?, ?, ?)
            ");

            $cadastrar->execute([$nome, $genero, $nota]);

            $mensagem = "Jogo cadastrado com sucesso!";
        }
    }

    // BUSCAR JOGOS
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
    <a href="../index.php"></a>
</body>
</head>

<body>

<?php if (!isset($_SESSION["logado"])) { ?>

    <h1>Login</h1>

    <form method="POST">

        Usuário:
        <input type="text" name="usuario">

        <br><br>

        Senha:
        <input type="password" name="senha">

        <br><br>

        <button type="submit" name="login">
            Entrar
        </button>

    </form>

    <?php if ($mensagem != "") { ?>
        <p><?= htmlspecialchars($mensagem) ?></p>
    <?php } ?>

<?php } else { ?>

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

        <button type="submit" name="cadastrar">
            Cadastrar
        </button>

    </form>

    <form method="POST">
        <button type="submit" name="sair">
            Sair
        </button>
    </form>

    <?php if ($mensagem != "") { ?>
        <p><?= htmlspecialchars($mensagem) ?></p>
    <?php } ?>

    <h2>Jogos cadastrados</h2>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Gênero</th>
            <th>Nota</th>
        </tr>

        <?php foreach ($jogos as $jogo) { ?>

            <tr>
                <td><?= htmlspecialchars($jogo["id"]) ?></td>
                <td><?= htmlspecialchars($jogo["nome"]) ?></td>
                <td><?= htmlspecialchars($jogo["genero"]) ?></td>
                <td><?= htmlspecialchars($jogo["nota"]) ?></td>
            </tr>

        <?php } ?>

    </table>

<?php } ?>
    
</html>