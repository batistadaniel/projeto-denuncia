<?php
require "verifica_login.php";

$usuario = $_SESSION['usuario'];
$tipo = $_SESSION['tipo'];
$tempoRestante = $_SESSION['expira'] - time(); // em segundos

// define fuso horário de Brasília
date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <script>
        let tempo = <?php echo $tempoRestante; ?>;

        function contagemSessao() {
            if (tempo <= 0) {
                window.location.href = "logout.php";
            } else {
                let minutos = Math.floor(tempo / 60);
                let segundos = tempo % 60;
                document.getElementById("sessao").innerText =
                    minutos + "m " + segundos + "s";
                tempo--;
            }
        }

        function relogio() {
            let agora = new Date();
            let h = agora.getHours().toString().padStart(2, "0");
            let m = agora.getMinutes().toString().padStart(2, "0");
            let s = agora.getSeconds().toString().padStart(2, "0");
            let d = agora.toLocaleDateString("pt-BR");
            document.getElementById("hora").innerText = d + " " + h + ":" + m + ":" + s;
        }

        setInterval(contagemSessao, 1000); // contador da sessão
        setInterval(relogio, 1000);        // relógio em tempo real
    </script>
</head>
<body onload="relogio(); contagemSessao();">
    <header>
        <p>
            Olá, <?php echo htmlspecialchars($usuario); ?> |
            Data/hora atual: <span id="hora"></span> |
            Sessão expira em: <span id="sessao"></span> |
            <a href="logout.php">Sair</a>
        </p>
    </header>

    <h1>Esse é o teste</h1>
    <!-- Conteúdo comum a todos -->
    <h1>Bem-vindo ao sistema!</h1>
    <p>Este conteúdo todos os usuários logados podem ver.</p>

    <!-- Conteúdo específico para usuários normais -->
    <?php if ($tipo == "normal"): ?>
        <h2>Área do Usuário Normal</h2>
        <p>Você tem acesso a funcionalidades básicas.</p>
        <ul>
            <li>Ver seu perfil</li>
            <li>Alterar senha</li>
            <li>Consultar dados básicos</li>
        </ul>
    <?php endif; ?>

    <!-- Conteúdo específico para administradores -->
    <?php if ($tipo == "admin"): ?>
        <h2>Área do Administrador</h2>
        <p>Você tem acesso a todas as funcionalidades.</p>
        <ul>
            <li>Gerenciar usuários</li>
            <li>Alterar qualquer dado do sistema</li>
            <li>Visualizar relatórios completos</li>
            <li>Configurações avançadas</li>
        </ul>
    <?php endif; ?>
</body>
</html>
