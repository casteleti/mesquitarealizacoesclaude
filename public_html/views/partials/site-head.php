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

<?php if (!empty($seo['preload_image'])): ?>
<link rel="preload" as="image" href="<?= e($seo['preload_image']) ?>">
<?php endif; ?>

<link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-G6RX9JECKS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-G6RX9JECKS');
</script>

<?php
// ── LocalBusiness JSON-LD ────────────────────────────────────────────────────
$sameAs = array_values(array_filter([
    $settings['instagram'] ?? '',
    $settings['facebook']  ?? '',
    $settings['linkedin']  ?? '',
]));

$schemaOrg = [
    '@context' => 'https://schema.org',
    '@type'    => ['LocalBusiness', 'GeneralContractor'],
    'name'     => $settings['site_name'] ?? config('name'),
    'url'      => absolute_url('/'),
    'telephone' => $settings['telefone'] ?? '',
    'email'     => $settings['email']    ?? '',
];

if (!empty($settings['endereco'])) {
    $schemaOrg['address'] = [
        '@type'           => 'PostalAddress',
        'streetAddress'   => $settings['endereco'],
        'addressLocality' => 'Jaboticabal',
        'addressRegion'   => 'SP',
        'addressCountry'  => 'BR',
    ];
}

if ($sameAs) {
    $schemaOrg['sameAs'] = $sameAs;
}
?>
<script type="application/ld+json">
<?= json_encode($schemaOrg, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
</script>

<?php if (!empty($seo['breadcrumb'])): ?>
<script type="application/ld+json"><?= $seo['breadcrumb'] ?></script>
<?php endif; ?>
