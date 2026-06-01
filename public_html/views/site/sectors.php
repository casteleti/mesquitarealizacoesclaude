<?php
$title = trim((string) ($page['title'] ?? 'Setores'));
$subtitle = trim((string) ($page['subtitle'] ?? ''));
$content = trim((string) ($page['content'] ?? ''));

$sectorButtonUrl = static function (array $sector): string {
    $custom = trim((string) ($sector['button_url'] ?? ''));
    if ($custom !== '') {
        return preg_match('#^https?://#i', $custom) ? $custom : url($custom);
    }

    return url('setores/' . ($sector['slug'] ?? ''));
};

$sectorButtonLabel = static function (array $sector): string {
    $label = trim((string) ($sector['button_label'] ?? ''));
    return $label !== '' ? $label : 'Ver obras de ' . mb_strtolower((string) ($sector['name'] ?? 'setor'), 'UTF-8');
};
?>

<?php if (!empty($internalBanner)): ?>
    <?php View::partial('partials/internal-banner', [
        'banner' => $internalBanner,
        'page' => $page,
        'defaultLabel' => 'Setores',
        'defaultTitle' => $title ?: 'Setores',
        'defaultSubtitle' => $subtitle ?: 'Áreas de atuação da Mesquita Realizações.',
    ]); ?>
<?php else: ?>
    <section class="sector-page-band">
        <div class="container sector-page-band-inner">
            <span class="eyebrow">Setores</span>
            <h1><?= e($title ?: 'Setores') ?></h1>
            <?php if ($subtitle): ?><p><?= e($subtitle) ?></p><?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<section class="sector-operations sector-operations-open">
    <div class="container">
        <?php if ($sectors): ?>
            <div class="sector-operations-shell" data-sector-tabs>
                <aside class="sector-operations-nav" aria-label="Setores cadastrados">
                    <span class="sector-nav-label">Navegue</span>
                    <div class="sector-nav-list" role="tablist" aria-orientation="vertical">
                        <?php foreach ($sectors as $index => $sector): ?>
                            <?php $panelId = 'sector-panel-' . (int) $sector['id']; ?>
                            <button class="<?= $index === 0 ? 'is-active' : '' ?>" type="button" role="tab" id="sector-tab-<?= (int) $sector['id'] ?>" aria-selected="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="<?= e($panelId) ?>" data-sector-tab data-target="<?= e($panelId) ?>">
                                <?= e($sector['name']) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </aside>

                <div class="sector-operations-panels">
                    <?php foreach ($sectors as $index => $sector): ?>
                        <?php
                        $panelId = 'sector-panel-' . (int) $sector['id'];
                        $imagePath = $sector['image_path'] ?: ($sector['thumbnail_path'] ?? '');
                        $summary = trim((string) ($sector['summary'] ?? ''));
                        $fullText = trim((string) ($sector['content'] ?? ''));
                        ?>
                        <article class="sector-operations-panel <?= $index === 0 ? 'is-active' : '' ?>" id="<?= e($panelId) ?>" role="tabpanel" aria-labelledby="sector-tab-<?= (int) $sector['id'] ?>" data-sector-panel <?= $index === 0 ? '' : 'hidden' ?>>
                            <div class="sector-operations-media">
                                <?php if ($imagePath): ?>
                                    <img src="<?= e(upload_url($imagePath)) ?>" alt="<?= e($sector['image_alt'] ?: $sector['name']) ?>" loading="<?= $index === 0 ? 'eager' : 'lazy' ?>" decoding="async" width="1600" height="1000">
                                <?php else: ?>
                                    <div class="sector-operations-placeholder" aria-hidden="true">
                                        <svg viewBox="0 0 48 48" focusable="false" aria-hidden="true">
                                            <path d="M10 38h28a4 4 0 0 0 4-4V14a4 4 0 0 0-4-4H10a4 4 0 0 0-4 4v20a4 4 0 0 0 4 4Z" fill="none" stroke="currentColor" stroke-width="1.8"/>
                                            <path d="m12 32 8-8 6 6 4-4 6 6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                            <circle cx="32" cy="18" r="2.2" fill="currentColor"/>
                                        </svg>
                                        <span>Imagem não cadastrada</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="sector-operations-copy">
                                <span class="sector-kicker">Setor</span>
                                <h2><?= e($sector['name']) ?></h2>

                                <?php if ($summary): ?>
                                    <p class="sector-lead"><?= e($summary) ?></p>
                                <?php else: ?>
                                    <p class="sector-lead">Atuação estruturada para demandas industriais que exigem método, controle técnico e previsibilidade de execução.</p>
                                <?php endif; ?>

                                <div class="sector-technical-text">
                                    <?php if ($fullText): ?>
                                        <?= nl2br(e($fullText)) ?>
                                    <?php else: ?>
                                        <p>Este setor pode receber textos mais completos pelo painel administrativo, com contexto de atuação, tipos de obra e diferenciais operacionais.</p>
                                    <?php endif; ?>
                                </div>

                                <div class="sector-operations-actions">
                                    <a class="button" href="<?= e($sectorButtonUrl($sector)) ?>"><?= e($sectorButtonLabel($sector)) ?> <span aria-hidden="true">→</span></a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-state empty-state-premium">
                <strong>Nenhum setor publicado.</strong>
                <p>Assim que os setores forem cadastrados no painel, esta página exibirá a navegação técnica com conteúdo e imagem de cada segmento.</p>
            </div>
        <?php endif; ?>
    </div>
</section>
