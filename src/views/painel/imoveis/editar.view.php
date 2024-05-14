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
                        <h5>Editando imóvel</h5>
                        <hr>
                    </div>

                    <form method="POST" enctype="multipart/form-data">
                        <p class="fw-semibold">Tipo de cadastro</p>
                        <div class="row g-4 mb-3">
                            <!-- <div class="col-md-auto">
                                <select 
                                    class="form-select" 
                                    id="id_proprietario" 
                                    name="id_proprietario"
                                    style="min-width: 250px" 
                                    value=""
                                >
                                    <option value="1">Pessoa teste</option>
                                    <option value="2">Pessoa</option>
                                </select>
                            </div> -->
                            <div class="col-md-auto">
                                <select class="form-select" id="tipo_imovel" name="tipo_imovel"
                                    style="min-width: 250px" value="<?= $imovel->tipo() ?>">
                                    <option value="casa">Casa</option>
                                    <option value="casa-cond">Casa em condomí­nio</option>
                                    <option value="apto">Apartamento</option>
                                    <option value="comercial">Comercial</option>
                                    <option value="chacara">Chácara</option>
                                    <option value="outro">Outro</option>
                                </select>
                            </div>
                            <div class="col-md-auto">
                                <select class="form-select" name="finalidade" id="finalidade" style="min-width: 250px" value="<?= $imovel->finalidade() ?>">
                                    <option value="V">Venda</option>
                                    <option value="A">Aluguel</option>
                                </select>
                            </div>
                        </div>

                        <p class="fw-semibold">Anúncio</p>
                        <div class="row g-4 mb-4">
                            <div class="col-md-4">
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <input type="text" id="titulo" class="form-control" name="titulo"
                                            placeholder="Tí­tulo do anúncio" value="<?= $imovel->titulo() ?>">
                                    </div>
                                    <div class="col-12">
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            id="preco" 
                                            name="preco"
                                            placeholder="Preço do imóvel ou do aluguel" value="<?= $imovel->preco(); ?>"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-12">
                                    <textarea name="descricao" class="form-control" id="descricao"
                                        placeholder="Descrição do anúncio" cols="30" rows="4"><?= $imovel->descricao(); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- <div class="row">
                                    <div class="col-3">
                                        <img src="" style="max-height: 90px; width: auto;">
                                    </div>
                                    <div class="col-9">
                                        <label for="imagem">Alterar imagem:</label>
                                        <input type="file" id="imagem" class="form-control" name="imagem" accept="image/*">
                                        <input type="hidden" id="imagem_path" class="form-control" name="imagem_path" value="" accept="image/*">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <p class="fw-semibold">Detalhes</p>
                        <div class="row g-4 mb-4 campos-cadastro">
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="quartos" name="quartos" value="<?= $imovel->qntdQuartos(); ?>"
                                    placeholder="Quantidade de quartos">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="banheiros" name="banheiros"
                                    placeholder="Quantidade de banheiros" value="<?= $imovel->qntdBanheiros(); ?>">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="suites" name="suites"
                                    placeholder="Quantidade de suites" value="<?= $imovel->qntdSuites(); ?>">
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" id="garagens" name="garagens"
                                    placeholder="Quantidade de garagens" value="<?= $imovel->qntdGaragem(); ?>">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="area_util" name="area_util"
                                    placeholder="Área Útil (m2)" value="<?= $imovel->areaUtil(); ?>">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="area_total" name="area_total"
                                    placeholder="Área total (m2)" value="<?= $imovel->areaTotal(); ?>">
                            </div>
                        </div>

                        <p class="fw-semibold">Endereço</p>
                        <div class="row g-4 mb-3 campos-cadastro">
                            <div class="col-md-auto">
                                <input type="text" maxlength="9" class="form-control" id="cep" name="cep" placeholder="CEP" value="<?= $imovel->cep(); ?>">
                            </div>
                            <div class="col-md-auto">
                                <input type="text" class="form-control" id="logradouro" name="logradouro"
                                    placeholder="Logradouro" style="min-width: 330px;" value="<?= $imovel->logradouro(); ?>">
                            </div>
                            <div class="col-md-auto">
                                <input type="text" class="form-control" id="numero" name="numero" placeholder="Número"
                                    style="min-width: 100px;" value="<?= $imovel->enderecoNumero(); ?>">
                            </div>
                            <div class="col-md-auto">
                                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?= $imovel->bairro(); ?>">
                            </div>
                            <div class="col-md-auto">
                                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="<?= $imovel->localidade(); ?>">
                            </div>
                            <div class="col-md-auto">
                                <input type="text" class="form-control" id="uf" name="uf" placeholder="UF" value="<?= $imovel->uf(); ?>">
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