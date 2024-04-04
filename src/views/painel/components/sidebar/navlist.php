<ul class="nav nav-pills flex-column mb-auto">
    <?php foreach($_sidebarConfig['navItems'] as $_navItem) : ?>
    <li class="nav-item">
        <a 
            href="<?= $_navItem['href']; ?>" 
            class="nav-link <?= $_navItem['href'] === $navActiveUri ? 'active' : 'link-dark' ?>"
        >
            <i class="bi <?= $_navItem['icon']; ?> me-2 align-middle"></i>
            <span class="align-middle"><?= $_navItem['text']; ?></span>
        </a>
    </li>
    <?php endforeach; ?>
</ul>