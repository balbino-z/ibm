<?php
// Inclua o arquivo de configuração do banco de dados aqui
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar dados da avaliação do formulário
    $id_personal_trainer = $_POST["id_personal_trainer"];
    $nota = $_POST["nota"]; // Avaliação de 1 a 5
    $comentario = $_POST["comentario"];
    $id_cliente = $_SESSION['id_cliente']; // Recupere o ID do cliente da sessão ou do banco de dados

    // Certifique-se de que a nota esteja dentro da faixa de 1 a 5
    if ($nota < 1 || $nota > 5) {
        $erro = "A nota deve estar entre 1 e 5.";
    } else {
        // Conexão com o banco de dados usando PDO
        $dsn = "mysql:host=localhost;dbname=academia;charset=utf8";
        $username = "root";
        $password = "";

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Inserir a avaliação no banco de dados usando prepared statement
            $sql = "INSERT INTO avaliacoes (id_personal_trainer, id_cliente, nota, comentario) 
                    VALUES (:id_personal_trainer, :id_cliente, :nota, :comentario)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id_personal_trainer", $id_personal_trainer, PDO::PARAM_INT);
            $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
            $stmt->bindParam(":nota", $nota, PDO::PARAM_INT);
            $stmt->bindParam(":comentario", $comentario, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $mensagem = "Avaliação adicionada com sucesso!";
            } else {
                $erro = "Erro ao adicionar avaliação.";
            }
        } catch (PDOException $e) {
            $erro = "Erro na conexão com o banco de dados: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Avaliação</title>
    <link rel="stylesheet" href="/ibm/style.css">
</head>
<body>
<div id="stars"></div>
  <div id="stars2"></div>
<div id="stars3"></div>
    <h2>Adicionar Avaliação</h2>
    <form method="post" action="">
        Nota (1 a 5): <input type="number" name="nota" min="1" max="5" required><br>
        Comentário: <textarea name="comentario" rows="4" cols="50"></textarea><br>
        <input type="hidden" name="id_personal_trainer" value="<?php echo $id_personal_trainer; ?>">
        <input type="submit" value="Enviar Avaliação">
    </form>
    <?php if (isset($mensagem)) { echo "<p>$mensagem</p>"; } ?>
    <?php if (isset($erro)) { echo "<p>$erro</p>"; } ?>
</body>
</html>
