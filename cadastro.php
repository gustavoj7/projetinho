<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);  // Hashing da senha
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cep = $_POST['cep'];
    $data_nascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $sql = "INSERT INTO usuarios (nome, email, senha, endereco, bairro, cep, data_nascimento, cidade, estado) 
    VALUES (:nome, :email, :senha, :endereco, :bairro, :cep, :data_nascimento, :cidade, :estado)";
    
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([
        'nome' => $nome,
        'email' => $email,
        'senha' => $senha,
        'endereco' => $endereco,
        'bairro' => $bairro,
        'cep' => $cep,
        'data_nascimento' => $data_nascimento,
        'cidade' => $cidade,
        'estado' => $estado,
        
    ])) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário!";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<script>
    
</script>
<body>
    <div class="container">
        <form action="cadastro.php" method="post"> 
            <input type="text" name="nome" required placeholder="Nome"> <br>
            <input type="email" name="email" required placeholder="Email"> <br>
            <input type="password" name="senha" required placeholder="Senha"> <br>
            <input type="text" name="cep" id="CEP" placeholder="CEP" required onblur="buscarCep()"> <br>
            <input type="text" name="endereco" id="Endereco" placeholder="Endereço"> <br>
            <input type="text" name="bairro" id="Bairro" placeholder="Bairro"> <br>
            <input type="text" name="estado" id="estado" maxlength="2" required placeholder="Estado"> <br>
            <input type="text" name="cidade" id="cidade" required placeholder="Cidade">  <br>
            <input type="date" name="data_nascimento" id="data_nascimento">  <br>
            <button type="submit">Cadastrar</button>            
        </form>

        <a href="login.php">Já tem uma conta? Faça login</a>


    </div>
</body>
</html>