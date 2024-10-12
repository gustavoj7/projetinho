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
        header("Location: login.php");
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
      // Função para buscar o endereço a partir do CEP
      function buscarCEP() {
            const cep = document.getElementById('cep').value.replace(/\D/g, '');
            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!("erro" in data)) {
                            document.getElementById('endereco').value = data.logradouro;
                            document.getElementById('bairro').value = data.bairro;
                        } else {
                            alert("CEP não encontrado!");
                        }
                    })
                    .catch(() => alert("Erro ao buscar o CEP!"));
            }
        }
</script>
<body>
    <div class="container">
        <h2>Cadastro de Usuário</h2>
        <form action="cadastro.php" method="POST"> 
            <input type="text" name="nome" required placeholder="Nome"> 
            <input type="email" name="email" required placeholder="Email"> 
            <input type="password" name="senha" required placeholder="Senha"> 
            <input type="text" name="cep" id="cep" placeholder="CEP" required onblur="buscarCEP()"> 
            <input type="text" name="endereco" id="endereco" placeholder="Endereço"> 
            <input type="text" name="bairro" id="bairro" placeholder="Bairro"> 
            <input type="text" name="estado" id="estado" maxlength="2" required placeholder="Estado"> 
            <input type="text" name="cidade" id="cidade" required placeholder="Cidade">  
            <input type="date" name="data_nascimento" id="data_nascimento">  
            <button type="submit">Cadastrar</button>            
        </form>

        <a href="login.php">Já tem uma conta? Faça login</a>


    </div>
</body>
</html>