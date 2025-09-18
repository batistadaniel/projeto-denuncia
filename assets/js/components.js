function campoFuncionario() {
    return `
        <div>
            <label>Nome:</label>
            <input type="text" name="nomeFuncionario" required>
            <label>Cracha:</label>
            <input type="text" name="crachaFuncionario" required>
        </div>
    `;
}

function dataHoraFato() {
    return `
        <div>
            <label>Dia e Horario do Fato:</label>
            <input type="date" name="diaFato" required>
            <input type="time" name="horaFato" required>
        </div>
    `;
}

function campoVelocidade() {
    return `
        <div>
            <label>Velocidade Real:</label>
            <input type="text" name="velocidadeReal" required>
            <label>Velocidade Parametrizada:</label>
            <input type="text" name="velocidadeParametrizada" required>
        </div>
    `;
}

function campoVeiculo() {
    return `
        <div>
            <label>Prefixo:</label>
            <input type="text" name="prefixo" required>
            <label>Linha:</label>
            <input type="text" name="linha" required>
            <label>Setor:</label>
            <input type="text" name="setorVeiculo" required>
        </div>
    `;
}