<?php
session_start();

// se não estiver logado, manda para login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// se a sessão expirou
if (time() > $_SESSION['expira']) {
    session_destroy();
    header("Location: login.php");
    exit();
}
