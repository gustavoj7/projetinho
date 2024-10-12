<?php
require 'db.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['id' => $usuario_id])) {
        session_destroy();
        header("Location: login.php");
        exit;
    } else {
        echo "Erro para excluir a conta";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir conta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Excluir conta</h2>
        <form action="excluir.php" method="POST">
            <button type="submit">Confirmar Exclusão</button>
        </form>
    </div>
</body>
</html>