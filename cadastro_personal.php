<?php
// Inclua o arquivo de configuração do banco de dados aqui
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processamento do formulário de cadastro
    $nome = $_POST["nome"];
    $especialidade = $_POST["especialidade"];
    $experiencia = $_POST["experiencia"];

    // Conexão com o banco de dados usando PDO
    $dsn = "mysql:host=localhost;dbname=academia;charset=utf8";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO personal_trainers (nome, especialidade, experiencia) VALUES (:nome, :especialidade, :experiencia)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":especialidade", $especialidade, PDO::PARAM_STR);
        $stmt->bindParam(":experiencia", $experiencia, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $mensagem = "Cadastro realizado com sucesso!";
        } else {
            $erro = "Erro ao cadastrar: " . $stmt->errorInfo()[2];
        }
    } catch (PDOException $e) {
        $erro = "Erro na conexão com o banco de dados: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Personal Trainer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="stars"></div>
  <div id="stars2"></div>
  <div id="stars3"></div>
    <h2>Cadastro de Personal Trainer</h2>
    <form method="post" action="">
        Nome: <input type="text" name="nome"><br>
        Especialidade: <input type="text" name="especialidade"><br>
        Experiência: <input type="text" name="experiencia"><br>
        <input type="submit" value="Cadastrar">
    </form>
    <?php if (isset($mensagem)) { echo "<p>$mensagem</p>"; } ?>
    <?php if (isset($erro)) { echo "<p>$erro</p>"; } ?>
</body>
</html>
