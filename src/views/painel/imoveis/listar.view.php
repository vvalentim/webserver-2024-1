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

                        <form method="GET">
                            <div class="row g-2">
                                <div class="col">
                                    <input type="text" name="filter" class="form-control form-control-sm" placeholder="Busque pelo título ou endereço" value="<?php echo $filter ?? '' ?>">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="bi bi-search me-1"></i>
                                        <span>Buscar</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row bg-light rounded py-3 my-4">
                    <div class="col">
                        <div>
                            <div class="d-flex justify-content-between">
                                <h5>Imóveis</h5>
                                <a type="button" class="btn btn-sm btn-primary ms-2" href="/painel/imoveis/cadastrar">
                                    <i class="bi bi-plus-lg align-middle me-1"></i>
                                    <span>Novo imóvel</span>
                                </a>
                            </div>
                            <hr>
                        </div>
                        <table class="table table-sm table-secondary table-striped table-responsive rounded" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th scope="col">Imagem</th>
                                    <th scope="col">Anúncio</th>
                                    <th scope="col">Preço (R$)</th>
                                    <th scope="col">Endereço</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($imoveis as $imovel) : ?>
                                <tr>
                                    <td style="vertical-align: middle;"><img src="<?= str_replace("public/", "../", $imovel["imagem_path"]); ?>" class="img-fluid" style="max-width: 80px;"></td>
                                    <td style="vertical-align: middle;">
                                        <?= $imovel["titulo"] ?>
                                    </td>
                                    <td style="vertical-align: middle;"><?= str_replace(".", ",", $imovel["preco"]); ?></td>
                                    <td style="vertical-align: middle;"><?= $imovel["complemento"]; ?></td>
                                    <td style="vertical-align: middle; text-align: end;">
                                        <a href="/painel/imoveis/editar/<?= $imovel["id"] ?>"><i class="text-primary bi bi-pen me-1" style="font-size: 1.5rem"></i></a>
                                        <a href="javascript:void(0)" onclick="removerImovel(<?= $imovel['id'] ?>)"><i class="text-danger bi bi-trash me-1" style="font-size: 1.5rem"></i></a>
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
<script src="/assets/js/painel/listaImoveis.js" defer></script>
<?php require(__DIR__."/../../html.end.php"); ?>