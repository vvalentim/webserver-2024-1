<?php require(__DIR__."/../../html.start.php"); ?>

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

                        <form method="POST" action="/api/pessoas">
                            <p class="fw-semibold">Tipo de cadastro</p>
                            <div class="row g-4 mb-3">
                                <div class="col-md-auto">
                                    <select class="form-select" id="tipo-pessoa" name="documentoTipo" style="min-width: 250px;" required>
                                        <option value="F">Pessoa Física</option>
                                        <option value="J">Pessoa Jurídica</option>
                                    </select>
                                </div>
                            </div>

                            <p class="fw-semibold">Dados básicos</p>
                            <div class="row g-4 mb-4 campos-cadastro">
                                <div class="col-md-6">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="nome" 
                                        name="nome" 
                                        placeholder="Nome completo" 
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
                                        placeholder="Data de nascimento" 
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
                                    <input
                                        type="text" 
                                        class="form-control" 
                                        id="uf" 
                                        name="uf" 
                                        placeholder="UF"
                                        style="max-width: 100px;"
                                        readonly
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="localidade" 
                                        name="localidade" 
                                        placeholder="Cidade"
                                        readonly
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="bairro" 
                                        name="bairro" 
                                        placeholder="Bairro"
                                        readonly
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
                                        readonly
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="numero" 
                                        name="enderecoNumero" 
                                        placeholder="Número" 
                                        style="min-width: 100px;"
                                    >
                                </div>
                                <div class="col-md-auto">
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="complemento" 
                                        name="enderecoComplemento" 
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
                                <button id="btn-enviar" type="submit" class="btn btn-success float-end">
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
    
    <div class="toast-container bottom-0 end-0 p-4">
    </div>

    <!-- Carrega os scripts necessários para a página com defer para aguardar a resolução das dependências -->
    <script src="/assets/js/painel/cadastroPessoas.js" type="module" defer></script>

<?php require(__DIR__."/../../html.end.php"); ?>