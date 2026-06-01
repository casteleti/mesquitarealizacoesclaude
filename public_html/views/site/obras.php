<?php
$title    = trim((string) ($pagina['hero_titulo'] ?? 'Obras'));
$subtitle = trim((string) ($pagina['hero_subtitulo'] ?? ''));
$obraList = $obras['data'] ?? [];
$total    = $obras['total'] ?? 0;
$lastPage = $obras['last_page'] ?? 1;
$curPage  = $obras['current_page'] ?? 1;
$setores  = $setores ?? [];
$setorAtivo = $setorAtivo ?? null;
?>

<section class="page-hero">
    <div class="container page-hero-grid">
        <div class="page-hero-copy">
            <span class="eyebrow">Portfólio técnico</span>
            <h1><?= e($title ?: 'Obras') ?></h1>
            <?php if ($subtitle): ?>
                <p><?= e($subtitle) ?></p>
            <?php else: ?>
                <p>Projetos realizados que demonstram organização, capacidade técnica e compromisso com entregas sólidas.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id="obras-lista" class="section section-soft">
    <div class="container">
        <div class="section-heading section-heading-row">
            <div>
                <span class="eyebrow">Projetos</span>
                <h2>Obras realizadas</h2>
                <p>Uma vitrine objetiva de projetos, com setor relacionado e caminho direto para o detalhe técnico.</p>
            </div>
            <a class="text-link section-heading-link" href="<?= e(url('setores')) ?>">Ver setores</a>
        </div>

        <?php if ($setores): ?>
        <div class="works-filter">
            <div class="works-filter-controls">
                <form method="get" action="<?= e(url('obras')) ?>">
                    <label class="works-sector-select">
                        <span class="sr-only">Filtrar por setor</span>
                        <select name="setor" onchange="this.form.submit()" aria-label="Filtrar por setor">
                            <option value="">Todos os setores</option>
                            <?php foreach ($setores as $s): ?>
                                <option value="<?= e($s['slug']) ?>" <?= ($setor ?? '') === $s['slug'] ? 'selected' : '' ?>><?= e($s['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </form>
            </div>
            <div class="works-filter-status">Exibindo <strong><?= e((string) $total) ?></strong> <?= $total === 1 ? 'obra' : 'obras' ?></div>
        </div>
        <?php endif; ?>

        <?php if ($obraList): ?>
            <div class="work-list-grid">
                <?php foreach ($obraList as $obra): ?>
                    <article class="work-feature-card<?= !empty($obra['destaque']) ? ' is-featured' : '' ?>">
                        <a href="<?= e(url('obras/' . $obra['slug'])) ?>" aria-label="Ver obra <?= e($obra['title']) ?>">
                            <?php if (!empty($obra['imagem_principal'])): ?>
                                <img src="<?= e(upload_url($obra['imagem_principal'])) ?>" alt="<?= e($obra['title']) ?>" loading="lazy" decoding="async" width="680" height="460">
                            <?php else: ?>
                                <span class="work-card-placeholder" aria-hidden="true"><?= e(mb_substr((string) $obra['title'], 0, 1, 'UTF-8')) ?></span>
                            <?php endif; ?>
                            <span class="work-card-sector"><?= e($obra['setor_nome'] ?? 'Obra') ?></span>
                            <?php if (!empty($obra['destaque'])): ?>
                                <span class="work-card-featured">Destaque</span>
                            <?php endif; ?>
                            <div>
                                <h3><?= e($obra['title']) ?></h3>
                                <?php if (!empty($obra['subtitulo'])): ?>
                                    <p><?= e($obra['subtitulo']) ?></p>
                                <?php else: ?>
                                    <p>Conheça o contexto, setor relacionado e principais informações desta obra.</p>
                                <?php endif; ?>
                                <?php if (!empty($obra['local'])): ?>
                                    <small><?= e($obra['local']) ?></small>
                                <?php endif; ?>
                                <span class="text-link">Ver obra</span>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if ($lastPage > 1): ?>
            <nav class="pagination" aria-label="Paginação">
                <?php for ($p = 1; $p <= $lastPage; $p++): ?>
                    <?php $href = url('obras') . '?' . http_build_query(array_filter(['page' => $p, 'setor' => $setor ?? ''])); ?>
                    <a href="<?= e($href) ?>" class="pagination-item<?= $p === $curPage ? ' is-active' : '' ?>" aria-current="<?= $p === $curPage ? 'page' : 'false' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </nav>
            <?php endif; ?>
        <?php else: ?>
            <div class="empty-state empty-state-premium">
                <strong>Nenhuma obra publicada ainda.</strong>
                <p>Quando as obras forem cadastradas no painel, o portfólio será exibido aqui com setor, imagem e acesso ao detalhe.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="home-final-cta">
    <div class="container home-final-cta-inner">
        <span class="eyebrow">Contato</span>
        <h2>Quer conversar sobre uma obra ou demanda técnica?</h2>
        <p>Compartilhe o contexto do projeto para receber um retorno inicial claro sobre escopo, caminhos e próximos passos.</p>
        <div class="hero-actions">
            <a class="button" href="<?= e(url('contato')) ?>">Fale com a equipe</a>
            <a class="button button-outline" href="<?= e(url('setores')) ?>">Ver setores atendidos</a>
        </div>
    </div>
</section>
