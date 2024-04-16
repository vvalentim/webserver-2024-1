<?php require (__DIR__ . "/../html.start.php"); ?>
<main class="container-fluid mt-4 p-0">
    <?php require (__DIR__ . "/components/site-header.php"); ?>
    <section class="position-relative pt-0">
        <div class="container-fluid p-0">
            <img src="https://c.wallhere.com/photos/fe/72/1920x1080_px_building_Empire_State_Building_Manhattan_New_York_City_Urban_Exploration-1322187.jpg!d"
                class="img-fluid w-100" alt="">
        </div>
        <div class="floating-form">
            <form action="javascript:void(0);">
                <div class="row">
                    <div class="col-3">
                        <label for="title">
                            Tí­tulo
                        </label>
                        <input type="text" name="title" id="title">
                    </div>
                    <div class="col-2">
                        <label for="type">
                            Tipo imóvel
                        </label>
                        <select name="type" id="type">
                            <option value="apto">Apartamento</option>
                            <option value="casa">Casa</option>
                            <option value="chacara">Chácara</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="city">
                            Cidade
                        </label>
                        <input type="text" name="city" id="city">
                    </div>
                    <div class="col-3">
                        <label for="title">
                            Preço
                        </label>
                        <input type="text" name="title" id="title">
                    </div>
                    <div class="col-1 d-flex align-items-end">
                        <button onclick="search()" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="pt-0">
        <div class="container site-section-container">
            <h2>
                Destaques
            </h2>
            <div class="row gx-4 gy-4">
                <div class="col-4">
                    <a href="">
                        <div class="house-card card-box-shadow">
                            <img src="https://baseforteimoveis.s3.sa-east-1.amazonaws.com/imoveis/casa-venda-centro-ponta-grossa-1378-uVGQq3Ykg1.JPG"
                                alt="">
                            <div class="content">
                                <h3>Casa do hobbit</h3>
                                <p class="max-3-lines">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minus,
                                    laborum eum. Fuga nesciunt non, perferendis voluptates ipsum accusantium illo
                                    accusamus dicta ipsa minus eligendi omnis delectus inventore molestias magni ullam!
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <div class="house-card card-box-shadow">
                        <img src="https://casacor.abril.com.br/wp-content/uploads/sites/7/2023/03/casa-praia-ares-pousada-litoral-paulista-studio-a-g-credito-monica-assam-piscina18.jpg?quality=90&strip=info&w=720&crop=1"
                            alt="">
                        <div class="content">
                            <h3></h3>
                            <p class="max-3-lines"></p>
                            <a href=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="house-card card-box-shadow">
                        <img src="https://img.freepik.com/fotos-gratis/villa-com-piscina-de-luxo-espetacular-design-contemporaneo-arte-digital-imoveis-casa-casa-e-propriedade-ge_1258-150749.jpg"
                            alt="">
                        <div class="content">
                            <h3></h3>
                            <p class="max-3-lines"></p>
                            <a href=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="house-card card-box-shadow">
                        <img src="https://fotos.vivadecora.com.br/decoracao-casa-moderna-casa-j-a-fachada-externa-revisitearquiteturaeconstru-295624-proportional-height_cover_medium.jpg"
                            alt="">
                        <div class="content">
                            <h3></h3>
                            <p class="max-3-lines"></p>
                            <a href=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="house-card card-box-shadow">
                        <img src="https://fotos.vivadecora.com.br/decoracao-casa-americana-parede-de-tijolinho-porta-branca-e-pilar-branco-revistavivadecora2-213917-proportional-height_cover_medium.jpg"
                            alt="">
                        <div class="content">
                            <h3></h3>
                            <p class="max-3-lines"></p>
                            <a href=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="alt-bg">
        <div class="container">
            <h2>AnÃÂºncios</h2>
            <div class="row gx-3 gy-3">
                <div class="col-3">
                    <a href="">
                        <div class="image-title-card">
                            <img src="https://fotos.vivadecora.com.br/decoracao-casas-modernas-vasos-esmaltados-cinza-e-escada-com-iluminacao-revistavd-202167-proportional-height_cover_medium.jpg" alt="">
                            <div class="title">Lorem Ipsum</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="mt-4">
                <a href="" class="see-all-btn">
                    Ver todos
                </a>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <h2>
                Fale conosco
            </h2>
            <div class="contact-area">
                <form action="javascript:void(0)" id="leadForm">
                    <div class="row gy-2">
                        <div class="col-12">
                            <label for="name">Nome*</label>
                            <input type="text" id="name" name="name">
                            <span class="text-danger mb-1 div-none" style="font-size: 0.8;" id="name-error">Campo obrigatório</span>
                        </div>
                        <div class="col-6">
                            <label for="phone">Telefone*</label>
                            <input type="text" id="phone" name="phone" class="phonemasked" max-length="16">
                            <span class="text-danger mb-1 div-none" style="font-size: 0.8;" id="phone-error">Campo obrigatório</span>
                        </div>
                        <div class="col-6">
                            <label for="email">E-mail*</label>
                            <input type="text" id="email" name="email">
                            <span class="text-danger mb-1 div-none" style="font-size: 0.8;" id="email-error">Campo obrigatório</span>
                        </div>
                        <div class="col-12">
                            <label for="subject">Motivo*</label>
                            <select name="subject" id="subject">
                                <option value="">Selecione um motivo</option>
                                <option value="Dúvida">Dúvidas</option>
                                <option value="Interesse">Interesse</option>
                                <option value="Outros">Outros</option>
                            </select>
                            <span class="text-danger mb-1 div-none" style="font-size: 0.8;" id="subject-error">Campo obrigatório</span>
                        </div>
                        <div class="col-12">
                            <label for="message">Mensagem</label>
                            <textarea id="message" rows="4"></textarea>
                        </div>
                        <div class="col-4 mt-4">
                            <button class="btn btn-primary custom-btn" onclick="enviarLead()">Enviar</button>
                        </div>
                    </div>
                </form>
                <div id="leadSuccess" class="div-none bg-success text-white mt-2" style="padding: 10px 1rem; border-radius: 4px; width: fit-content;"></div>
            </div>
        </div>
    </section>
</main>
<?php require (__DIR__ . "/components/site-footer.php"); ?>
<?php require (__DIR__ . "/../html.end.php"); ?>