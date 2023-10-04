<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Lógica para carregar mensagens anteriores do banco de dados
$mensagens_anteriores = array(); // Array para armazenar mensagens

// Lógica para enviar uma mensagem
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensagem = $_POST["mensagem"];
    
    // Valide e insira a mensagem no banco de dados (substitua com sua própria lógica)
    if (!empty($mensagem)) {
        // Insira a mensagem no banco de dados (substitua com sua própria lógica)
        // Lembre-se de incluir informações como o ID do remetente, a data e a hora
        $mensagens_anteriores[] = array(
            "remetente" => $_SESSION['usuario'],
            "mensagem" => $mensagem
        );
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat em Tempo Real</title>
</head>
<body>
    <h2>Chat em Tempo Real</h2>
    
    <div id="mensagens">
        <?php foreach ($mensagens_anteriores as $mensagem) : ?>
            <p><strong><?php echo $mensagem["remetente"]; ?>:</strong> <?php echo $mensagem["mensagem"]; ?></p>
        <?php endforeach; ?>
    </div>
    
    <form method="post" action="">
        <input type="text" id="mensagem" name="mensagem" placeholder="Digite sua mensagem" required>
        <button type="submit">Enviar</button>
    </form>

    <!-- JavaScript para atualizar o chat em tempo real com AJAX -->
    <script>
        function atualizarChat() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    // A resposta do servidor foi recebida com sucesso
                    // Atualize a área de mensagens com os novos dados
                    document.getElementById("mensagens").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "atualizar_chat.php", true);
            xhttp.send();
        }

        // Chame a função para atualizar o chat a cada 3 segundos
        setInterval(atualizarChat, 3000); // Atualize a cada 3 segundos (3000 milissegundos)
    </script>
</body>
</html>
