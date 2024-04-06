import { novoElemento, toggleHabilitarElementos } from "../helpers.js";

const inputTelefone = {
  tag: "input",
  atributos: {
    type: "text",
    class: "form-control me-2",
    name: "telefones[]",
    placeholder: "Telefone",
    style: "min-width: 220px",
  },
};

const btnRemover = {
  tag: "button",
  atributos: {
    type: "button",
    class: "btn btn-danger",
  },
  subElementos: [
    {
      tag: "i",
      atributos: {
        class: "bi bi-x-circle",
      },
    },
  ],
};

const wrapperTelefone = {
  tag: "div",
  atributos: {
    class: "wrapper-telefone d-flex",
  },
  subElementos: [inputTelefone, btnRemover],
};

const adicionarTelefone = () => {
  const elWrapperCampos = document.querySelector("#cadastro-telefones");
  const elWrapperTelefone = novoElemento(wrapperTelefone);
  const elBtnRemover = elWrapperTelefone.querySelector("button");

  // Limitar em até 3 telefones de contato
  if (elWrapperCampos.querySelectorAll(".wrapper-telefone").length >= 3) {
    // TODO: disparar modal com mensagem de erro
    return;
  }

  elBtnRemover.addEventListener("click", () => elWrapperTelefone.remove());
  elWrapperCampos.appendChild(elWrapperTelefone);
};

const alterarTipoCampos = () => {
  const select = document.querySelector("#tipo-pessoa");
  const inputNome = document.querySelector("#nome");
  const inputDocumento = document.querySelector("#documento");
  const inputNascimento = document.querySelector("#nascimento");

  const alterarPlaceholders = (nome, documento, nascimento) => {
    inputNome.setAttribute("placeholder", nome);
    inputDocumento.setAttribute("placeholder", documento);
    inputNascimento.setAttribute("placeholder", nascimento);
  };

  const elementosCadastro = document.querySelectorAll(
    ".campos-cadastro input, .campos-cadastro select, .campos-cadastro button"
  );

  if (select.value === "juridica") {
    alterarPlaceholders("Razão Social", "CNPJ", "Data de Fundação");
    toggleHabilitarElementos(elementosCadastro, true);
  } else if (select.value === "fisica") {
    alterarPlaceholders("Nome Completo", "CPF", "Data de Nascimento");
    toggleHabilitarElementos(elementosCadastro, true);
  } else {
    toggleHabilitarElementos(elementosCadastro, false);
  }
};

$(document).ready(() => {
  document.querySelector("#btn-telefone-adicional").addEventListener("click", adicionarTelefone);
  document.querySelector("#tipo-pessoa").addEventListener("change", alterarTipoCampos);

  // Rotinas para inicialização no modo de edição

  // Necessário atribuir o evento para os botões que carregarem no modo de edição
  document.querySelectorAll(".wrapper-telefone button.btn-danger").forEach((btn) => {
    btn.addEventListener("click", () => btn.parentElement.remove());
  });

  // Inicializa os valores das seleções
  document.querySelectorAll("select[data-initial-selected]").forEach((select) => {
    select.value = select.getAttribute("data-initial-selected");
  });

  // Primeira chamada para habilitar/desabilitar campos baseado no valor do select
  alterarTipoCampos();
});
