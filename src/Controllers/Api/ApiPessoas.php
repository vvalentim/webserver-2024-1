<?php

namespace Controllers\Api;

use Core\Controller;
use Core\Exceptions\IntegrityConstraintException;
use Core\Exceptions\ValidationException;
use Models\Pessoas\Pessoa;
use Models\Pessoas\ValidacaoPessoa;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

final class ApiPessoas extends Controller {
    protected const FILTROS = [
        "nome",
        "documentoTipo",
        "documento",
        "nascimento",
        "cep",
        "enderecoNumero",
        "enderecoComplemento",
        "telefones"
    ];
    
    protected function validarParametros(): array {
        $parametros = array_filter(input()->all(static::FILTROS), fn($campo) => $campo !== null);

        $faltantes = array_diff(static::FILTROS, array_keys($parametros));
        $validacao = ValidacaoPessoa::validate($parametros);

        if (!empty($faltantes)) {
            foreach($faltantes as $campo) {
                $validacao->addError($campo, "O campo {$campo} é obrigatório.");
            }
        }
        
        if (isset($parametros["documentoTipo"]) && isset($parametros["documento"])) {
            $validacao = match($parametros["documentoTipo"]) {
                "F" => $validacao->cpf($parametros["documento"]),
                "J" => $validacao->cnpj($parametros["documento"]),
                default => $validacao,
            };
        }

        if (!empty($validacao->getErrors())) {
            throw new ValidationException($validacao->getErrors());
        }

        return $parametros;
    }

    protected function buscarPessoa(int $idPessoa): Pessoa {
        $pessoa = Pessoa::findBy("id", $idPessoa);

        if (!$pessoa) {
            throw new NotFoundHttpException();
        }

        return $pessoa; 
    }
    
    public function cadastrar() {
        $parametros = $this->validarParametros();
        $documento = $parametros["documento"];

        $pessoa = Pessoa::fromRequestParams($parametros);

        try {
            $pessoa->save();
            response()->httpCode(201)->json($pessoa->toArray());
        } catch (IntegrityConstraintException $e) {
            $e->setMessage("Não foi possível efetuar o cadastro, o documento '{$documento}' já existe no sistema.");

            throw $e;
        }
    }

    public function editar(int $idPessoa) {
        $pessoa = $this->buscarPessoa($idPessoa);
        $parametros = (object) $this->validarParametros();

        $pessoa->
            setNome($parametros->nome)->
            setDocumentoTipo($parametros->documentoTipo)->
            setDocumento($parametros->documento)->
            setNascimento($parametros->nascimento)->
            setEndereco(
                $parametros->cep,
                $parametros->enderecoNumero,
                $parametros->enderecoComplemento,
            )->
            setTelefones($parametros->telefones);
            
        try {
            $pessoa->save();
            response()->json(["status" => "success"]);
        } catch (IntegrityConstraintException $e) {
            // Exceção lançada caso a alteração no documento cause conflito com outro já no DB (UNIQUE KEY)
            $e->setMessage("Não foi possível alterar o cadastro, o documento '{$parametros->documento}' já existe no sistema.");
            
            throw $e;
        }
    }

    public function deletar(int $idPessoa) {
        $pessoa = $this->buscarPessoa($idPessoa);
        
        try {
            $pessoa->delete();
            response()->json(["status" => "success"]);
        } catch (IntegrityConstraintException $e) {
            // Trata exceção lançada caso o cadastro esteja relacionado a um imóvel (DELETE RESTRICT)
            $e->setMessage("Não foi possível deletar esse cadastro porque existem imóveis vinculados a ele.");
            
            throw $e;
        }
    }

    public function index(?int $idPessoa = null) {
        if ($idPessoa) {
            $pessoa = $this->buscarPessoa($idPessoa);
            $pessoa->telefones();

            response()->json($pessoa->toArray());
        }

        $pessoas = Pessoa::findAll();

        response()->httpCode(200)->json(
            array_map(function($pessoa) {
                $pessoa->telefones();

                return $pessoa->toArray();
            }, $pessoas),
        );
    }
}