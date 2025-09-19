// elementos DOM
const selectCategoria = document.getElementById('categoria');
const selectSubCategoria = document.getElementById('subCategoria');
const labelSubcategoria = document.getElementById('labelSubcategoria');
const camposSubcategoria = document.getElementById('camposSubcategoria');
const form = document.getElementById('formCadastroOcorrencia') || document.querySelector('form');

// objetos de campos 
const categoria = {
  cftv: () => ``,
  flits: () => ``,
  moovsec: () => ``
};

const subCategoria = {
  cftv: {
    ponto: () => campoFuncionario() + dataHoraFato(),
    velocidade: () => campoFuncionario() + campoVelocidade() + campoVeiculo() + dataHoraFato(), //exemplos
    alimentacao: () => campoFuncionario() + campoVeiculo() + dataHoraFato() // exemplos
  },
  flits: {
    velocidade: () => campoFuncionario() + campoVelocidade() + campoVeiculo() + dataHoraFato()
  },
  moovsec: {
    alimentacao: () => campoFuncionario() + campoVeiculo() + dataHoraFato()
  }
};

// Passo 1: quando muda a categoria

// evento para quando o primeiro select mudar
selectCategoria.addEventListener('change', () => {
  
  // limpa area de campos e options da subcategoria
  camposSubcategoria.innerHTML = '';
  selectSubCategoria.innerHTML = '<option value="">Selecione...</option>';

  // pega o valor selecionado corretamente
  const tipo1 = selectCategoria.value;
  if (!tipo1) {
    // não escolheu categoria
    selectSubCategoria.style.display = 'inline-block';
    return;
  }

  // se houver campos diretos da categoria (opcional)
  if (categoria[tipo1]) {
    // se quiser injetar algo ao trocar categoria, crie um container para isso.
    // ex: camposCategoria.innerHTML = categoria[tipo1]();
  }

  // monta as opções do select de subcategoria (usando o objeto subCategoria)
  const opcoes2 = subCategoria[tipo1] ? Object.keys(subCategoria[tipo1]) : [];
  opcoes2.forEach(op => {
    const opt = document.createElement('option');
    opt.value = op;
    opt.textContent = op.charAt(0).toUpperCase() + op.slice(1);
    // append no elemento SELECT do DOM (não no objeto)
    selectSubCategoria.appendChild(opt);
  });

  // mostra ou esconde o select de subcategoria conforme opções
  selectSubCategoria.style.display = opcoes2.length > 0 ? 'inline-block' : 'none';
});

// Passo 2: quando muda a subcategoria
selectSubCategoria.addEventListener('change', () => {
  camposSubcategoria.innerHTML = '';
  const tipo1 = selectCategoria.value;
  const tipo2 = selectSubCategoria.value;

  if (subCategoria[tipo1] && subCategoria[tipo1][tipo2]) {
    camposSubcategoria.innerHTML = subCategoria[tipo1][tipo2]();
  }
});

// Submit (mesma lógica do seu exemplo que funcionava)
// if (form) {
//   form.addEventListener('submit', e => {
//     const data = new FormData(form);
//     const resultado = {};
//     data.forEach((value, key) => (resultado[key] = value));
//     alert(JSON.stringify(resultado, null, 2));
//   });
// }