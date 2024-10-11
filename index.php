<?php

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("location: login.php");
     exit;
}

echo "Bem-vindo, " . $_SESSION['nome'] . "! <br>";
echo '<a href="logout.php">Sair</a>';
?>


?>