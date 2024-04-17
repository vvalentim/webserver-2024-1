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
                            <h5>Cadastrar nova pessoa</h5>
                            <hr>
                        </div>

                        <form method="POST">
                            <p class="fw-semibold">Tipo de cadastro</p>
                            <div class="row g-4 mb-3">
                                <div class="col-md-auto">
                                    <select class="form-select" id="tipo-pessoa" name="tipo_pessoa" style="min-width: 250px;" required>
                                        <option value="" selected>Selecione o tipo de pessoa</option>
                                        <option value="F">Pessoa Física</option>
                                        <option value="J">Pessoa Jurídica</option>
                                    </select>
                                </div>
                                <div class="col-md-auto">
                                    <select class="form-select" id="vinculo" name="tipo_vinculo" style="min-width: 250px" required>
                                        <option value="" selected>Selecione o tipo de vínculo</option>
                                        <option value="CLI">Cliente</option>
                                        <option value="COL">Colaborador</option>
                                    </select>
                                </div>
                            </div>

                            <p class="fw-semibold">Dados básicos</p>
                            <div class="row g-4 mb-4 campos-cadastro">
                                <div class="col-md-6">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="nome" name="nome_razao" 
                                        placeholder="Nome completo ou Razão social" 
                                        maxlength="60" 
                                        required
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
                                        maxlength="18" 
                                        required
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="nascimento" 
                                        name="data_nasc_fund" 
                                        placeholder="Data de nascimento ou fundação" 
                                        maxlength="10" 
                                        style="min-width: 260px"
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
                                        maxlength="9"
                                        required
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <select class="form-select" id="uf" name="uf" style="min-width: 130px">
                                        <option selected>Selecione a UF</option>
                                        <?php foreach($_UF as $uf) : ?>
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
                                        id="numero" name="numero" 
                                        placeholder="Número" 
                                        style="min-width: 100px;"
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
                                    >
                                </div>
                            </div>
                            
                            <fieldset class="row g-2 campos-cadastro">
                                <legend class="form-label fs-6 fw-semibold">Telefones</legend>
                                <div id="cadastro-telefones" class="col-sm-auto">
                                    <div class="wrapper-telefone d-flex">
                                        <input 
                                            type="text" 
                                            class="form-control me-2" 
                                            name="telefones[]" 
                                            placeholder="Telefone" 
                                            style="min-width: 220px"
                                            maxlength="15"
                                            required
                                        >
                                        <button id="btn-telefone-adicional" type="button" class="btn btn-success">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            </fieldset>

                            <hr>

                            <div class="col-md-12">
                                <a type="button" class="btn btn-secondary" href="/painel/pessoas">
                                    <i class="bi bi-x-circle"></i>
                                    <span>Cancelar</span>
                                </a>
                                <button type="submit" class="btn btn-success float-end">
                                    <i class="bi bi-plus-lg"></i>
                                    <span>Cadastrar</span>
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