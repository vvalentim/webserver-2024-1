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
                        
                        <div class="row g-2 mb-4">
                            <div class="col-md">
                                <label class="form-label" for="vinculo">Vínculo</label>
                                <select class="form-select form-select-sm" id="vinculo">
                                    <option selected>Selecione o tipo de vínculo</option>
                                    <option value="cliente">Cliente</option>
                                    <option value="colaborador">Colaborador</option>
                                </select>
                            </div>
                            <div class="col-md">
                                <label class="form-label text-sm" for="tipo-pessoa">Tipo</label>
                                <select class="form-select form-select-sm" id="tipo-pessoa">
                                    <option selected>Selecione o tipo de pessoa</option>
                                    <option value="fisica">Pessoa Física</option>
                                    <option value="juridica">Pessoa Jurídica</option>
                                </select>
                            </div>
                        </div>

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
                                    <th scope="col">Tipo de vínculo</th>
                                    <th scope="col">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaPessoas as $pessoa) : ?>
                                <tr>
                                    <td><?= $pessoa->nome_razao; ?></td>
                                    <td>
                                        <?php foreach($pessoa->telefones as $telefone) : ?>
                                        <div><?= $telefone ?></div>
                                        <?php endforeach; ?>
                                    </td>
                                    <td><?= $pessoa->tipo_pessoa === "F" ? "Pessoa Física" : "Pessoa Jurídica"; ?></td>
                                    <td><?= $pessoa->tipo_vinculo === "CLI" ? "Cliente" : "Colaborador"; ?></td>
                                    <td>
                                        <a href="/painel/pessoas/editar/<?= $pessoa->id(); ?>">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
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