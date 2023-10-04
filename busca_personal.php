<!DOCTYPE html>
<html>
<head>
    <title>Busca de Personal Trainers</title>
</head>
<body>
    <h2>Busca Avançada de Personal Trainers</h2>
    <form method="post" action="resultado_busca.php">
        Especialidade:
        <select name="especialidade">
            <option value="Musculação">Musculação</option>
            <option value="Cardio">Cardio</option>
            <option value="Yoga">Yoga</option>
        </select>
        <br>
        Localização:
        <input type="text" name="localizacao">
        <br>
        <input type="submit" value="Buscar">
    </form>
</body>
</html>