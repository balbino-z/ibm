<?php
// Conexão com o banco de dados usando PDO
$dsn = "mysql:host=localhost;dbname=academia;charset=utf8";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recuperar critérios de busca do formulário
    $especialidade = $_POST["especialidade"];
    $localizacao = $_POST["localizacao"];

    // Consulta SQL para buscar personal trainers com base nos critérios
    $sql = "SELECT nome, especialidade, localizacao FROM personal_trainers WHERE especialidade = :especialidade AND localizacao LIKE :localizacao";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":especialidade", $especialidade, PDO::PARAM_STR);
    $stmt->bindValue(":localizacao", "%$localizacao%", PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Exibir resultados da busca
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Nome: " . $row["nome"] . "<br>";
            echo "Especialidade: " . $row["especialidade"] . "<br>";
            echo "Localização: " . $row["localizacao"] . "<br><br>";
        }
    } else {
        echo "Nenhum personal trainer encontrado com esses critérios.";
    }
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>
