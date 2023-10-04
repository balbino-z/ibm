<!DOCTYPE html>
<?php
// Configurações de conexão com o banco de dados (substitua pelos seus dados)
$host = 'localhost';
$banco = 'academia';
$usuario = 'root';
$senha = '';

try {
    // Cria uma nova conexão PDO
    $conexao = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);

    // Define o modo de erros do PDO para lançar exceções em caso de problemas
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obter as informações do usuário comum
    $sql = "SELECT nome_completo, username, email, telefone, idade, genero, endereco FROM usuarios WHERE id = ?"; // Substitua "id" pelo identificador do usuário logado

    // Prepara a consulta SQL
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        // Execute a consulta com o identificador do usuário logado
        $id_usuario_logado = 1; // Substitua pelo ID do usuário logado
        $stmt->execute([$id_usuario_logado]);

        // Recupere os resultados da consulta
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifique se os resultados foram encontrados
        if ($resultado) {
            $nome = $resultado['nome'];
            $username = $resultado['username'];
            $email = $resultado['email'];
            $telefone = $resultado['telefone'];
            $idade = $resultado['idade'];
            $genero = $resultado['genero'];
            $endereco = $resultado['endereco'];
        }
    }
} catch (PDOException $e) {
    // Trate erros de conexão ou execução de consulta
    echo "Erro: " . $e->getMessage();
}

// Fecha a conexão com o banco de dados
$conexao = null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil do Usuário</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="#">Página Inicial</a></li>
        <li><a href="perfil_usuario.html">Perfil</a></li>
        <li><a href="logout.php">Sair</a></li>
      </ul>
    </nav>
  </header>
  
  <main>
    <section id="personal-info">
      <h2>Informações Pessoais</h2>
      <p>Nome: João da Silva</p>
      <p>Idade: 30 anos</p>
      <p>Gênero: Masculino</p>
      <p>Endereço: Rua das Flores, 123</p>
    </section>
    
    <section id="purchased-workouts">
      <h2>Treinos Comprados</h2>
      <ul>
        <li>Treino de Musculação</li>
        <li>Treino de Corrida</li>
      </ul>
    </section>
    
    <section id="message-history">
      <h2>Histórico de Mensagens</h2>
      <div id="chat-box">
        <!-- Aqui você pode exibir o histórico de mensagens em tempo real -->
      </div>
      <textarea id="message-input" placeholder="Digite uma mensagem..."></textarea>
      <button id="send-message">Enviar</button>
    </section>
  </main>
  
  <footer>
    <p>&copy; 2023 Dev Muscles</p>
  </footer>

  <script>
    // Exemplo simples de interatividade com JavaScript
    const messageInput = document.getElementById("message-input");
    const sendButton = document.getElementById("send-message");
    const chatBox = document.getElementById("chat-box");

    sendButton.addEventListener("click", function () {
      const messageText = messageInput.value;
      if (messageText.trim() !== "") {
        chatBox.innerHTML += `<p>Usuário: ${messageText}</p>`;
        messageInput.value = "";
      }
    });
  </script>
</body>
</html>
