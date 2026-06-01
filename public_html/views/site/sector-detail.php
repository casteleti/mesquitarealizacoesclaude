<?php
$descricao  = trim((string) ($setor['descricao'] ?? ''));
$descCurta  = trim((string) ($setor['descricao_curta'] ?? ''));
$titulo     = trim((string) ($setor['titulo_pagina'] ?: $setor['title'] ?? ''));
?>

<section class="page-hero">
    <div class="container page-hero-grid">
        <div class="page-hero-copy">
            <nav class="breadcrumb" aria-label="Você está em">
                <a href="<?= e(url('')) ?>">Início</a>
                <span>/</span>
                <a href="<?= e(url('setores')) ?>">Setores</a>
                <span>/</span>
                <span aria-current="page"><?= e($setor['title']) ?></span>
            </nav>
            <span class="eyebrow">Setor</span>
            <h1><?= e($titulo) ?></h1>
            <?php if ($descCurta): ?>
                <p><?= e($descCurta) ?></p>
            <?php else: ?>
                <p>Uma área de atuação estruturada para demandas que exigem leitura técnica, organização e execução responsável.</p>
            <?php endif; ?>
        </div>

        <?php if (!empty($setor['imagem'])): ?>
        <div class="page-hero-media">
            <img src="<?= e(upload_url($setor['imagem'])) ?>"
                 alt="<?= e($setor['title']) ?>"
                 width="640" height="500"
                 fetchpriority="high" decoding="async">
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <div class="container sector-content-grid">
        <div>
            <span class="eyebrow">Contexto</span>
            <h2>Como atuamos neste setor</h2>
            <div class="prose">
                <?php if ($descricao): ?>
                    <?= $descricao ?>
                <?php else: ?>
                    <p>Este conteúdo pode ser detalhado pelo painel administrativo para explicar desafios, diferenciais, tipos de obra e formas de atuação da Mesquita neste segmento.</p>
                <?php endif; ?>
            </div>
        </div>
        <aside class="sector-side-panel">
            <span>Atuação</span>
            <strong><?= e($setor['title']) ?></strong>
            <a class="text-link" href="<?= e(url('contato')) ?>">Conversar sobre uma demanda</a>
        </aside>
    </div>
</section>

<section class="section section-soft related-works-section">
    <div class="container">
        <div class="section-heading section-heading-row">
            <div>
                <span class="eyebrow">Portfólio relacionado</span>
                <h2>Obras neste setor</h2>
                <p>Projetos conectados a esta área de atuação demonstram experiência prática e capacidade de entrega.</p>
            </div>
            <a class="text-link section-heading-link" href="<?= e(url('obras')) ?>">Ver todas as obras</a>
        </div>

        <?php if ($obras): ?>
            <div class="card-grid home-card-grid">
                <?php foreach ($obras as $obra): ?>
                <article class="work-feature-card">
                    <a href="<?= e(url('obras/' . $obra['slug'])) ?>" aria-label="Ver obra <?= e($obra['title']) ?>">
                        <?php if (!empty($obra['imagem_principal'])): ?>
                            <img src="<?= e(upload_url($obra['imagem_principal'])) ?>" alt="<?= e($obra['title']) ?>" loading="lazy" decoding="async" width="680" height="460">
                        <?php else: ?>
                            <span class="work-card-placeholder" aria-hidden="true"><?= e(mb_substr((string) $obra['title'], 0, 1, 'UTF-8')) ?></span>
                        <?php endif; ?>
                        <div>
                            <h3><?= e($obra['title']) ?></h3>
                            <?php if (!empty($obra['subtitulo'])): ?>
                                <p><?= e(truncate($obra['subtitulo'], 100)) ?></p>
                            <?php endif; ?>
                            <span class="text-link">Ver obra</span>
                        </div>
                    </a>
                </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state empty-state-premium">
                <strong>Nenhuma obra vinculada a este setor ainda.</strong>
                <p>Quando uma obra for associada a este segmento no painel, ela aparecerá aqui automaticamente.</p>
                <a class="text-link" href="<?= e(url('obras')) ?>">Acessar portfólio completo</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="home-final-cta">
    <div class="container home-final-cta-inner">
        <span class="eyebrow">Próximo passo</span>
        <h2>Precisa avaliar uma demanda neste setor?</h2>
        <p>Entre em contato para compartilhar contexto, objetivo e prazo. A equipe retorna com uma orientação inicial clara.</p>
        <div class="hero-actions">
            <a class="button" href="<?= e(url('contato')) ?>">Fale com a equipe</a>
            <a class="button button-outline" href="<?= e(url('setores')) ?>">Ver outros setores</a>
        </div>
    </div>
</section>
