<?php

require 'db.php';   
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se os campos de email e senha foram enviados
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password']; // Certifique-se de que o campo existe

        // Consulta o usuário com o e-mail fornecido
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário foi encontrado e se a senha está correta
        if ($usuario && password_verify($password, $usuario['senha'])) {
            // Configura as variáveis de sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            // Redireciona o usuário para a página inicial
            header("Location: index.php");
            exit;
        } else {
            // echo "Credenciais inválidas!"; 
        }
    } 
        
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script>
    document.getElementById('formLogin').addEventListener('submit', function(e) {
        var email = document.getElementById('email').value;
        var senha = document.getElementById('password').value;

        // Verifica se o email não está vazio
        if (!email) {
            alert('O campo de email é obrigatório.');
            e.preventDefault();
        }

        // Verifica se a senha tem pelo menos 6 caracteres
        if (senha.length < 6) {
            alert('A senha deve ter no mínimo 6 caracteres.');
            e.preventDefault();
        }
    });
</script>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="password" id="password" placeholder="Senha">
            <button type="submit">Entrar</button>
        </form>
        <a href="cadastro.php">Não tem uma conta? Cadastre-se</a>
    </div>
</body>
</html>