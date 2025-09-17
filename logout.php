<?php
// Inicia a sessao para poder acessa-la
session_start();

// Destrói todas as variaveis e dados da sessao atual
session_destroy();

// Redireciona o usuario de volta para a pagina de login
header("Location: login.php");

// Encerra a execucao do script para garantir que nada mais sera executado
exit();
