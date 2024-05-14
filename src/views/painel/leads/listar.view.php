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
                                <h5>Leads</h5>
                            </div>
                            <hr>
                        </div>
                        <table class="table table-sm table-secondary table-striped table-responsive rounded" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Assunto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($leads as $lead) : ?>
                                <tr>
                                    <td style="vertical-align: middle;"><?= $lead->nome(); ?></td>
                                    <td style="vertical-align: middle;">
                                        <?= $lead->email(); ?>
                                    </td>
                                    <td style="vertical-align: middle;"><?= $lead->telefone(); ?></td>
                                    <td style="vertical-align: middle;"><?= $lead->assunto(); ?></td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <a class="d-flex flex-column align-items-center text-decoration-none me-3" href="#">
                                                <i class="text-primary bi bi-envelope-open"></i>
                                                <span>Visualizar</span>
                                            </a>
                                            <a class="d-flex flex-column align-items-center text-decoration-none text-danger" href="#">
                                                <i class="bi bi-trash"></i>
                                                <span>Excluir</span>
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