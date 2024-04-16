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

    public function __construct(
        protected string $httpMethod, 
        protected array $httpParams,
    ) {
        parent::__construct($httpMethod, $httpParams);
        
        $this->daoPessoas = new PessoasDAO(App::resolve(Database::class));
        $this->filtroParametros = array_keys(get_class_vars(Pessoa::class));

        // TODO: middleware de autenticação/autorização
        if (!Login::autenticado()) {
            parent::redirect("/painel/login", 401);
        }
    }

    protected function atualizar(Pessoa &$registro) {
        // Filtra os parametros que serão aceitos para montar o DTO
        $parametros = array_filter(
            $_POST, 
            fn($chave) => in_array($chave, $this->filtroParametros), 
            ARRAY_FILTER_USE_KEY
        );
        
        $dto = AtualizarPessoaDTO::montar($registro, $parametros);

        $novo = $this->daoPessoas->atualizar($dto);

        // Verifica se atualizou o registro para renderizar as mudanças
        if ($novo === null) {
            throw new Exception("Falha ao tentar editar o cadastro.");
        }

        $registro = $novo;
    }

    public function editar() {
        $idPessoa = (int) $this->httpParams["idPessoa"];

        try {
            if (!$idPessoa) {
                throw new Exception("O id de usuário não é válido.");
            }

            $registro = $this->daoPessoas->buscar($idPessoa);
            
            if ($registro instanceof Pessoa) {
                // Verifica e aplica as atualizações caso o formulário tenha sido submetido
                if ($this->httpMethod === "PATCH") {
                    $this->atualizar($registro);
                }
                
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
        
        $this->setView(Helpers::getPath("views")."/painel/pessoas/editar.view.php");
        $this->setAttribute("title", "Painel - Editar cadastro de pessoa");
        $this->setAttribute("navActiveUri", "/painel/pessoas");
        $this->render();
    }

    public function cadastrar() {
        // Verifica e trata os dados se o formulário for submetido
        if ($this->httpMethod === "POST") {
            try {
                // Filtra os parametros que serão aceitos para montar o DTO
                $parametros = array_filter(
                    $_POST, 
                    fn($chave) => in_array($chave, $this->filtroParametros), 
                    ARRAY_FILTER_USE_KEY
                );

                $dto = CadastroPessoaDTO::montar($parametros);

                $cadastro = $this->daoPessoas->cadastrar($dto);

                if ($cadastro === null) {
                    // TODO: tratar falha no cadastro
                    throw new Exception("Falha no cadastro.");
                }

                $this->redirect("/painel/pessoas");
            } catch (Throwable $e) {
                Helpers::dump($e->getMessage(), true);
            }
        }

        $this->setView(Helpers::getPath("views")."/painel/pessoas/cadastrar.view.php");
        $this->setAttribute("title", "Painel - Cadastro de pessoas");
        $this->setAttribute("navActiveUri", "/painel/pessoas");
        $this->render();
    }

    public function deletar() {
        $idPessoa = (int) $this->httpParams["idPessoa"];

        try {
            if (!$idPessoa) {
                throw new Exception("O id de usuário não é válido.");
            }

            $this->daoPessoas->deletar($idPessoa);
        } catch (Throwable $e) {
            // TODO: analisar e tratar possíveis problemas
            // TODO: abortar em caso de erro
            Helpers::dump($e->getMessage(), true);
        }

        $this->redirect("/painel/pessoas");
    }
    
    public function view() {

        try {
            // TODO: fazer paginação
            $this->setAttribute("listaPessoas", $this->daoPessoas->buscarTodos());
        } catch (Throwable $e) {
            // TODO: analisar e tratar possíveis problemas
            // TODO: abortar em caso de erro
        }
        
        $this->setView(Helpers::getPath("views")."/painel/pessoas/listar.view.php");
        $this->setAttribute("title", "Painel - Pessoas");
        $this->setAttribute("navActiveUri", "/painel/pessoas");
        $this->render();
    }
}