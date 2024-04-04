<?php require(__DIR__."/../header.view.php"); ?>
    <div class="d-flex vh-100">
        <?php require(__DIR__."/components/sidebar/sidebar.php"); ?>
        <div class="container">
            <nav class="navbar my-2 bg-light rounded">
                <div class="container-fluid">
                    <button class="navbar-toggler d-none d-lg-block" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-wrapper">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-sidebar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        </div>
    </div>
<?php require(__DIR__."/../footer.view.php"); ?>