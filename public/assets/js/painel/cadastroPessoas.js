import { novoElemento, toggleHabilitarElementos } from "../helpers.js";

const maskTelefone = {
  behavior: function (val) {
    return val.replace(/\D/g, "").length === 11 ? "(00) 00000-0000" : "(00) 0000-00009";
  },
  options: {
    onKeyPress: function (val, e, field, options) {
      field.mask(maskTelefone.behavior.apply({}, arguments), options);
    },
  },
};

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
  $('.wrapper-telefone:last-child input[type="text"]').mask(maskTelefone.behavior, maskTelefone.options);
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

  if (select.value === "J") {
    alterarPlaceholders("Razão social", "CNPJ", "Data de fundação");
    toggleHabilitarElementos(elementosCadastro, true);
    $("#documento").mask("00.000.000/0000-00", { reverse: true });
  } else if (select.value === "F") {
    alterarPlaceholders("Nome completo", "CPF", "Data de nascimento");
    toggleHabilitarElementos(elementosCadastro, true);
    $("#documento").mask("000.000.000-00", { reverse: true });
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

  $("#nascimento").mask("00/00/0000");
  $("#cep").mask("00000-000");
  $('.wrapper-telefone input[type="text"]').mask(maskTelefone.behavior, maskTelefone.options);
});
