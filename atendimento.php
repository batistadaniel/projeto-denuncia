<?php
// Habilitar exibição de erros no PHP
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Processa o envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Exibe os dados recebidos via POST
    var_dump($_POST);  // Verifica os dados recebidos
    echo "<div style='background:#1e1e1e;color:#f0f0f0;padding:15px;margin:20px auto;border-radius:8px;max-width:1000px;'>";
;
    foreach ($_POST as $campo => $valor) {
        echo "<p><strong>" . ucfirst($campo) . ":</strong> " . htmlspecialchars($valor) . "</p>";
    }
    echo "</div>";
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SAC</title>
    <style>
       body {
    font-family: Arial, sans-serif;
    background: #121212; /* fundo escuro */
    color: #f0f0f0;       /* texto claro */
    margin: 0;
    padding: 0;
}

header {
    background: #021a1a;
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    letter-spacing: 1px;
}

.form-container {
    max-width: 1000px;
    margin: 30px auto;
    background: #1e1e1e; /* container escuro */
    padding: 30px 40px;
    border-radius: 10px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
}

h3 {
    margin-top: 30px;
    padding: 10px;
    background: #2c2c2c;
    border-left: 6px solid #00cccc;
    font-size: 18px;
    color: #f0f0f0;
}

label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
    color: #cccccc;
}

input, select, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    background: #2a2a2a;
    color: #f0f0f0;
    border: 1px solid #555;
    border-radius: 6px;
    font-size: 14px;
}

textarea {
    min-height: 80px;
    resize: vertical;
}

.form-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 10px;
}

.form-row > div {
    flex: 1;
    min-width: 250px;
}

button {
    margin-top: 25px;
    width: 100%;
    padding: 14px;
    background: #004040;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease;
}

button:hover {
    background: #006666;
}

/* Botão de anexo */
#attachBtn {
    margin-top: 20px;
    padding: 10px 15px;
    background: #2c2c2c;
    color: #ccc;
    border: 1px solid #444;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
}

#attachBtn:hover {
    background: #3a3a3a;
}

    </style>
</head>
<body>

<header>MODELO DE DENÚNCIA</header>

<div class="form-container">
    <form id="formCadastro" method="POST" action="">
        <!-- DADOS DA RECLAMAÇÃO -->
        <h3>DADOS DA RECLAMAÇÃO</h3>

        <div class="form-row">
            <div>
                <label for="categoria">Meio de denúncia:</label>
                <select name="categoria" id="categoria">
                    <option value="">Selecione...</option>
                    <option value="cftv">CFTV</option>
                    <option value="flits">FLITS</option>
                    <option value="moovsec">MOOVSEC</option>
                </select>
            </div>

            <div>
                <label for="subCategoria">Prioridade:</label>
                <select name="subCategoria" id="subCategoria" style="display:none;">
                    <option value="">Selecione...</option>
                </select>
            </div>
        </div>

        <div id="camposSubcategoria"></div>

        <button type="submit">Enviar</button>
    </form>

    <!-- Botão de anexar (abre o seletor de arquivos) -->
    <button id="attachBtn" type="button" aria-label="Anexar arquivo">📎 Anexar arquivo</button>
    <input id="fileInput" type="file" style="display:none;" />
</div>

<!-- Scripts -->
<script src="components.js"></script>
<script src="scripts.js"></script>

<script>
    const attachBtn = document.getElementById('attachBtn');
    const fileInput = document.getElementById('fileInput');

    // Ao clicar no botão, abre o seletor de arquivos
    attachBtn.addEventListener('click', () => fileInput.click());

    // Tratar arquivos selecionados (exemplo)
    fileInput.addEventListener('change', (e) => {
        console.log('Arquivos selecionados:', e.target.files);
    });
</script>

</body>
</html>
