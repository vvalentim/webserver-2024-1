<?php require(__DIR__."/../html.start.php"); ?>
    <main class="container-sm vh-100">
        <div class="row h-100 justify-content-center">
            <div class="col-sm-4 d-flex flex-column justify-content-center">
                <div class="w-100 mb-5 text-center">
                    <h3>Acesso de colaboradores</h3>
                </div>
                <form method="POST" class="w-100">
                    <div class="mb-4">
                        <label for="identificador" class="form-label fw-semibold">Nome de usuário ou e-mail</label>
                        <input type="text" class="form-control" id="identificador" name="identificador">
                    </div>
                    <div class="mb-2">
                        <div class="d-flex flex-row justify-content-between">
                            <label for="senha" class="form-label fw-semibold">Senha</label>
                            <span class="form-text">
                                <a href="#" class="text-decoration-none fw-semibold">Esqueceu sua senha?</a>
                            </span>
                        </div>
                        <input type="password" class="form-control" id="senha" name="senha">
                    </div>

                    <?php if (isset($login_error_message)) : ?>
                    <div class="form-text text-danger fw-semibold"><?= $login_error_message ?></div>
                    <?php endif; ?>

                    <button type="submit" class="w-100 btn btn-primary fw-semibold mt-2">Entrar</button>
                </form>
            </div>
        </div>
    </main>
<?php require(__DIR__."/../html.end.php"); ?>