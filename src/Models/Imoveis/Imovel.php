<?php

namespace Models\Imoveis;

use Core\ActiveRecord;

/**
 * @method int idProprietario()
 * @method string titulo()
 * @method string descricao()
 * @method string tipo()
 * @method string preco()
 * @method int qntdQuartos()
 * @method int qntdBanheiros()
 * @method int qntdSuites()
 * @method int qntdGaragem()
 * @method string areaUtil()
 * @method string areaTotal()
 * @method string cep()
 * @method string enderecoNumero()
 * @method string enderecoComplemento()
 * 
 * @method Imovel setIdProprietario(int $id)
 * @method Imovel setTitulo(string $titulo)
 * @method Imovel setDescricao(string $descricao)
 * @method Imovel setTipo(string $tipo)
 * @method Imovel setPreco(string $preco)
 * 
 * @method Imovel setEnderecoNumero(string $numero)
 * @method Imovel setEnderecoComplemento(string $complemento = "")
 */
final class Imovel extends ActiveRecord {
    protected const TABLE = "imoveis";

    protected int $id_proprietario;
    protected string $titulo;
    protected string $descricao;
    protected string $tipo;
    protected string $preco;
    protected int $qntd_quartos;
    protected int $qntd_banheiros;
    protected int $qntd_suites;
    protected int $qntd_garagem;
    protected string $area_util;
    protected string $area_total;
    protected string $cep;
    protected string $endereco_numero;
    protected string $endereco_complemento;

    public function setAmbientes(int $quartos, int $banheiros, int $suites, int $garagem): Imovel {
        $this->qntd_quartos = $quartos;
        $this->qntd_banheiros = $banheiros;
        $this->qntd_suites = $suites;
        $this->qntd_garagem = $garagem;

        return $this;
    }

    public function setArea(string $areaUtil, string $areaTotal): Imovel {
        $this->area_util = $areaUtil;
        $this->area_total = $areaTotal;

        return $this;
    }
    
    public function setEndereco($cep, $numero, $complemento = ""): Imovel {
        $this->cep = preg_replace("/[^0-9]+/", "", $cep);
        $this->endereco_numero = $numero;
        $this->endereco_complemento = $complemento;

        return $this;
    }
}