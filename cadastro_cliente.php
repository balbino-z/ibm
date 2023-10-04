<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: perfil.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processamento do formulário de cadastro de cliente
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $genero = $_POST["genero"];
    $endereco = $_POST["endereco"];
    $telefone = $_POST["telefone"];

    // Conexão com o banco de dados usando PDO
    $dsn = "mysql:host=localhost;dbname=academia;charset=utf8";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO usuarios (nome, idade, email, senha, genero, endereco, telefone) 
                VALUES (:nome, :idade, :email, :senha, :genero, :endereco, :telefone)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":idade", $idade, PDO::PARAM_INT);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
        $stmt->bindParam(":genero", $genero, PDO::PARAM_STR);
        $stmt->bindParam(":endereco", $endereco, PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $telefone, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            $mensagem = "Cadastro de cliente realizado com sucesso!";
        } else {
            $erro = "Erro ao cadastrar cliente.";
        }
    } catch (PDOException $e) {
        $erro = "Erro na conexão com o banco de dados: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Cliente</title>
</head>
<body>
    <h2>Cadastro de Cliente</h2>
    <form method="post" action="">
        Nome: <input type="text" name="nome"><br>
        Idade: <input type="text" name="idade"><br>
        Email: <input type="email" name="email"><br>
        Senha: <input type="password" name="senha"><br>
        Gênero: <input type="text" name="genero"><br>
        Endereço: <input type="text" name="endereco"><br>
        Telefone: <input type="text" name="telefone"><br>
        <input type="submit" value="Cadastrar">
    </form>
    <?php if (isset($mensagem)) { echo "<p>$mensagem</p>"; } ?>
    <?php if (isset($erro)) { echo "<p>$erro</p>"; } ?>
</body>
</html>
