<?php
// Inclua o arquivo de configuração do banco de dados aqui
require_once("config.php");

// Verifique se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha as credenciais do formulário
    $username = $_POST["username"];
    $senha = $_POST["password"]; // Campo de senha corrigido

    try {
        // Consulta SQL para verificar as credenciais do usuário
        $sql = "SELECT id, tipo_conta FROM contas WHERE username = :username AND senha = :senha";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":senha", $senha, PDO::PARAM_STR);
        $stmt->execute();
        
        // Obtenha o resultado da consulta
        $conta = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($conta) {
            // Verifique o tipo de conta para redirecionar para a página correta
            if ($conta['tipo_conta'] == "usuario") {
                // Login de usuário comum, redirecione para a página de perfil do usuário comum
                echo "Login bem-sucedido - redirecionando para perfil_user.php";
                header("Location: perfil_user.php");
                exit();
            } elseif ($conta['tipo_conta'] == "personal") {
                // Login de personal trainer, redirecione para a página de perfil do personal trainer
                echo "Login bem-sucedido - redirecionando para perfil_personal.php";
                header("Location: perfil_personal.php");
                exit();
            }
        } else {
            // Credenciais inválidas, exiba uma mensagem de erro
            echo "Credenciais inválidas. Por favor, tente novamente.";
        }
    } catch (PDOException $e) {
        // Trate qualquer erro de banco de dados aqui
        echo "Erro de banco de dados: " . $e->getMessage();
    }
}
?>
