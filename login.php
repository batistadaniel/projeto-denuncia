<?php 
// Inicia a sessao do PHP para poder usar variaveis de sessao
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <!-- Titulo da pagina -->
    <h2>Login</h2>

    <!-- Formulario de login enviando os dados para auth.php via POST -->
    <form action="auth.php" method="post">
        Usuario: <input type="text" name="usuario" required><br><br>
        Senha: <input type="password" name="senha" required><br><br>
        <button type="submit">Entrar</button>
    </form>

    <?php
    // Verifica se existe mensagem de erro na sessao
    if (isset($_SESSION['erro'])) {
        // Exibe a mensagem de erro em vermelho
        echo "<p style='color:red'>" . $_SESSION['erro'] . "</p>";

        // Remove a mensagem de erro da sessao para nao aparecer na proxima vez
        unset($_SESSION['erro']);
    }
    ?>
</body>
</html>
