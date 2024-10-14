<?php

require 'db.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$sql = "SELECT * FROM usuarios";
$stmt = $pdo->query($sql);
$usuarios = $stmt->fetchAll();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
   


    <div class="container">
        
        <h2>Bem vindo,<?php echo $_SESSION['nome']; ?> </h2>
        <h3>Lista de Usuários</h3>
        <a href="cadastro.php" id="cadastroLink">Cadastrar novo usuário</a>
        <a href="logout.php" id="logoutLink">Logout</a>



        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($usuarios as $usuario): ?>
                <?php
                // Armazenar dados do usuário em variáveis para facilitar a leitura
                $id = htmlspecialchars($usuario['id']);
                $nome = htmlspecialchars($usuario['nome']);
                $email = htmlspecialchars($usuario['email']);
                ?>
                <tr>
                    <td><?= $id ?></td>
                    <td><?= $nome ?></td>
                    <td><?= $email ?></td>
                    <td>
                        <a href="editar.php?id=<?= $id ?>" class="button-link">Editar</a>
                        <a href="excluir.php?id=<?= $id ?>" class="button-link">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>


        </table>

    </div>

    <script>
        // Transformar os links de Logout e Cadastrar em botões
        document.getElementById('logoutLink').classList.add('button-link');
        document.getElementById('cadastroLink').classList.add('button-link');
    </script>
</body>

</html>