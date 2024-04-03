<?php require(__DIR__."/sidebar.config.php"); ?>

<div id="sidebar-wrapper" class="wrapper collapse collapse-horizontal show">
    <aside id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark h-100" style="width: 280px;">
        <a href="/dashboard" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <i class="bi bi-bootstrap-fill me-3 fs-2"></i>
            <span class="fs-4">Painel</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <?php foreach($_sidebarConfig['items'] as $_navItem) : ?>
            <li class="nav-item">
                <a 
                    href="<?= $_navItem['href']; ?>" 
                    class="nav-link <?= $_navItem['href'] === $navActiveUri ? 'active' : 'text-white' ?>" 
                    aria-current="page"
                >
                    <i class="bi <?= $_navItem['icon']; ?> me-2 align-middle"></i>
                    <span class="align-middle"><?= $_navItem['text']; ?></span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-2 fs-2 align-middle"></i>
                <span class="align-middle fw-semibold">Usuário</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li>
                    <a class="dropdown-item" href="#">Sair</a>
                </li>
            </ul>
        </div>
    </aside>
</div>