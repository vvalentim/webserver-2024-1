<?php

namespace Models\Pessoas;

use Core\Helpers;
use DateTime;
use Exception;

class CadastroPessoaDTO {
    public function __construct(
        public string $nome_razao,
        public string $tipo_pessoa,
        public string $tipo_vinculo,
        public string $documento,
        public string $data_nasc_fund,
        public string $cep,
        public string $numero,
        public string $complemento,
        protected array $telefones
    ) {
        // Formata a data para o padrão do banco
        $this->data_nasc_fund = DateTime::createFromFormat("d/m/Y", $data_nasc_fund)->format("Y-m-d");
        $this->cep = Helpers::onlyNumbersAsString($cep);
    }

    public function telefones() {
        return $this->telefones;
    }

    public static function montar(array $parametros): CadastroPessoaDTO {
        extract($parametros);
        // Compara a diferença entre as chaves para saber se algum campo não foi definido
        $erros = [];

        $cep = Helpers::onlyNumbersAsString($cep);
        
        if (!Pessoa::validarNome($nome_razao)) {
            $erros["nome_razao"] = "O nome ultrapassa o limite de caracteres permitidos.";
        }
        
        if (!Pessoa::validarTipoPessoa($tipo_pessoa)) {
            $erros["tipo_pessoa"] = "O valor para o tipo de pessoa é inválido";
        }

        if (!Pessoa::validarTipoVinculo($tipo_vinculo)) {
            $erros["tipo_pessoa"] = "O valor para o tipo de vínculo é inválido";
        }

        if (!
            ($tipo_pessoa === "J" ? 
                Pessoa::validarCNPJ($documento) : 
                Pessoa::validarCPF($documento)
            ))
        {
            $erros["documento"] = "O documento '{$documento}' é inválido.";
        }

        if (!Pessoa::validarData($data_nasc_fund)) {
            $erros["data_nasc_fund"] = "A data informada '{$data_nasc_fund}' é inválida";
        }

        if (!Pessoa::validarCEP($cep)) {
            $errors["cep"]= "O CEP informado é inválido.";
        }
        
        if (Pessoa::validarNumero($numero)) {
            $errors["numero"]= "O número do endereço informado está vazio ou ultrapassa o limite de caracteres permitidos.";
        }

        if (Pessoa::validarComplemento($complemento)) {
            $errors["complemento"]= "O complemento do endereço ultrapassa o limite de caracteres permitidos.";
        }

        if (!empty($erros)) {
            Helpers::dump($erros);
            // TODO: exceções customizadas para visualização amigável dos erros
            throw new Exception("O cadastro não foi realizado pois houve erros durante a validação dos dados.");
        } 

        return new CadastroPessoaDTO(...$parametros);
    }
}