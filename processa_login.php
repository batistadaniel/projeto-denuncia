<?php
// Inicia a sessao do PHP para poder usar variaveis de sessao
session_start();

// Inclui o arquivo de conexao com o banco de dados
require "./config/conexao.php";

// pega dados do form
$usuario = $_POST['usuario'];
$senha   = $_POST['senha'];

// consulta no banco
// $sql = "SELECT * FROM usuarios WHERE usuario = ? AND senha = ?";
// $stmt = $conn->prepare($sql);
// $stmt->bind_param("ss", $usuario, $senha); // atenção: aqui seria melhor usar senha hash
// $stmt->execute();
// $result = $stmt->get_result();

// Monta a query SQL com parametros "?" (placeholders) para evitar SQL Injection
$sql = "SELECT * FROM usuarios WHERE usuario = ? AND senha = ?";

// Prepara a query para ser executada no banco de dados
$stmt = $conn->prepare($sql);

// Substitui os "?" da query pelos valores reais ($usuario e $senha)
// "ss" significa que os dois parametros sao strings
$stmt->bind_param("ss", $usuario, $senha);

// Executa a query no banco de dados
$stmt->execute();

// Obtem o resultado da execucao da query (os dados retornados da tabela)
$result = $stmt->get_result();

// Verifica se a consulta retornou algum registro
if ($result->num_rows > 0) {

    // Pega os dados do usuario como um array associativo
    $user = $result->fetch_assoc();

    // Cria variaveis de sessao para guardar o usuario logado
    $_SESSION['usuario'] = $user['usuario'];

    // Salva o tipo do usuario na sessao (normal ou admin)
    $_SESSION['tipo']    = $user['tipo'];

    // Guarda o momento que o usuario fez login
    $_SESSION['inicio']  = time();

    // Define o tempo de expiracao da sessao (30 minutos)
    $_SESSION['expira']  = $_SESSION['inicio'] + (30 * 60);

    // Redireciona o usuario para a pagina home.php
    header("Location: home.php");

    // Encerra a execucao do script para garantir que nada mais sera executado
    exit();

} else {
    // Caso nao encontre usuario ou senha incorreta, guarda mensagem de erro na sessao
    $_SESSION['erro'] = "Usuario ou senha incorretos!";

    // Redireciona de volta para a pagina de login
    header("Location: login.php");

    // Encerra a execucao do script
    exit();
}

