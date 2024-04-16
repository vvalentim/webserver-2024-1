<?php require(__DIR__."/../../html.start.php"); ?>
<?php 
    require(__DIR__."/mock.data.php");

    extract($_mockData["editar"][$idPessoa]);
?>

    <div class="d-flex min-vh-100">
        <?php require(__DIR__."/../components/sidebar/sidebar.php"); ?>
        <div class="container px-4">
            <?php require(__DIR__."/../components/header.php"); ?>
            <main class="container-fluid mt-4">
                <!-- Content Start -->
                <div class="row bg-light rounded py-3">
                    <div class="col">
                        <div>
                            <h5>Editar cadastro de pessoa</h5>
                            <hr>
                        </div>

                        <form method="POST">
                            <p class="fw-semibold">Tipo de cadastro</p>
                            <div class="row g-4 mb-3">
                                <div class="col-md-auto">
                                    <select class="form-select" id="tipo-pessoa" style="min-width: 250px;" data-initial-selected="<?= $tipoPessoa; ?>">
                                        <option value="">Selecione o tipo de pessoa</option>
                                        <option value="fisica">Pessoa Física</option>
                                        <option value="juridica">Pessoa Jurídica</option>
                                    </select>
                                </div>
                                <div class="col-md-auto">
                                    <select class="form-select" id="vinculo" style="min-width: 250px" data-initial-selected="<?= $tipoVinculo; ?>">
                                        <option value="">Selecione o tipo de vínculo</option>
                                        <option value="cliente">Cliente</option>
                                        <option value="colaborador">Colaborador</option>
                                    </select>
                                </div>
                            </div>

                            <p class="fw-semibold">Dados básicos</p>
                            <div class="row g-4 mb-4 campos-cadastro">
                                <div class="col-md">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="nome" 
                                        name="nome" 
                                        placeholder="Nome completo ou Razão social" 
                                        value="<?= $nome; ?>"
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="documento" 
                                        name="documento" 
                                        placeholder="CPF ou CNPJ" 
                                        style="min-width: 220px;"
                                        value="<?= $documento; ?>"
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="nascimento" 
                                        name="nascimento" 
                                        placeholder="Data de nascimento ou fundação" 
                                        style="min-width: 260px"
                                        value="<?= $nascimento; ?>"
                                    >
                                </div>
                            </div>
                            
                            <p class="fw-semibold">Endereço</p>
                            <div class="row g-4 mb-3 campos-cadastro">
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="cep" 
                                        name="cep" 
                                        placeholder="CEP"
                                        value="<?= $cep; ?>"
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="logradouro" 
                                        name="logradouro" 
                                        placeholder="Logradouro" 
                                        style="min-width: 330px;"
                                        value="<?= $logradouro; ?>"
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="numero" 
                                        name="numero" 
                                        placeholder="Número" 
                                        style="min-width: 100px;"
                                        value="<?= $numero; ?>"
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="bairro" name="bairro" 
                                        placeholder="Bairro"
                                        value="<?= $bairro; ?>"
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="cidade" name="cidade" 
                                        placeholder="Cidade"
                                        value="<?= $cidade; ?>"
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <select class="form-select" id="uf" name="uf" style="min-width: 130px" data-initial-selected="<?= $uf; ?>">
                                        <option value="">Selecione a UF</option>
                                        <option value="PR">PR</option>
                                        <option value="AM">AM</option>
                                    </select>
                                </div>
                            </div>
                            
                            <fieldset class="row g-2 campos-cadastro">
                                <legend class="form-label fs-6 fw-semibold">Telefones</legend>
                                <div id="cadastro-telefones" class="col-sm-auto">
                                    <?php foreach($telefones as $chave => $valor) : ?>
                                    <div class="wrapper-telefone d-flex">
                                        <input 
                                            type="text" 
                                            class="form-control me-2" 
                                            name="telefones[]" 
                                            placeholder="Telefone" 
                                            style="min-width: 220px"
                                            value="<?= $valor; ?>"
                                        >
                                        <?php if ($chave === array_key_first($telefones)) : ?>
                                        <button id="btn-telefone-adicional" type="button" class="btn btn-success">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                        <?php else : ?>
                                        <button id="btn-telefone-adicional" type="button" class="btn btn-danger">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </fieldset>

                            <hr>

                            <div class="col-md-12">
                                <a type="button" class="btn btn-secondary" href="/painel/pessoas">
                                    <i class="bi bi-x-circle"></i>
                                    <span>Cancelar</span>
                                </a>
                                <button type="submit" class="btn btn-primary float-end">
                                    <i class="bi bi-floppy2-fill"></i>
                                    <span>Editar</span>
                                </button>
                                <button type="button" class="btn btn-danger float-end me-2">
                                    <i class="bi bi-trash"></i>
                                    <span>Excluir</span>
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
                <!-- Content End -->
            </main>
        </div>
    </div>

    <!-- Carrega os scripts necessários para a página com defer para aguardar a resolução das dependências -->
    <script src="/assets/js/painel/cadastroPessoas.js" type="module" defer></script>

<?php require(__DIR__."/../../html.end.php"); ?>