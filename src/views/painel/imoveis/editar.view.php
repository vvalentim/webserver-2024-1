<?php require(__DIR__."/../../html.start.php"); ?>
<?php require(__DIR__."/mock.data.php"); ?>

<div class="d-flex min-vh-100">
    <?php require(__DIR__."/../components/sidebar/sidebar.php"); ?>
    <div class="container px-4">
        <?php require(__DIR__."/../components/header.php"); ?>
        <main class="container-fluid mt-4">
            <!-- Content Start -->
            <?php
                if (isset($errors)) {
                    echo '<div class="danger card mb-4">';
                    foreach ($errors as $e) {
                        echo '<div>' . $e . ' *</div>';
                    }
                    echo '</div>';
                }
            ?>
            
            <div class="row bg-light rounded py-3">
                <div class="col">
                    <div>
                        <h5>Editando imóvel</h5>
                        <hr>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <p class="fw-semibold">Tipo de cadastro</p>
                        <div class="row g-4 mb-3">
                            <div class="col-md-auto">
                                <select class="form-select" id="id_proprietario" name="id_proprietario"
                                    style="min-width: 250px" value="<?= $imovel['proprietario_id'] ?>">
                                    <option value="1">Pessoa teste</option>
                                    <option value="2">Pessoa</option>
                                </select>
                            </div>
                            <div class="col-md-auto">
                                <select class="form-select" id="tipo_imovel" name="tipo_imovel"
                                    style="min-width: 250px" value="<?= $imovel['tipo_imovel'] ?>">
                                    <option value="casa">Casa</option>
                                    <option value="casa-cond">Casa em condomí­nio</option>
                                    <option value="apto">Apartamento</option>
                                    <option value="comercial">Comercial</option>
                                    <option value="chacara">Chácara</option>
                                    <option value="outro">Outro</option>
                                </select>
                            </div>
                            <div class="col-md-auto">
                                <select class="form-select" name="finalidade" id="finalidade" style="min-width: 250px" value="<?= $imovel['finalidade'] ?>">
                                    <option value="v">Venda</option>
                                    <option value="a">Aluguel</option>
                                </select>
                            </div>
                        </div>

                        <p class="fw-semibold">Anúncio</p>
                        <div class="row g-4 mb-4">
                            <div class="col-md-4">
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <input type="text" id="titulo" class="form-control" name="titulo"
                                            placeholder="Tí­tulo do anúncio" value="<?= $imovel['titulo'] ?>">
                                    </div>
                                    <div class="col-12">
                                        <input type="number" class="form-control" id="preco" name="preco"
                                            placeholder="Preço do imóvel ou do aluguel" value="<?= $imovel['preco'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-12">
                                    <textarea name="descricao" class="form-control" id="descricao"
                                        placeholder="Descrição do anúncio" cols="30" rows="4"><?= $imovel['descricao'] ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-3">
                                        <img src="<?= str_replace("public/", "../../../", $imovel["imagem_path"]); ?>" style="max-height: 90px; width: auto;">
                                    </div>
                                    <div class="col-9">
                                        <label for="imagem">Alterar imagem:</label>
                                        <input type="file" id="imagem" class="form-control" name="imagem" accept="image/*">
                                        <input type="hidden" id="imagem_path" class="form-control" name="imagem_path" value="<?= $imovel["imagem_path"]; ?>" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="fw-semibold">Detalhes</p>
                        <div class="row g-4 mb-4 campos-cadastro">
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="quartos" name="quartos" value="<?= $imovel['qntd_quartos'] ?>"
                                    placeholder="Quantidade de quartos">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="banheiros" name="banheiros"
                                    placeholder="Quantidade de banheiros" value="<?= $imovel['qntd_banheiros'] ?>">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="suites" name="suites"
                                    placeholder="Quantidade de suites" value="<?= $imovel['qntd_suites'] ?>">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="garagens" name="garagens"
                                    placeholder="Quantidade de garagens" value="<?= $imovel['qntd_garagem'] ?>">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="area_util" name="area_util"
                                    placeholder="Área Útil (m2)" value="<?= $imovel['area_util'] ?>">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="area_total" name="area_total"
                                    placeholder="Área total (m2)" value="<?= $imovel['area_total'] ?>">
                            </div>
                        </div>

                        <?php
                            $endereco = explode(', ', $imovel['complemento']);
                        ?>

                        <p class="fw-semibold">Endereço</p>
                        <div class="row g-4 mb-3 campos-cadastro">
                            <div class="col-md-auto">
                                <input type="number" maxlength="8" class="form-control" id="cep" name="cep" placeholder="CEP" value="<?= $imovel['cep'] ?>">
                            </div>
                            <div class="col-md-auto">
                                <input type="text" class="form-control" id="logradouro" name="logradouro"
                                    placeholder="Logradouro" style="min-width: 330px;" value="<?= $endereco[0] ?>">
                            </div>
                            <div class="col-md-auto">
                                <input type="text" class="form-control" id="numero" name="numero" placeholder="Número"
                                    style="min-width: 100px;" value="<?= $imovel['numero'] ?>">
                            </div>
                            <div class="col-md-auto">
                                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?= $endereco[1] ?>">
                            </div>
                            <div class="col-md-auto">
                                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="<?= $endereco[2] ?>">
                            </div>
                            <div class="col-md-auto">
                                <select class="form-select" id="uf" name="uf" style="min-width: 130px" value="<?= $imovel['uf'] ?>">
                                    <option value="PR">PR</option>
                                    <option value="AM">AM</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="col-md-12">
                            <a type="button" class="btn btn-secondary" href="/painel/imoveis">
                                <i class="bi bi-x-circle"></i>
                                <span>Cancelar</span>
                            </a>
                            <button type="submit" class="btn btn-success float-end">
                                <i class="bi bi-plus-lg"></i>
                                <span>Salvar</span>
                            </button>
                        </div>

                    </form>

                </div>
            </div>
            <!-- Content End -->
        </main>
    </div>
</div>

<script src="/assets/js/painel/cadastroImoveis.js" type="module" defer></script>

<?php require(__DIR__."/../../html.end.php"); ?>