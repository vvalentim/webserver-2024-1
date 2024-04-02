<?php require(__DIR__."/../header.view.php"); ?>
    <main class="container-sm vh-100">
        <div class="row h-100 justify-content-center">
            <div class="col-sm-4 d-flex flex-column justify-content-center">
                <div class="w-100 mb-5 text-center">
                    <h2>Acesso de colaboradores</h2>
                </div>
                <form method="POST" class="w-100">
                    <div class="mb-4">
                        <label for="username" class="form-label fw-semibold">Usuário</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-4">
                        <div class="d-flex flex-row justify-content-between">
                            <label for="password" class="form-label fw-semibold">Senha</label>
                            <span class="form-text">
                                <a href="#" class="text-decoration-none fw-semibold">Esqueceu sua senha?</a>
                            </span>
                        </div>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <?php if (isset($login_error_message)) : ?>
                    <div class="form-text"><?= $login_error_message ?></div>
                    <?php endif; ?>

                    <button type="submit" class="w-100 btn btn-primary fw-semibold">Entrar</button>
                </form>
            </div>
        </div>
    </main>
<?php require(__DIR__."/../footer.view.php"); ?>