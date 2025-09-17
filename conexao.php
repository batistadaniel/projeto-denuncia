<?php
// cria conexao com o banco de dados

$host = "localhost";
$user = "root";
$pass = "";
$db   = "teste";
$port = 3309; // porta para conexao mysql

$conn = new mysqli($host, $user, $pass, $db, $port); //$port

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
