<div class="dropdown">
    <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-person-circle fs-2 me-2"></i>
        <strong><?= $_SESSION["usuario"]["nome"] ?? "Usuário"; ?></strong>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li>
            <a class="dropdown-item" href="#">Perfil</a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item" href="/painel/logout">Sair</a>
        </li>
    </ul>
</div>