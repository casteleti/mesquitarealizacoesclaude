<?php $currentPath = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/', '/'); ?>
<header class="site-header">
    <a class="skip-link" href="#conteudo">Ir para o conteúdo</a>
    <div class="container header-inner">
        <a class="brand" href="<?= e(url('/')) ?>" aria-label="Mesquita Realizações - Página inicial">
            <img class="brand-logo" src="<?= e(asset('images/logotipo-mesquita.svg')) ?>" alt="Mesquita Realizações" width="960" height="320">
        </a>
        <button class="menu-toggle" type="button" data-menu-toggle aria-expanded="false" aria-controls="site-menu" aria-label="Abrir menu">Menu</button>
        <nav id="site-menu" class="site-nav" data-menu>
            <a class="<?= $currentPath === '' ? 'is-active' : '' ?>" href="<?= e(url('/')) ?>" <?= $currentPath === '' ? 'aria-current="page"' : '' ?>>Home</a>
            <a class="<?= $currentPath === 'quem-somos' ? 'is-active' : '' ?>" href="<?= e(url('quem-somos')) ?>" <?= $currentPath === 'quem-somos' ? 'aria-current="page"' : '' ?>>Quem Somos</a>
            <a class="<?= str_starts_with($currentPath, 'setores') ? 'is-active' : '' ?>" href="<?= e(url('setores')) ?>" <?= str_starts_with($currentPath, 'setores') ? 'aria-current="page"' : '' ?>>Setores</a>
            <a class="<?= str_starts_with($currentPath, 'obras') ? 'is-active' : '' ?>" href="<?= e(url('obras')) ?>" <?= str_starts_with($currentPath, 'obras') ? 'aria-current="page"' : '' ?>>Obras</a>
            <a class="<?= $currentPath === 'como-atuamos' ? 'is-active' : '' ?>" href="<?= e(url('como-atuamos')) ?>" <?= $currentPath === 'como-atuamos' ? 'aria-current="page"' : '' ?>>Como Atuamos</a>
            <a class="nav-cta <?= $currentPath === 'contato' ? 'is-active' : '' ?>" href="<?= e(url('contato')) ?>" <?= $currentPath === 'contato' ? 'aria-current="page"' : '' ?>>Fale Conosco</a>
        </nav>
    </div>
</header>
