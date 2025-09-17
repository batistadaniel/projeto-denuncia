<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="auth.php" method="post">
        Usuário: <input type="text" name="usuario" required><br><br>
        Senha: <input type="password" name="senha" required><br><br>
        <button type="submit">Entrar</button>
    </form>
    <?php
    if (isset($_SESSION['erro'])) {
        echo "<p style='color:red'>" . $_SESSION['erro'] . "</p>";
        unset($_SESSION['erro']);
    }
    ?>
</body>
</html>
