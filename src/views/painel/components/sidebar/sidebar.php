<?php require(__DIR__."/sidebar.config.php"); ?>

<div id="sidebar-wrapper" class="wrapper collapse collapse-horizontal show">
    <aside id="sidebar" class="d-none d-lg-flex flex-column flex-shrink-0 p-3 h-100 bg-light">
        <?php require(__DIR__."/sidebarBrand.php"); ?>
        <hr>
        <?php require(__DIR__."/navlist.php"); ?>
        <hr>
    </aside>
</div>
<div class="offcanvas offcanvas-start p-3" tabindex="-1" id="offcanvas-sidebar" style="width: 270px;">
    <div class="offcanvas-header p-0">
        <?php require(__DIR__."/sidebarBrand.php"); ?>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column p-0 h-100">
        <hr>
        <?php require(__DIR__."/navlist.php"); ?>
        <hr>
    </div>
</div>