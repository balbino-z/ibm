<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["tipo_conta"])) {
        $tipo_conta = $_POST["tipo_conta"];
        
        if ($tipo_conta === "personal_trainer") {
            // Redirecionar para a página do Personal Trainer
            header("Location: cadastro_personal.php");
            exit();
        } elseif ($tipo_conta === "usuario") {
            // Redirecionar para a página do Usuário
            header("Location: cadastro_cliente.php");
            exit();
        }
    }
}

// Redirecionar de volta para a página de seleção em caso de erro
header("Location: selecao.php");
exit();
?>
