<?php
$host = 'localhost';
$dbname   = 'sistema_login';
$user = 'root';  // Usuário do MySQL (normalmente é "root")
$password = '';      // Senha do MySQL (deixe vazio se não houver senha)

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro: Não foi possível conectar ao banco de dados. " . $e->getMessage());
}
?>
