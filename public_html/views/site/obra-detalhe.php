<?php
$descricao  = trim((string) ($obra['descricao'] ?? ''));
$subtitulo  = trim((string) ($obra['subtitulo'] ?? ''));
$escopo     = trim((string) ($obra['escopo'] ?? ''));
$cliente    = trim((string) ($obra['cliente'] ?? ''));
$localizacao = trim((string) ($obra['localizacao'] ?? ''));
$dataInicio = trim((string) ($obra['data_inicio'] ?? ''));
$dataConclusao = trim((string) ($obra['data_conclusao'] ?? ''));
$status     = (int) ($obra['status'] ?? 1);
$statusLabel = $status === 2 ? 'Em andamento' : 'Concluída';
$setor      = trim((string) ($obra['setor_id'] ? ($obra['setor_nome'] ?? '') : ''));
?>

<section class="work-detail-hero">
    <div class="container work-detail-hero-grid">
        <div class="work-detail-copy">
            <nav class="breadcrumb work-breadcrumb" aria-label="Você está em">
                <a href="<?= e(url('')) ?>">Início</a>
                <span>/</span>
                <a href="<?= e(url('obras')) ?>">Obras</a>
                <span>/</span>
                <span aria-current="page"><?= e($obra['title']) ?></span>
            </nav>
            <?php if ($setor): ?>
                <span class="eyebrow"><?= e($setor) ?></span>
            <?php else: ?>
                <span class="eyebrow">Obra</span>
            <?php endif; ?>
            <h1><?= e($obra['title']) ?></h1>
            <?php if ($subtitulo): ?>
                <p><?= e($subtitulo) ?></p>
            <?php elseif ($descricao): ?>
                <p><?= e(truncate($descricao, 160)) ?></p>
            <?php else: ?>
                <p>Projeto apresentado com foco em contexto, setor atendido e informações essenciais para avaliação técnica.</p>
            <?php endif; ?>

            <div class="work-meta-list" aria-label="Informações da obra">
                <span class="work-meta-status work-meta-status-<?= $status === 2 ? 'progress' : 'done' ?>"><?= e($statusLabel) ?></span>
                <?php if ($setor): ?><span><?= e($setor) ?></span><?php endif; ?>
                <?php if ($localizacao): ?><span><?= e($localizacao) ?></span><?php endif; ?>
                <?php if ($cliente): ?><span>Cliente: <?= e($cliente) ?></span><?php endif; ?>
                <?php if ($dataInicio || $dataConclusao): ?>
                    <span>
                        <?= $dataInicio ? e($dataInicio) : '' ?>
                        <?= ($dataInicio && $dataConclusao) ? ' – ' : '' ?>
                        <?= $dataConclusao ? e($dataConclusao) : '' ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="work-detail-visual">
            <?php if (!empty($obra['imagem_principal'])): ?>
                <img class="work-detail-image"
                     src="<?= e(upload_url($obra['imagem_principal'])) ?>"
                     alt="<?= e($obra['title']) ?>"
                     width="680" height="500"
                     fetchpriority="high" decoding="async">
            <?php else: ?>
                <div class="work-detail-placeholder" aria-hidden="true">
                    <span><?= e(mb_substr((string) $obra['title'], 0, 1, 'UTF-8')) ?></span>
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
                <?php if ($descricao): ?>
                    <?= $descricao ?>
                <?php else: ?>
                    <p>Este conteúdo pode ser detalhado pelo painel administrativo para explicar escopo, desafios, atuação técnica e resultados desta obra.</p>
                <?php endif; ?>
            </div>

            <?php if ($escopo): ?>
                <div class="work-escopo">
                    <h3>Escopo executado</h3>
                    <div class="prose"><?= nl2br(e($escopo)) ?></div>
                </div>
            <?php endif; ?>
        </div>

        <aside class="work-side-panel">
            <span>Ficha técnica</span>
            <?php if ($setor): ?><strong><?= e($setor) ?></strong><?php endif; ?>
            <?php if ($cliente): ?><p><b>Cliente:</b> <?= e($cliente) ?></p><?php endif; ?>
            <?php if ($localizacao): ?><p><b>Localização:</b> <?= e($localizacao) ?></p><?php endif; ?>
            <?php if ($dataInicio): ?><p><b>Início:</b> <?= e($dataInicio) ?></p><?php endif; ?>
            <?php if ($dataConclusao): ?><p><b>Conclusão:</b> <?= e($dataConclusao) ?></p><?php endif; ?>
            <p><b>Status:</b> <?= e($statusLabel) ?></p>
            <a class="text-link" href="<?= e(url('contato')) ?>">Conversar sobre projeto semelhante</a>
        </aside>
    </div>
</section>

<?php if ($imagens): ?>
<section class="section section-soft work-gallery-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Galeria</span>
            <h2>Registros da obra</h2>
            <p>Imagens complementares que demonstram escala, acabamento e contexto do projeto.</p>
        </div>
        <div class="work-gallery-grid">
            <?php foreach ($imagens as $img): ?>
                <figure class="work-gallery-item">
                    <img src="<?= e(upload_url($img['caminho'])) ?>"
                         alt="<?= e($img['alt'] ?: $obra['title']) ?>"
                         loading="lazy" decoding="async" width="460" height="320">
                    <?php if (!empty($img['legenda'])): ?>
                        <figcaption><?= e($img['legenda']) ?></figcaption>
                    <?php endif; ?>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if ($relacionadas): ?>
<section class="section<?= $imagens ? ' section-soft' : '' ?> related-works-section">
    <div class="container">
        <div class="section-heading section-heading-row">
            <div>
                <span class="eyebrow">Mesmo setor</span>
                <h2>Outras obras relacionadas</h2>
                <p>Projetos do mesmo segmento reforçam repertório técnico e ajudam a comparar contextos de atuação.</p>
            </div>
            <a class="text-link section-heading-link" href="<?= e(url('obras')) ?>">Ver portfólio completo</a>
        </div>
        <div class="card-grid home-card-grid">
            <?php foreach ($relacionadas as $rel): ?>
                <article class="work-feature-card">
                    <a href="<?= e(url('obras/' . $rel['slug'])) ?>" aria-label="Ver obra <?= e($rel['title']) ?>">
                        <?php if (!empty($rel['imagem_principal'])): ?>
                            <img src="<?= e(upload_url($rel['imagem_principal'])) ?>" alt="<?= e($rel['title']) ?>" loading="lazy" decoding="async" width="680" height="460">
                        <?php else: ?>
                            <span class="work-card-placeholder" aria-hidden="true"><?= e(mb_substr((string) $rel['title'], 0, 1, 'UTF-8')) ?></span>
                        <?php endif; ?>
                        <div>
                            <h3><?= e($rel['title']) ?></h3>
                            <?php if (!empty($rel['subtitulo'])): ?>
                                <p><?= e(truncate($rel['subtitulo'], 100)) ?></p>
                            <?php endif; ?>
                            <span class="text-link">Ver obra</span>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="home-final-cta">
    <div class="container home-final-cta-inner">
        <span class="eyebrow">Próximo passo</span>
        <h2>Tem uma demanda com perfil semelhante?</h2>
        <p>Fale com a equipe para apresentar o contexto, alinhar expectativas e entender o melhor caminho técnico.</p>
        <div class="hero-actions">
            <a class="button" href="<?= e(url('contato')) ?>">Solicitar contato</a>
            <a class="button button-outline" href="<?= e(url('obras')) ?>">Ver outras obras</a>
        </div>
    </div>
</section>
