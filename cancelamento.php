<?php
session_start();

// Inclua o arquivo de configuração do banco de dados aqui
require_once("config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_sessao = $_POST["id_sessao"];

    // Lógica para cancelar a sessão
    $resultado = cancelarSessao($id_sessao);
    
    if (is_string($resultado) && strpos($resultado, 'Erro') === 0) {
        $erro = $resultado;
    } else {
        $mensagem = "Sessão cancelada com sucesso!";
    }
}

// Função para obter a lista de sessões agendadas pelo usuário
function obterAgendamentos($id_usuario) {
    // Conexão com o banco de dados usando PDO
    $dsn = "mysql:host=localhost;dbname=academia;charset=utf8";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL para obter as sessões agendadas pelo usuário
        $sql = "SELECT id, data_hora FROM sessoes WHERE id_usuario = :id_usuario AND status = 'agendada'";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return array();
    }
}

// Função para cancelar a sessão
function cancelarSessao($id_sessao) {
    // Conexão com o banco de dados usando PDO
    $dsn = "mysql:host=localhost;dbname=academia;charset=utf8";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL para atualizar o status da sessão para "cancelada"
        $sql = "UPDATE sessoes SET status = 'cancelada' WHERE id = :id_sessao";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_sessao", $id_sessao, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "Sessão cancelada com sucesso!";
        } else {
            return "Erro ao cancelar sessão.";
        }
    } catch (PDOException $e) {
        return "Erro na conexão com o banco de dados: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cancelamento de Sessão</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div id="stars"></div>
  <div id="stars2"></div>
  <div id="stars3"></div>
    <h2>Cancelamento de Sessão</h2>
    
    <?php if (isset($mensagem)) { echo "<p>$mensagem</p>"; } ?>
    <?php if (isset($erro)) { echo "<p>$erro</p>"; } ?>

    <form method="post" action="">
        <label for="id_sessao">Selecione a Sessão para Cancelar:</label>
        <select name="id_sessao" required>
            <option value="">Selecione</option>
            <?php foreach ($agendamentos as $agendamento) : ?>
                <option value="<?php echo $agendamento['id']; ?>"><?php echo $agendamento['id']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <input type="submit" value="Cancelar Sessão">
    </form>
</body>
</html>
