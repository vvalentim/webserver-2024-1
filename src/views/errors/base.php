<?php require(__DIR__."/../html.start.php"); ?>

    <main class="container-sm vh-100">
        <div class="row h-100 justify-content-center">
            <div class="col-sm-4 d-flex flex-column justify-content-center text-center">
                <h2><?= $code; ?></h2>
                <h1 class="my-4"><?= $title; ?></h1>
                <p class=""><?= $description; ?></p>
                <a href="/" class="text-decoration-none my-3">Ir para página inicial</a>
                <div>
                    <a href="javascript:history.go(-1)" class="btn btn-primary btn-sm">Retornar para a página anterior</a>
                </div>
            </div>
        </div>
    </main>
    
<?php require(__DIR__."/../html.end.php"); ?>