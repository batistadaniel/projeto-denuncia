<?php
// Inicia a sessao do PHP para poder usar variaveis de sessao
session_start();
require "verifica_login.php";

include_once "./config/conexao.php";

// PHP: Processa o POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Limpa e pega os valores do POST
    $nome_funcionario = trim($_POST['nomeFuncionario'] ?? '');
    $cracha_funcionario = trim($_POST['crachaFuncionario'] ?? '');
    $dia_fato = trim($_POST['diaFato'] ?? '');
    $hora_fato = trim($_POST['horaFato'] ?? '');
    $velocidade_real = trim($_POST['velocidadeReal'] ?? '');
    $velocidade_parametrizada = trim($_POST['velocidadeParametrizada'] ?? '');
    $prefixo_veiculo = trim($_POST['prefixo'] ?? '');
    $linha_veiculo = trim($_POST['linha'] ?? '');
    $setor_veiculo = trim($_POST['setorVeiculo'] ?? '');
    
    // Validação simples
    if ($nome_funcionario && $cracha_funcionario && $dia_fato && $hora_fato) {

        $sql = "INSERT INTO ocorrencia 
                (nome_funcionario, cracha_funcionario, dia_fato, hora_fato, 
                 velocidade_real, velocidade_parametrizada, 
                 prefixo_veiculo, linha_veiculo, setor_veiculo)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepara a query
        if ($stmt = $mysqli->prepare($sql)) {
            // Vincula os parâmetros
            $stmt->bind_param(
                "sssssssss", 
                $nome_funcionario, 
                $cracha_funcionario, 
                $dia_fato, 
                $hora_fato, 
                $velocidade_real, 
                $velocidade_parametrizada, 
                $prefixo_veiculo, 
                $linha_veiculo, 
                $setor_veiculo
            );

            // Executa
            if ($stmt->execute()) {
                $msg = "Ocorrência cadastrada com sucesso!";
            } else {
                $msg = "Erro ao cadastrar: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $msg = "Erro na preparação da query: " . $mysqli->error;
        }

    } else {
        $msg = "Preencha os campos obrigatórios!";
    }
} else {
    // Caso nao encontre usuario ou senha incorreta, guarda mensagem de erro na sessao
    $_SESSION['erro'] = "Usuario ou senha incorretos!";

    // Redireciona de volta para a pagina de login
    header("Location: login.php");

    // Encerra a execucao do script
    exit();
}
?>