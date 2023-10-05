<?php
// Configurações do banco de dados
$host = "localhost"; // Nome do host
$usuario = "root"; // Nome de usuário do MySQL
$senha = ""; // Senha do MySQL
$banco_de_dados = "academia"; // Nome do banco de dados a ser usado

// Tente estabelecer a conexão com o banco de dados usando PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco_de_dados;charset=utf8", $usuario, $senha);
    
    // Defina o modo de erro do PDO como exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em caso de erro na conexão, exiba uma mensagem de erro
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
