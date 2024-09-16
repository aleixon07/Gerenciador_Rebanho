<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tcc";

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

?>
