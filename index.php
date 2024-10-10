<?php

session_start();

if (!isset($_SESSION['nome'])) {
    header("location: login.php");
     exit;
}

echo"<h1>Logou com sucesso ".$_SESSION['nome']."</h1>";
echo"<a href='logout.php'>Sair</a>";



?>