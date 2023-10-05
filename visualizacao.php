<?php
// Inclua o arquivo de configuração do banco de dados aqui
require_once("config.php");

// Função para obter os agendamentos do cliente usando PDO
function obterAgendamentos($id_cliente) {
    $dsn = "mysql:host=localhost;dbname=academia;charset=utf8";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT p.id AS id_personal_trainer, p.nome AS nome_personal_trainer, s.data, s.hora, s.status 
                FROM sessoes s
                JOIN personal_trainers p ON s.id_personal_trainer = p.id
                WHERE s.id_cliente = :id_cliente";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}

// Função para cancelar a sessão
function cancelarSessao($id_sessao) {
    // Conexão com o banco de dados
    $dsn = "mysql:host=localhost;dbname=academia;charset=utf8";
    $username = "root";
    $password = "";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL para atualizar o status da sessão para "cancelada"
        $sql = "UPDATE sessoes SET status = 'Cancelada' WHERE id_sessao = :id_sessao";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_sessao", $id_sessao, PDO::PARAM_INT);
        $stmt->execute();

        return "Sessão cancelada com sucesso!";
    } catch (PDOException $e) {
        die("Erro ao cancelar sessão: " . $e->getMessage());
    }
}

// Obtém os agendamentos do cliente
$agendamentos = obterAgendamentos($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Visualização de Agendamentos</title>
</head>
<body>
    <h2>Visualização de Agendamentos</h2>
    
    <?php if (count($agendamentos) > 0) : ?>
        <table>
            <tr>
                <th>ID do Personal Trainer</th>
                <th>Nome do Personal Trainer</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
            <?php foreach ($agendamentos as $agendamento) : ?>
                <tr>
                    <td><?php echo $agendamento['id_personal_trainer']; ?></td>
                    <td><?php echo $agendamento['nome_personal_trainer']; ?></td>
                    <td><?php echo $agendamento['data']; ?></td>
                    <td><?php echo $agendamento['hora']; ?></td>
                    <td><?php echo $agendamento['status']; ?></td>
                    <td>
                        <?php if ($agendamento['status'] === 'Agendado') : ?>
                            <form method="post" action="">
                                <input type="hidden" name="id_sessao" value="<?php echo $agendamento['id_sessao']; ?>">
                                <input type="submit" value="Cancelar">
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>Nenhum agendamento encontrado.</p>
    <?php endif; ?>
</body>
</html>
