<?php
$summary = trim((string) ($work['summary'] ?? ''));
$content = trim((string) ($work['content'] ?? ''));
$images = $images ?? [];
$relatedWorks = $relatedWorks ?? [];
$sectorName = trim((string) ($work['sector_name'] ?? 'Obra'));
$location = trim((string) ($work['location'] ?? ''));
?>

<section class="work-detail-hero">
    <div class="container work-detail-hero-grid">
        <div class="work-detail-copy">
            <nav class="breadcrumb work-breadcrumb" aria-label="Você está em">
                <a href="<?= e(url('')) ?>">Início</a>
                <span>/</span>
                <a href="<?= e(url('obras')) ?>">Obras</a>
                <span>/</span>
                <span><?= e($work['name']) ?></span>
            </nav>
            <span class="eyebrow"><?= e($sectorName) ?></span>
            <h1><?= e($work['name']) ?></h1>
            <?php if ($summary): ?>
                <p><?= e($summary) ?></p>
            <?php else: ?>
                <p>Projeto apresentado com foco em contexto, setor atendido e informações essenciais para avaliação técnica.</p>
            <?php endif; ?>

            <div class="work-meta-list" aria-label="Informações da obra">
                <span><?= e($sectorName) ?></span>
                <?php if ($location): ?>
                    <span><?= e($location) ?></span>
                <?php endif; ?>
                <?php if (!empty($work['is_featured'])): ?>
                    <span>Destaque</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="work-detail-visual">
            <?php if (!empty($work['image_path'])): ?>
                <img class="work-detail-image" src="<?= e(upload_url($work['image_path'])) ?>" alt="<?= e($work['image_alt'] ?: $work['name']) ?>" width="680" height="500" fetchpriority="high" decoding="async">
            <?php else: ?>
                <div class="work-detail-placeholder" aria-hidden="true">
                    <span><?= e(mb_substr((string) $work['name'], 0, 1, 'UTF-8')) ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section work-detail-content">
    <div class="container work-content-grid">
        <div>
            <span class="eyebrow">Contexto técnico</span>
            <h2>Sobre a obra</h2>
            <div class="prose">
                <?php if ($content): ?>
                    <?= nl2br(e($content)) ?>
                <?php else: ?>
                    <p>Este conteúdo pode ser detalhado pelo painel administrativo para explicar escopo, desafios, atuação técnica e resultados da obra.</p>
                <?php endif; ?>
            </div>
        </div>
        <aside class="work-side-panel">
            <span>Resumo</span>
            <strong><?= e($sectorName) ?></strong>
            <?php if ($location): ?>
                <p><b>Localização:</b> <?= e($location) ?></p>
            <?php else: ?>
                <p>Informe a localização no painel para contextualizar melhor esta obra no portfólio.</p>
            <?php endif; ?>
            <a class="text-link" href="<?= e(url('contato')) ?>">Conversar sobre projeto semelhante</a>
        </aside>
    </div>
</section>

<?php if ($images): ?>
    <section class="section section-soft work-gallery-section">
        <div class="container">
            <div class="section-heading">
                <span class="eyebrow">Galeria</span>
                <h2>Registros da obra</h2>
                <p>Imagens complementares ajudam a demonstrar escala, acabamento e contexto do projeto.</p>
            </div>
            <div class="work-gallery-grid">
                <?php foreach ($images as $image): ?>
                    <img src="<?= e(upload_url($image['image_path'])) ?>" alt="<?= e($image['image_alt'] ?: $work['name']) ?>" loading="lazy" decoding="async" width="460" height="320">
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="section<?= $images ? '' : ' section-soft' ?> related-works-section">
    <div class="container">
        <div class="section-heading section-heading-row">
            <div>
                <span class="eyebrow">Mesmo setor</span>
                <h2>Outras obras relacionadas</h2>
                <p>Projetos do mesmo segmento reforçam repertório técnico e ajudam a comparar contextos de atuação.</p>
            </div>
            <a class="text-link section-heading-link" href="<?= e(url('obras')) ?>">Ver portfólio completo</a>
        </div>

        <?php if ($relatedWorks): ?>
            <div class="card-grid home-card-grid">
                <?php foreach ($relatedWorks as $relatedWork) View::partial('partials/work-card', ['work' => $relatedWork]); ?>
            </div>
        <?php else: ?>
            <div class="empty-state empty-state-premium">
                <strong>Nenhuma outra obra vinculada a este setor ainda.</strong>
                <p>Quando novas obras forem associadas ao mesmo segmento, elas aparecerão aqui automaticamente.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="home-final-cta">
    <div class="container home-final-cta-inner">
        <span class="eyebrow">Próximo passo</span>
        <h2>Tem uma demanda com perfil semelhante?</h2>
        <p>Fale com a equipe para apresentar o contexto, alinhar expectativas e entender o melhor caminho técnico para o projeto.</p>
        <div class="hero-actions">
            <a class="button" href="<?= e(url('contato')) ?>">Solicitar contato</a>
            <a class="button button-outline" href="<?= e(url('obras')) ?>">Ver outras obras</a>
        </div>
    </div>
</section>
