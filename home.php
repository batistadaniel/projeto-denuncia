<?php
// Inclui o arquivo que verifica se o usuario esta logado e se a sessao ainda eh valida
require "verifica_login.php";

// Pega o nome do usuario logado da sessao
$usuario = $_SESSION['usuario'];

// Pega o tipo do usuario (normal ou admin) da sessao
$tipo = $_SESSION['tipo'];

// Calcula o tempo restante da sessao em segundos
$tempoRestante = $_SESSION['expira'] - time();

// Define o fuso horario para Brasilia
date_default_timezone_set('America/Sao_Paulo');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <script>
        // Inicializa a variavel tempo com o tempo restante da sessao vindo do PHP
        let tempo = <?php echo $tempoRestante; ?>;

        // Funcao que atualiza o contador da sessao a cada segundo
        function contagemSessao() {
            if (tempo <= 0) {
                // Se a sessao expirou, redireciona para logout
                window.location.href = "logout.php";
            } else {
                // Calcula minutos e segundos restantes
                let minutos = Math.floor(tempo / 60);
                let segundos = tempo % 60;
                // Atualiza o texto na tela
                document.getElementById("sessao").innerText =
                    minutos + "m " + segundos + "s";
                // Decrementa o tempo
                tempo--;
            }
        }

        // Funcao que atualiza o relogio em tempo real
        function relogio() {
            let agora = new Date();
            let h = agora.getHours().toString().padStart(2, "0");
            let m = agora.getMinutes().toString().padStart(2, "0");
            let s = agora.getSeconds().toString().padStart(2, "0");
            let d = agora.toLocaleDateString("pt-BR");
            document.getElementById("hora").innerText = d + " " + h + ":" + m + ":" + s;
        }

        // Atualiza o contador da sessao a cada segundo
        setInterval(contagemSessao, 1000);

        // Atualiza o relogio a cada segundo
        setInterval(relogio, 1000);
    </script>
</head>

<body onload="relogio(); contagemSessao();">

    <header>
        <!-- Header com nome do usuario, hora atual, tempo de sessao e link para logout -->
        <p>
            Ola, <?php echo htmlspecialchars($usuario); ?> |
            Data/hora atual: <span id="hora"></span> |
            Sessao expira em: <span id="sessao"></span> |
            <a href="logout.php">Sair</a>
        </p>
    </header>

    <!-- Conteudo comum a todos os usuarios -->
    <h1>Esse e o teste</h1>
    <h1>Bem-vindo ao sistema!</h1>
    <p>Este conteudo todos os usuarios logados podem ver.</p>

    <!-- Conteudo especifico para usuarios normais -->
    <?php if ($tipo == "normal"): ?>
        <h2>Area do Usuario Normal</h2>
        <p>Voce tem acesso a funcionalidades basicas.</p>
        <ul>
            <li>Ver seu perfil</li>
            <li>Alterar senha</li>
            <li>Consultar dados basicos</li>
        </ul>
    <?php endif; ?>

    <!-- Conteudo especifico para administradores -->
    <?php if ($tipo == "admin"): ?>
        <h2>Area do Administrador</h2>
        <p>Voce tem acesso a todas as funcionalidades.</p>
        <ul>
            <li>Gerenciar usuarios</li>
            <li>Alterar qualquer dado do sistema</li>
            <li>Visualizar relatorios completos</li>
            <li>Configuracoes avancadas</li>
        </ul>
    <?php endif; ?>

    <form id="formCadastro" method="post" action="processa_cadastro_ocorrencia.php">
        <select name="categoria" id="categoria">
            <option value="">Selecione...</option>
            <option value="cftv">CFTV</option>
            <option value="flits">FLITS</option>
            <option value="moovsec">MOOVSEC</option>
        </select>

        <select name="subCategoria" id="subCategoria" style="display:none;">
            <option value="">Selecione...</option>
        </select>

        <div id="camposSubcategoria"></div>

        <button type="submit" style="margin-top:16px;">Enviar</button>
    </form>

    <script src="./assets/js/components.js"></script>
    <script src="./assets/js/scripts.js"></script>
</body>
</html>