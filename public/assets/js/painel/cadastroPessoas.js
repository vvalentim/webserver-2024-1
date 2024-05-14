import { novoElemento, sleep, toggleHabilitarElementos } from "../helpers.js";

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

const conteudoToast = [
  {
    tag: "div",
    atributos: {
      class: "d-flex",
    },
    subElementos: [
      { tag: "div", atributos: { class: "toast-body" } },
      {
        tag: "div",
        atributos: {
          type: "button",
          class: "btn-close btn-close-white me-2 m-auto",
          "data-bs-dismiss": "toast",
          "data-bs-delay": '{"show":0,"hide": 200}',
        },
      },
    ],
  },
];

const baseToast = (tipo) => {
  return {
    tag: "div",
    atributos: {
      class: `toast align-items-center text-bg-${tipo} border-0`,
    },
    subElementos: conteudoToast,
  };
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
    $("#documento").mask("00.000.000/0000-00");
  } else if (select.value === "F") {
    alterarPlaceholders("Nome completo", "CPF", "Data de nascimento");
    toggleHabilitarElementos(elementosCadastro, true);
    $("#documento").mask("000.000.000-00");
  } else {
    toggleHabilitarElementos(elementosCadastro, false);
  }
};

const gerarToasts = async (mensagens = [], tipo = "danger") => {
  const container = document.querySelector(".toast-container");

  for (const mensagem of mensagens) {
    const toastEl = novoElemento(baseToast(tipo));
    const toastBody = toastEl.querySelector(".toast-body");
    const toast = new bootstrap.Toast(toastEl);

    toastBody.innerText = mensagem;
    container.appendChild(toastEl);
    toast.show();
    toastEl.addEventListener("hidden.bs.toast", () => {
      toastEl.remove();
    });

    await sleep(100);
  }
};

const parseErros = (response) => {
  const erros = [];

  if (response.message) {
    erros.push(response.message);
  } else if (response.errors) {
    erros.push(...response.errors.map((err) => err.message));
  } else {
    erros.push("Não foi possível processar sua requisição.");
  }

  return erros;
};

const enviarFormulario = (event) => {
  const form = event.currentTarget;
  const btnEnviar = document.querySelector("#btn-enviar");
  const methodSpoofing = document.querySelector('input[name="_method"]')?.value;

  event.preventDefault();
  btnEnviar.setAttribute("disabled", true);

  $.ajax({
    url: form.action,
    type: methodSpoofing ?? form.method,
    data: $(form).serialize(),
    success: ({ data }) => {
      if (methodSpoofing === "PUT") {
        gerarToasts(["Alterações realizadas com sucesso."], "success");
      } else {
        gerarToasts(["Cadastrado realizado com sucesso."], "success");
        setTimeout(() => (window.location.href = `/painel/pessoas/${data.id}/editar`), 800);
      }
    },
    error: ({ responseJSON }) => {
      const erros = parseErros(responseJSON);

      gerarToasts(erros);
    },
    complete: () => {
      setTimeout(() => btnEnviar.removeAttribute("disabled"), 1000);
    },
  });
};

const confirmarExclusao = () => {
  const modalEl = document.querySelector("#modal-excluir");
  const modal = new bootstrap.Modal(modalEl);
  const btnConfirmar = modalEl.querySelector(".btn-danger");

  const excluir = () => {
    modal.hide();
    btnConfirmar.setAttribute("disabled", true);

    $.ajax({
      url: document.querySelector("form").action,
      type: "delete",
      success: () => (window.location.href = "/painel/pessoas"),
      error: ({ responseJSON }) => {
        const erros = parseErros(responseJSON);

        gerarToasts(erros);
      },
      complete: () => {
        setTimeout(() => btnConfirmar.removeAttribute("disabled"), 1000);

        btnConfirmar.removeEventListener("click", excluir);
      },
    });
  };

  btnConfirmar.addEventListener("click", excluir);
  modal.show();
};

$(document).ready(() => {
  document.querySelector("#btn-telefone-adicional").addEventListener("click", adicionarTelefone);
  document.querySelector("#tipo-pessoa").addEventListener("change", alterarTipoCampos);
  document.querySelector("form").addEventListener("submit", enviarFormulario);
  document.querySelector("#btn-excluir")?.addEventListener("click", confirmarExclusao);

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
