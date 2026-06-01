<?php
$banner = is_array($banner ?? null) ? $banner : [];
$page = is_array($page ?? null) ? $page : [];
$defaultLabel = (string) ($defaultLabel ?? 'Mesquita Realizações');
$defaultTitle = (string) ($defaultTitle ?? ($page['title'] ?? ''));
$defaultSubtitle = (string) ($defaultSubtitle ?? ($page['subtitle'] ?? ''));
$label = trim((string) ($banner['eyebrow'] ?? '')) ?: $defaultLabel;
$title = trim((string) ($banner['title'] ?? '')) ?: $defaultTitle;
$subtitle = trim((string) ($banner['subtitle'] ?? '')) ?: $defaultSubtitle;
$desktop = trim((string) ($banner['image_desktop'] ?? $banner['image_path'] ?? ''));
$mobile = trim((string) ($banner['image_mobile'] ?? ''));
$alt = trim((string) ($banner['image_alt'] ?? '')) ?: $title;
$buttonLabel = trim((string) ($banner['button_label'] ?? ''));
$buttonUrl = trim((string) ($banner['button_url'] ?? $banner['link_url'] ?? ''));
$buttonHref = $buttonUrl !== '' && preg_match('#^https?://#i', $buttonUrl) ? $buttonUrl : ($buttonUrl !== '' ? url($buttonUrl) : '');
?>
<section class="internal-banner">
    <div class="container internal-banner-grid">
        <div class="internal-banner-copy">
            <span class="eyebrow"><?= e($label) ?></span>
            <h1><?= e($title) ?></h1>
            <?php if ($subtitle): ?><p><?= e($subtitle) ?></p><?php endif; ?>
            <?php if ($buttonLabel && $buttonHref): ?>
                <a class="text-link internal-banner-link" href="<?= e($buttonHref) ?>"><?= e($buttonLabel) ?></a>
            <?php endif; ?>
        </div>
        <?php if ($desktop): ?>
            <picture class="internal-banner-media">
                <?php if ($mobile): ?><source media="(max-width: 720px)" srcset="<?= e(upload_url($mobile)) ?>"><?php endif; ?>
                <img src="<?= e(upload_url($desktop)) ?>" alt="<?= e($alt) ?>" width="1600" height="650" fetchpriority="high" decoding="async">
            </picture>
        <?php endif; ?>
    </div>
</section>
