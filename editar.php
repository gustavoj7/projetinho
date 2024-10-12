<?php

require 'db.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: painel.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cep = $_POST['cep'];
    $data_nascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $sql = "UPDATE usuarios SET nome = :nome, endereco = :endereco, bairro = :bairro, cep = :cep, data_nascimento = :data_nascimento,
    cidade = :cidade, estado = :estado WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([
        'nome' => $nome,
        'endereco' => $endereco,
        'bairro' => $bairro,
        'cep' => $cep,
        'data_nascimento' => $data_nascimento,
        'cidade' => $cidade,
        'estado' => $estado,
        'id' => $usuario_id

    ])) {
        // $_SESSION['nome'] = $nome;
        // echo "Perfil atualizado com sucesso!";
    } 
    header("Location: painel.php");
}

$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="style.css">
    <script>
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
</head>

<body>
    <div class="container">
        <h2>Editar Perfil</h2>
        <form method="POST" action="editar.php">
            Nome: <input type="text" name="nome" value="<?= $usuario['nome'] ?>" required><br>
            Data de Nascimento: <input type="date" name="data_nascimento" value="<?= $usuario['data_nascimento'] ?>" required><br>
            CEP: <input type="text" name="cep" id="cep" value="<?= $usuario['cep'] ?>" onblur="buscarCEP()" required><br>
            Endereço: <input type="text" name="endereco" id="endereco" value="<?= $usuario['endereco'] ?>" required><br>
            Bairro: <input type="text" name="bairro" id="bairro" value="<?= $usuario['bairro'] ?>" required><br>
            Cidade: <input type="text" name="cidade" value="<?= $usuario['cidade'] ?>" required><br>
            Estado: <input type="text" name="estado" maxlength="2" value="<?= $usuario['estado'] ?>" required><br>
            <button type="submit">Salvar</button>
        </form>
    </div>

</body>

</html>