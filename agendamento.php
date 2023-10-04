<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Lógica para obter a lista de personal trainers disponíveis
$personal_trainers_disponiveis = array(
    1 => 'Personal Trainer 1',
    2 => 'Personal Trainer 2',
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_personal_trainer = $_POST["id_personal_trainer"];
    $data_hora = $_POST["data_hora"];

    // Verifique a disponibilidade do personal trainer na data e hora selecionadas
    $disponibilidade = verificarDisponibilidade($id_personal_trainer, $data_hora);

    if ($disponibilidade) {
        // Insira o agendamento na tabela de sessões
        $resultado = agendarSessao($id_personal_trainer, $_SESSION['usuario'], $data_hora);
        
        if (is_string($resultado) && strpos($resultado, 'Erro') === 0) {
            $erro = $resultado;
        } else {
            $mensagem = "Agendamento realizado com sucesso!";
        }
    } else {
        $erro = "O personal trainer não está disponível na data e hora selecionadas.";
    }
}

// Função para verificar a disponibilidade do personal trainer
function verificarDisponibilidade($id_personal_trainer, $data_hora) {
    try {
        // Conexão com o banco de dados usando PDO
        $dsn = "mysql:host=localhost;dbname=academia;charset=utf8";
        $username = "root";
        $password = "";

        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL para verificar se o personal trainer está agendado na data e hora especificadas
        $sql = "SELECT id FROM sessoes WHERE id_personal_trainer = :id_personal_trainer AND data_hora = :data_hora";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_personal_trainer", $id_personal_trainer, PDO::PARAM_INT);
        $stmt->bindParam(":data_hora", $data_hora, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // O personal trainer está agendado nessa data e hora
            return false;
        } else {
            // O personal trainer está disponível nessa data e hora
            return true;
        }
    } catch (PDOException $e) {
        return "Erro na conexão com o banco de dados: " . $e->getMessage();
    }
}

// Função para agendar uma sessão com o personal trainer
function agendarSessao($id_personal_trainer, $id_usuario, $data_hora) {
    try {
        // Verificar a disponibilidade do personal trainer
        if (!verificarDisponibilidade($id_personal_trainer, $data_hora)) {
            return "Personal trainer não está disponível nesse horário.";
        }

        // Conexão com o banco de dados usando PDO
        $dsn = "mysql:host=localhost;dbname=academia;charset=utf8";
        $username = "root";
        $password = "";

        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insira o agendamento na tabela de agendamentos usando prepared statement
        $sql = "INSERT INTO sessoes (id_usuario, id_personal_trainer, data_hora) 
                VALUES (:id_usuario, :id_personal_trainer, :data_hora)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(":id_personal_trainer", $id_personal_trainer, PDO::PARAM_INT);
        $stmt->bindParam(":data_hora", $data_hora, PDO::PARAM_STR);
        $stmt->execute();

        return "Sessão agendada com sucesso!";
    } catch (PDOException $e) {
        return "Erro ao agendar sessão: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agendamento de Sessão</title>
</head>
<body>
    <h2>Agendamento de Sessão</h2>
    
    <?php if (isset($mensagem)) { echo "<p>$mensagem</p>"; } ?>
    <?php if (isset($erro)) { echo "<p>$erro</p>"; } ?>

    <form method="post" action="">
        <label for="id_personal_trainer">Selecione um Personal Trainer:</label>
        <select name="id_personal_trainer" required>
            <option value="">Selecione</option>
            <?php foreach ($personal_trainers_disponiveis as $id => $nome) : ?>
                <option value="<?php echo $id; ?>"><?php echo $nome; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="data_hora">Escolha a Data e Hora:</label>
        <input type="datetime-local" name="data_hora" required><br>

        <input type="submit" value="Agendar">
    </form>
</body>
</html>
