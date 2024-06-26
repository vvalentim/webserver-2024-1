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
                            <h5>Filtros de busca</h5>
                            <hr>
                        </div>
                        
                        <!-- <div class="row g-2 mb-4">
                            <div class="col-md">
                                <label class="form-label text-sm" for="tipo-pessoa">Tipo</label>
                                <select class="form-select form-select-sm" id="tipo-pessoa">
                                    <option selected>Selecione o tipo de pessoa</option>
                                    <option value="fisica">Pessoa Física</option>
                                    <option value="juridica">Pessoa Jurídica</option>
                                </select>
                            </div>
                        </div> -->

                        <div class="row g-2">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm" placeholder="Busque pelo nome, telefone ou e-mail">
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-sm btn-primary">
                                    <i class="bi bi-search me-1"></i>
                                    <span>Buscar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row bg-light rounded py-3 my-4">
                    <div class="col">
                        <div>
                            <div class="d-flex justify-content-between">
                                <h5>Pessoas</h5>
                                <a type="button" class="btn btn-sm btn-primary ms-2" href="/painel/pessoas/cadastrar">
                                    <i class="bi bi-plus-lg align-middle me-1"></i>
                                    <span>Nova pessoa</span>
                                </a>
                            </div>
                            <hr>
                        </div>
                        <table class="table table-sm table-secondary table-striped table-responsive rounded" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Telefones</th>
                                    <th scope="col">Tipo de pessoa</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pessoas as $pessoa) : ?>
                                <tr>
                                    <td style="vertical-align: middle;"><?= $pessoa->nome(); ?></td>
                                    <td style="vertical-align: middle;">
                                        <?php foreach($pessoa->telefones() as $telefone) : ?>
                                        <div><?= $telefone ?></div>
                                        <?php endforeach; ?>
                                    </td>
                                    <td style="vertical-align: middle;"><?= $pessoa->tipoPessoa(); ?></td>
                                    <td style="vertical-align: middle;">
                                        <div class="d-flex justify-content-end">
                                            <a 
                                                class="d-flex flex-column align-items-center text-decoration-none me-2" 
                                                href="/painel/pessoas/<?= $pessoa->id(); ?>/editar"
                                            >
                                                <i class="text-primary bi bi-pencil-square"></i>
                                                <span>Editar</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Content End -->
            </main>
        </div>
    </div>
<?php require(__DIR__."/../../html.end.php"); ?>