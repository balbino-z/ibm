<?php
// Configurações de conexão com o banco de dados (substitua pelos seus dados)
$host = 'localhost';
$banco = 'fluxo';
$usuario = 'root';
$senha = '';

try {
    // Cria uma nova conexão PDO
    $conexao = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);

    // Define o modo de erros do PDO para lançar exceções em caso de problemas
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Consulta SQL para verificar as credenciais do usuário
        $sql = "SELECT * FROM contas WHERE username = ? AND senha = ?";
        
        // Prepara a consulta SQL
        $stmt = $conexao->prepare($sql);

        if ($stmt) {
            // Executa a consulta SQL com os valores dos campos
            $stmt->execute([$username, $password]);
            
            // Obtém o resultado da consulta
            $conta = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($conta) {
                // Verifique o tipo de conta para redirecionar para a página correta
                if ($conta['tipo_conta'] == 1) {
                    // Login de usuário comum, redirecione para a página de perfil do usuário comum
                    header("Location: perfil_usuario.php");
                } elseif ($conta['tipo_conta'] == 2) {
                    // Login de personal trainer, redirecione para a página de perfil do personal trainer
                    header("Location: perfil_personal.php");
                }
            } else {
                // Credenciais inválidas, exiba uma mensagem de erro
                echo "Credenciais inválidas. Por favor, tente novamente.";
            }
        } else {
            // Exibe uma mensagem de erro em caso de falha na preparação da consulta
            echo "Erro ao processar o login. Tente novamente mais tarde.";
        }
    }
} catch (PDOException $e) {
    // Trata erros de conexão ou execução de consulta
    echo "Erro: " . $e->getMessage();
}

// Fecha a conexão com o banco de dados
$conexao = null;
?>
