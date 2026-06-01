<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($seo['title'] ?? config('name')) ?></title>
<meta name="description" content="<?= e($seo['description'] ?? '') ?>">
<meta name="robots" content="<?= e($seo['robots'] ?? 'index,follow') ?>">
<link rel="canonical" href="<?= e($seo['canonical'] ?? absolute_url(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/')) ?>">
<meta property="og:title" content="<?= e($seo['og_title'] ?? $seo['title'] ?? config('name')) ?>">
<meta property="og:description" content="<?= e($seo['og_description'] ?? $seo['description'] ?? '') ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?= e($seo['og_url'] ?? $seo['canonical'] ?? absolute_url('/')) ?>">
<meta property="og:site_name" content="<?= e($seo['site_name'] ?? $settings['site_name'] ?? config('name')) ?>">
<?php if (!empty($seo['og_image'])): ?>
<meta property="og:image" content="<?= e(upload_absolute_url($seo['og_image'])) ?>">
<?php endif; ?>
<link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => $seo['schema_type'] ?? 'Organization',
    'name' => $settings['site_name'] ?? config('name'),
    'url' => absolute_url('/'),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>
