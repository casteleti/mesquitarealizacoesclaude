<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'Admin') ?> - <?= e(config('name')) ?></title>
    <link rel="stylesheet" href="<?= e(asset('css/admin.css')) ?>">
</head>
<body>
    <div class="admin-shell">
        <?php View::partial('partials/admin-sidebar'); ?>
        <button class="admin-backdrop" type="button" data-admin-menu-close aria-label="Fechar menu"></button>
        <div class="admin-main">
            <header class="admin-topbar">
                <button type="button" class="menu-toggle" data-admin-menu-toggle aria-label="Abrir menu">Menu</button>
                <div class="topbar-title">
                    <strong><?= e($title ?? 'Painel') ?></strong>
                    <span>Conectado como <?= e(Auth::user()['name'] ?? '') ?></span>
                </div>
                <div class="topbar-actions">
                    <a class="button button-light" href="<?= e(url('')) ?>" target="_blank" rel="noopener">Ver site</a>
                </div>
            </header>
            <section class="admin-content">
                <?php View::partial('partials/flash'); ?>
                <?= $content ?>
            </section>
        </div>
    </div>
    <script src="<?= e(asset('js/admin.js')) ?>" defer></script>
</body>
</html>
