<?php
session_start();

require "db.php";

// pega dados do form
$usuario = $_POST['usuario'];
$senha   = $_POST['senha'];

// consulta no banco
// $sql = "SELECT * FROM usuarios WHERE usuario = ? AND senha = ?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("ss", $usuario, $senha); // atenção: aqui seria melhor usar senha hash
// $stmt->execute();
// $result = $stmt->get_result();

$sql = "SELECT * FROM usuarios WHERE usuario = ? AND senha = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $senha);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // cria sessão válida
    // $_SESSION['usuario'] = $usuario;
    // $_SESSION['inicio'] = time();              // hora que logou
    // $_SESSION['expira'] = $_SESSION['inicio'] + (30 * 60); // 30 min
    $user = $result->fetch_assoc();

    $_SESSION['usuario'] = $user['usuario'];
    $_SESSION['tipo']    = $user['tipo'];         // salva o tipo na sessão
    $_SESSION['inicio']  = time();
    $_SESSION['expira']  = $_SESSION['inicio'] + (30 * 60); // tempo de sessão
    header("Location: home.php");
    exit();
} else {
    $_SESSION['erro'] = "Usuário ou senha incorretos!";
    header("Location: login.php");
    exit();
}
