<?php
$heroTitle    = trim((string) ($pagina['hero_titulo'] ?? 'Setores'));
$heroSubtitle = trim((string) ($pagina['hero_subtitulo'] ?? ''));
?>

<section class="page-hero">
    <div class="container page-hero-grid">
        <div class="page-hero-copy">
            <span class="eyebrow">Setores</span>
            <h1><?= e($heroTitle) ?></h1>
            <?php if ($heroSubtitle): ?>
                <p><?= e($heroSubtitle) ?></p>
            <?php else: ?>
                <p>Áreas em que a Mesquita Realizações concentra experiência, método e capacidade de execução.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section setores-section">
    <div class="container">
        <?php if ($setores): ?>
            <div class="setores-grid">
                <?php foreach ($setores as $setor): ?>
                    <article class="setor-card">
                        <?php if (!empty($setor['imagem'])): ?>
                            <div class="setor-card-media">
                                <img src="<?= e(upload_url($setor['imagem'])) ?>"
                                     alt="<?= e($setor['title']) ?>"
                                     loading="lazy" decoding="async" width="520" height="340">
                            </div>
                        <?php else: ?>
                            <div class="setor-card-media card-media-placeholder" aria-hidden="true"></div>
                        <?php endif; ?>
                        <div class="setor-card-body">
                            <?php if (!empty($setor['icone'])): ?>
                                <span class="setor-icon" aria-hidden="true"><?= lucide_icon($setor['icone'], 'icon', 32) ?></span>
                            <?php endif; ?>
                            <h2><?= e($setor['titulo_home'] ?: $setor['title']) ?></h2>
                            <?php if (!empty($setor['descricao_curta'])): ?>
                                <p><?= e($setor['descricao_curta']) ?></p>
                            <?php endif; ?>
                            <a class="text-link" href="<?= e(url('setores/' . $setor['slug'])) ?>">
                                <?= e($setor['botao_texto'] ?: 'Ver obras do setor') ?> <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state empty-state-premium">
                <strong>Nenhum setor publicado ainda.</strong>
                <p>Quando os setores forem cadastrados no painel, eles aparecerão aqui com imagem e descrição.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="home-final-cta">
    <div class="container home-final-cta-inner">
        <span class="eyebrow">Portfólio</span>
        <h2>Conheça as obras realizadas em cada setor.</h2>
        <p>O portfólio reúne projetos organizados por segmento para facilitar a avaliação técnica da atuação.</p>
        <div class="hero-actions">
            <a class="button" href="<?= e(url('obras')) ?>">Ver obras</a>
            <a class="button button-outline" href="<?= e(url('contato')) ?>">Fale conosco</a>
        </div>
    </div>
</section>
