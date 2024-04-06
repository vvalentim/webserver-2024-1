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

export { toggleHabilitarElementos, novoElemento };
