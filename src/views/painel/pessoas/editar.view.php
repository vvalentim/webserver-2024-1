<?php require(__DIR__."/../../html.start.php"); ?>
<?php require(__DIR__."/view.const.php"); ?>

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
                            <input type="hidden" name="_method" value="PUT">
                            <p class="fw-semibold">Tipo de cadastro</p>
                            <div class="row g-4 mb-3">
                                <div class="col-md-auto">
                                    <select 
                                        class="form-select" 
                                        id="tipo-pessoa" 
                                        name="documentoTipo" 
                                        style="min-width: 250px;" 
                                        data-initial-selected="<?= $pessoa->documentoTipo(); ?>"
                                    >
                                        <option value="F">Pessoa Física</option>
                                        <option value="J">Pessoa Jurídica</option>
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
                                        placeholder="Nome completo" 
                                        value="<?= $pessoa->nome(); ?>"
                                        maxlength="100"
                                        required
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="documento" 
                                        name="documento" 
                                        placeholder="CPF" 
                                        style="min-width: 220px;"
                                        value="<?= $pessoa->documento(); ?>"
                                        maxlength="18"
                                        required
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
                                        value="<?= $pessoa->nascimento(); ?>"
                                        maxlength="10"
                                        required
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
                                        value="<?= $pessoa->cep(); ?>"
                                        maxlength="9"
                                        required
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <select class="form-select" id="uf" name="uf" style="min-width: 130px" data-initial-selected="<?= $uf ?? ""; ?>">
                                        <option value="">Selecione a UF</option>
                                        <?php foreach($_CONST_LISTA_UF as $uf) : ?>
                                        <option value="<?= $uf; ?>"><?= $uf; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="cidade" 
                                        name="cidade" 
                                        placeholder="Cidade"
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="bairro" 
                                        name="bairro" 
                                        placeholder="Bairro"
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
                                        value="<?= $pessoa->enderecoNumero(); ?>"
                                        required
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="complemento" 
                                        name="complemento" 
                                        placeholder="Complemento" 
                                        style="min-width: 150px;"
                                        value="<?= $pessoa->enderecoComplemento(); ?>"
                                    >
                                </div>
                            </div>
                            
                            <fieldset class="row g-2 campos-cadastro">
                                <legend class="form-label fs-6 fw-semibold">Telefones</legend>
                                <div id="cadastro-telefones" class="col-sm-auto">
                                    <?php foreach($pessoa->telefones() as $indice => $telefone) : ?>
                                    <div class="wrapper-telefone d-flex">
                                        <input 
                                            type="text" 
                                            class="form-control me-2" 
                                            name="telefones[]" 
                                            placeholder="Telefone" 
                                            style="min-width: 220px"
                                            value="<?= $telefone; ?>"
                                            maxlength="15"
                                            required
                                        >
                                        <?php if ($indice === array_key_first($pessoa->telefones())) : ?>
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
                                <button type="submit" class="btn btn-danger float-end me-2">
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