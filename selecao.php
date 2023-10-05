<!DOCTYPE html>
<html>
<head>
    <title>Seleção</title>
    <link rel="stylesheet" href="style.css">    
</head>
<body>
<div id="stars"></div>
  <div id="stars2"></div>
  <div id="stars3"></div>
    <h2>Selecione seu tipo de conta</h2>
    <form method="post" action="processar_selecao.php">
        <label>
            <input type="radio" name="tipo_conta" value="personal_trainer"> Personal Trainer
        </label>
        <br>
        <label>
            <input type="radio" name="tipo_conta" value="usuario"> Usuário
        </label>
        <br>
        <input type="submit" value="Selecionar">
    </form>
</body>
</html>
