<?php

namespace Models\Pessoas;

use Core\Helpers;
use DateTime;
use Exception;

class AtualizarPessoaDTO {
    public function __construct(
        protected int $id,
        public ?string $nome_razao = null,
        public ?string $tipo_pessoa = null,
        public ?string $tipo_vinculo = null,
        public ?string $documento = null,
        public ?string $data_nasc_fund = null,
        public ?string $cep = null,
        public ?string $numero = null,
        public ?string $complemento = null,
        protected ?array $telefones = [],
    ) {
        if (!empty($data_nasc_fund)) {
            // Formata a data para o padrão do banco
            $this->data_nasc_fund = DateTime::createFromFormat("d/m/Y", $data_nasc_fund)->format("Y-m-d");
        }

        if (!empty($cep)) {
            $this->cep = Helpers::onlyNumbersAsString($cep);
        }
    }

    public function id() {
        return $this->id;
    }

    public function telefones() {
        return $this->telefones;
    }

    public static function montar(Pessoa $registro, array $parametros): AtualizarPessoaDTO {
        extract($parametros);

        $dados = [];
        $erros = [];
        
        // WIP: formatação e validação
        if (isset($nome_razao)) {
            if (Pessoa::validarNome($nome_razao)) {
                $dados["nome_razao"] = $nome_razao;
            } else {
                $erros["nome_razao"] = "O nome ultrapassa o limite de caracteres permitidos.";
            }
        }

        if (isset($tipo_pessoa)) {
            if (Pessoa::validarTipoPessoa($tipo_pessoa)) {
                $dados["tipo_pessoa"] = $tipo_pessoa;
            } else {
                $erros["tipo_pessoa"] = "O valor para o tipo de pessoa é inválido";
            }
        }

        if (isset($tipo_vinculo)) {
            if (Pessoa::validarTipoVinculo($tipo_vinculo)) {
                $dados["tipo_vinculo"] = $tipo_vinculo;
            } else {
                $erros["tipo_vinculo"] = "O valor para o tipo de vínculo é inválido";
            }
        }

        if (isset($documento)) {
            $documento = Helpers::onlyNumbersAsString($documento);

            // Confirma o tipo da pessoa pra fazer a validação correta
            // Caso o tipo tenha sido alterado na mesma requisição, checa baseado no novo tipo
            // Caso contrário compara com o tipo que já está no registro
            $tipo = $tipo_pessoa ?? $registro->tipo_pessoa;
            $validacao = $tipo === "J" ?
                Pessoa::validarCNPJ($documento) :
                Pessoa::validarCPF($documento);
            
            if ($validacao) {
                $dados["documento"] = $documento;
            } else {
                $erros["documento"] = "O documento '{$parametros["documento"]}' é inválido.";
            }
        }

        if (isset($data_nasc_fund)) {
            if (Pessoa::validarData($data_nasc_fund)) {
                $dados["data_nasc_fund"] = $data_nasc_fund;
            } else {
                $erros["data_nasc_fund"] = "A data informada '{$data_nasc_fund}' é inválida";
            }
        }

        if (isset($cep)) {
            $cep = Helpers::onlyNumbersAsString($cep);

            if (Pessoa::validarCEP($cep)) {
                $dados["cep"] = $cep;
            } else {
                $errors["cep"]= "O CEP informado é inválido.";
            }
        }

        if (isset($numero)) {
            if (Pessoa::validarNumero($numero)) {
                $dados["numero"] = $numero;
            } else {
                $errors["numero"]= "O número do endereço informado está vazio ou ultrapassa o limite de caracteres permitidos.";
            }
        }

        if (isset($complemento)) {
            if (Pessoa::validarComplemento($complemento)) {
                $dados["complemento"] = $complemento;
            } else {
                $errors["complemento"]= "O complemento do endereço ultrapassa o limite de caracteres permitidos.";
            }
        }

        if (!empty($erros)) {
            Helpers::dump($erros);
            // TODO: exceções customizadas para visualização amigável dos erros
            throw new Exception("O cadastro não foi alterado pois houve erros na validação dos dados.");
        }
        
        // Monta o DTO de acordo com as mudanças
        foreach(array_keys($dados) as $campo) {
            // Verifica e remove informações repetidas
            if ($dados[$campo] === $registro->$campo) {
                unset($dados[$campo]);   
            }
        }

        // Compara os arrays de telefone para confirmar se houve mudança
        if ($telefones !== $registro->telefones) {
            $dados["telefones"] = $telefones;
        }

        if (empty($dados)) {
            throw new Exception("O cadastro não foi alterado pois não houve nenhuma mudança nos dados.");
        }

        $dados["id"] = $registro->id();

        return new AtualizarPessoaDTO(...$dados);
    }
}