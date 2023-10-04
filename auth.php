<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique as credenciais do usuário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if ($email === "email" && $senha === "senha") {
        $_SESSION['usuario'] = $email;
        header("Location: perfil.php");
        exit();
    } else {
        $erro = "Credenciais inválidas. Tente novamente.";
    }
}
?>