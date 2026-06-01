<?php
$currentPath = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/', '/');

// Contato + redes do menu mobile — mesma fonte do rodapé (config editável no painel)
$navPhone       = trim((string) ($settings['telefone'] ?? ''));
$navEmail       = trim((string) ($settings['email'] ?? ''));
$navPhoneDigits = preg_replace('/\D+/', '', $navPhone);
$navSocial = [
    ['label' => 'LinkedIn',  'url' => trim((string) ($settings['linkedin']  ?? '')), 'icon' => 'linkedin.svg'],
    ['label' => 'Instagram', 'url' => trim((string) ($settings['instagram'] ?? '')), 'icon' => 'instagram.svg'],
    ['label' => 'Facebook',  'url' => trim((string) ($settings['facebook']  ?? '')), 'icon' => 'facebook.svg'],
];
?>
<header class="site-header" data-site-header>
    <a class="skip-link" href="#conteudo">Ir para o conteúdo</a>
    <div class="container header-inner">
        <a class="brand" href="<?= e(url('/')) ?>" aria-label="Mesquita Realizações - Página inicial">
            <img class="brand-logo" src="<?= e(asset('images/logotipo-mesquita.svg')) ?>" alt="Mesquita Realizações" width="960" height="320">
        </a>
        <button class="menu-toggle" type="button" data-menu-toggle aria-expanded="false" aria-controls="site-menu" aria-label="Abrir menu">
            <span class="menu-toggle-box" aria-hidden="true">
                <span class="menu-toggle-bar"></span>
                <span class="menu-toggle-bar"></span>
                <span class="menu-toggle-bar"></span>
            </span>
        </button>
        <nav id="site-menu" class="site-nav" data-menu>
            <button class="nav-close" type="button" data-menu-close aria-label="Fechar menu">
                <span class="nav-close-box" aria-hidden="true">
                    <span class="nav-close-bar"></span>
                    <span class="nav-close-bar"></span>
                </span>
            </button>
            <a class="<?= $currentPath === '' ? 'is-active' : '' ?>" href="<?= e(url('/')) ?>" <?= $currentPath === '' ? 'aria-current="page"' : '' ?>>Home</a>
            <a class="<?= $currentPath === 'quem-somos' ? 'is-active' : '' ?>" href="<?= e(url('quem-somos')) ?>" <?= $currentPath === 'quem-somos' ? 'aria-current="page"' : '' ?>>Quem Somos</a>
            <a class="<?= str_starts_with($currentPath, 'setores') ? 'is-active' : '' ?>" href="<?= e(url('setores')) ?>" <?= str_starts_with($currentPath, 'setores') ? 'aria-current="page"' : '' ?>>Setores</a>
            <a class="<?= str_starts_with($currentPath, 'obras') ? 'is-active' : '' ?>" href="<?= e(url('obras')) ?>" <?= str_starts_with($currentPath, 'obras') ? 'aria-current="page"' : '' ?>>Obras</a>
            <a class="<?= $currentPath === 'como-atuamos' ? 'is-active' : '' ?>" href="<?= e(url('como-atuamos')) ?>" <?= $currentPath === 'como-atuamos' ? 'aria-current="page"' : '' ?>>Como Atuamos</a>
            <a class="nav-cta <?= $currentPath === 'contato' ? 'is-active' : '' ?>" href="<?= e(url('contato')) ?>" <?= $currentPath === 'contato' ? 'aria-current="page"' : '' ?>>Fale Conosco</a>

            <div class="nav-contact">
                <?php if ($navPhone !== '' && $navPhoneDigits !== ''): ?>
                    <a class="nav-contact-btn" href="tel:<?= e($navPhoneDigits) ?>">
                        <img src="<?= e(asset('icons/phone-call.svg')) ?>" alt="" aria-hidden="true" width="20" height="20">
                        <span><?= e($navPhone) ?></span>
                    </a>
                <?php endif; ?>
                <?php if ($navEmail !== ''): ?>
                    <a class="nav-contact-btn nav-contact-btn-light" href="mailto:<?= e($navEmail) ?>">
                        <img src="<?= e(asset('icons/o-email.svg')) ?>" alt="" aria-hidden="true" width="20" height="20">
                        <span>Enviar E-mail</span>
                    </a>
                <?php endif; ?>
                <div class="nav-social" aria-label="Redes sociais">
                    <?php foreach ($navSocial as $social): ?>
                        <?php $href = $social['url'] !== '' ? $social['url'] : '#'; $external = $href !== '#'; ?>
                        <a class="nav-social-icon" href="<?= e($href) ?>"
                           <?= $external ? 'target="_blank" rel="noopener noreferrer"' : '' ?>
                           aria-label="<?= e($social['label']) ?> da Mesquita Realizações">
                            <img src="<?= e(asset('icons/' . $social['icon'])) ?>" alt="<?= e($social['label']) ?>" width="22" height="22" loading="lazy">
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </nav>
    </div>
</header>
