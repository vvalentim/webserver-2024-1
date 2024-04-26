<?php

namespace Controllers\Painel;

use Core\App;
use Core\Controller;
use Core\Database;
use Core\Helpers;
use Exception;
use Models\Pessoas\AtualizarPessoaDTO;
use Models\Pessoas\CadastroPessoaDTO;
use Models\Pessoas\Pessoa;
use Models\Pessoas\PessoasDAO;
use Throwable;

class Pessoas extends Controller {
    protected PessoasDAO $daoPessoas;
    protected array $filtroParametros;

    public function __construct() {
        $this->daoPessoas = new PessoasDAO(App::resolve(Database::class));
        $this->filtroParametros = array_keys(get_class_vars(Pessoa::class));
    }
    
    public function cadastrar() {
        try {
            // Filtra os parametros que serão aceitos para montar o DTO
            $parametros = input()->all($this->filtroParametros);

            $dto = CadastroPessoaDTO::montar($parametros);

            $cadastro = $this->daoPessoas->cadastrar($dto);

            if ($cadastro === null) {
                // TODO: tratar falha no cadastro
                throw new Exception("Falha no cadastro.");
            }

            response()->json(get_object_vars($cadastro));

        } catch (Throwable $e) {
            Helpers::dump($e->getMessage(), true);
        }
    }

    public function editar(int $idPessoa) {
        // Filtra os parametros que serão aceitos para montar o DTO
        $parametros = input()->all($this->filtroParametros);

        try {
            if (!$idPessoa) {
                throw new Exception("O id de usuário não é válido.");
            }

            $registro = $this->daoPessoas->buscar($idPessoa);
            $dto = AtualizarPessoaDTO::montar($registro, $parametros);
            $novo = $this->daoPessoas->atualizar($dto);

            // Verifica se atualizou o registro para renderizar as mudanças
            if ($novo === null) {
                throw new Exception("Falha ao tentar editar o cadastro.");
            }
            
            response()->json(get_object_vars($novo));

        } catch (Throwable $e) {
            // TODO: analisar e tratar possíveis problemas
            // TODO: abortar em caso de erro
            Helpers::dump($e->getMessage(), true);
        }
    }

    public function deletar(int $idPessoa) {
        try {
            if (!$idPessoa) {
                throw new Exception("O id de usuário não é válido.");
            }
            
            if ($this->daoPessoas->deletar($idPessoa)) {
                response()->json([]);
            } else {
                throw new Exception("Nenhum registro foi deletado.");
            }

        } catch (Throwable $e) {
            // TODO: analisar e tratar possíveis problemas
            // TODO: abortar em caso de erro
            Helpers::dump($e->getMessage(), true);
        }
    }

    public function formEditar(int $idPessoa) {
        try {
            if (!$idPessoa) {
                throw new Exception("O id de usuário não é válido.");
            }

            $registro = $this->daoPessoas->buscar($idPessoa);
            
            if ($registro instanceof Pessoa) {
                // TODO: puxar dados do CEP por alguma API pública
                $this->setAttribute("pessoa", $registro);
            } else {
                throw new Exception("O cadastro com id '{$idPessoa}' não foi encontrado.");
            }
            
        } catch (Throwable $e) {
            // TODO: analisar e tratar possíveis problemas
            // TODO: abortar em caso de erro
            Helpers::dump($e->getMessage(), true);
        }

        $this->setAttributes([
            "page_layout_css" => "painel",
            "title" => "Painel - Editar cadastro de pessoa",
            "navActiveUri" => "/painel/pessoas",
        ]);

        $this->render(Helpers::getPath("views")."/painel/pessoas/editar.view.php");
    }

    public function formCadastrar() {
        $this->setAttributes([
            "page_layout_css" => "painel",
            "title" => "Painel - Cadastro de pessoas",
            "navActiveUri" => "/painel/pessoas",
        ]);

        $this->render(Helpers::getPath("views")."/painel/pessoas/cadastrar.view.php");
    }
    
    public function view() {
        try {
            // TODO: fazer paginação
            $this->setAttribute("listaPessoas", $this->daoPessoas->buscarTodos());
        } catch (Throwable $e) {
            // TODO: analisar e tratar possíveis problemas
            // TODO: abortar em caso de erro
        }
        
        $this->setAttributes([
            "page_layout_css" => "painel",
            "title" => "Painel - Pessoas",
            "navActiveUri" => "/painel/pessoas",
        ]);

        $this->render(Helpers::getPath("views")."/painel/pessoas/listar.view.php");
    }
}