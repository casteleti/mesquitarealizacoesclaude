<!doctype html>
<html lang="pt-BR">
<head>
    <?php View::partial('partials/site-head', ['seo' => $seo ?? Seo::meta(['title' => $title ?? config('name')], $settings ?? []), 'settings' => $settings ?? []]); ?>
</head>
<body>
    <?php View::partial('partials/site-header', ['settings' => $settings ?? []]); ?>
    <main id="conteudo">
        <?= $content ?>
    </main>
    <?php View::partial('partials/site-footer', ['settings' => $settings ?? []]); ?>
    <script src="<?= e(asset('js/app.js')) ?>" defer></script>
</body>
</html>
