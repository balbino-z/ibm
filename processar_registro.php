<?php
// Inclua o arquivo de configuração do banco de dados aqui
require_once("config.php");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nomeCompleto = $_POST["nome_completo"];
    $telefone = $_POST["telefone"];
    $usernameRegistro = $_POST["username"];
    $passwordReg = $_POST["password"];
    $tipoConta = $_POST["tipo_conta"];

    // Valide os dados conforme necessário
    if (empty($nomeCompleto) || empty($telefone) || empty($username) || empty($password) || empty($tipoConta)) {
        // Caso algum campo esteja vazio, redirecione de volta ao formulário de registro com uma mensagem de erro
        header("Location: registro.php?error=Campos obrigatórios não preenchidos");
        exit();
    }

    // Configuração da conexão com o banco de dados
    $host = "localhost";
    $dbname = "academia";
    $usuario = "root";
    $senha = "";

    try {
        $conexao = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Hash da senha (use a função de hash apropriada para sua aplicação)
        $senhaHash = password_hash($password, PASSWORD_DEFAULT);

        // Preparar e executar a consulta SQL para inserir os dados no banco de dados
        $sql = "INSERT INTO usuarios (nome_completo, telefone, username, senha, tipo_conta) VALUES (?, ?, ?, ?, ?)";

        $stmt = $conexao->prepare($sql);
        $stmt->execute([$nomeCompleto, $telefone, $username, $senhaHash, $tipoConta]);

        // Registro bem-sucedido, redirecione o usuário para uma página de sucesso
        header("Location: registro_sucesso.php");
        exit();
    } catch (PDOException $e) {
        // Se ocorrer um erro durante a inserção no banco de dados, redirecione com uma mensagem de erro
        header("Location: registro.php?error=Erro no registro. Tente novamente mais tarde.");
        exit();
    }
} else {
    // Se o formulário não foi enviado via POST, redirecione de volta para a página de registro
    header("Location: registro.php");
    exit();
}
?>
