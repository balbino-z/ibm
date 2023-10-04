<?php
// Lógica para carregar mensagens recentes do banco de dados
$mensagens_recentes = array();

// Construa o HTML das mensagens recentes
$html_mensagens = '';
foreach ($mensagens_recentes as $mensagem) {
    $html_mensagens .= '<p><strong>' . $mensagem['remetente'] . ':</strong> ' . $mensagem['mensagem'] . '</p>';
}

// Retorne o HTML gerado como resposta para a solicitação AJAX
echo $html_mensagens;
?>
