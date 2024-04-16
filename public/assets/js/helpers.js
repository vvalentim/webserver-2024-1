const toggleHabilitarElementos = (elementos, habilitar = false) => {
  for (const el of elementos) {
    if (habilitar) {
      el.removeAttribute("disabled");
    } else {
      el.setAttribute("disabled", true);
    }
  }
};

const novoElemento = ({ tag, atributos, subElementos = [] }) => {
  const elemento = document.createElement(tag);

  for (const [chave, valor] of Object.entries(atributos)) {
    elemento.setAttribute(chave, valor);
  }

  for (const el of subElementos) {
    elemento.appendChild(novoElemento(el));
  }

  return elemento;
};

// Source: https://www.ramoncp.com.br/snippets/mascara-de-telefone-para-input-em-js
const phoneMask = (value) => {
  if (!value) return "";
  value = value.replace(/\D/g, "");
  value = value.replace(/(\d{2})(\d)/, "($1) $2");
  value = value.replace(/(\d)(\d{4})$/, "$1-$2");
  return value;
};

export { phoneMask, toggleHabilitarElementos, novoElemento };
