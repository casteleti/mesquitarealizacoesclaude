<?php
$introTitulo  = trim((string) ($pagina['intro_titulo'] ?? ''));
$introTexto   = trim((string) ($pagina['intro_texto'] ?? ''));
$slides       = !empty($banners) ? $banners : [];
?>

<section class="home-slider" data-slider aria-label="Destaques">
    <div class="home-slides">
        <?php if ($slides): ?>
            <?php foreach ($slides as $i => $b): ?>
                <?php
                    $bImg   = $b['imagem'] ?? '';
                    $bTitle = trim((string) ($b['headline'] ?? '')) ?: config('name');
                    $bSub   = trim((string) ($b['subheadline'] ?? ''));
                    $b1t    = trim((string) ($b['botao_primario_texto'] ?? ''));
                    $b1h    = trim((string) ($b['botao_primario_link'] ?? ''));
                    $b2t    = trim((string) ($b['botao_secundario_texto'] ?? ''));
                    $b2h    = trim((string) ($b['botao_secundario_link'] ?? ''));
                ?>
                <div class="home-slide<?= $i === 0 ? ' is-active' : '' ?>" data-slide<?= $bImg ? ' style="--slide-bg:url(\'' . e(upload_url($bImg)) . '\')"' : '' ?>>
                    <div class="home-slide-overlay" aria-hidden="true"></div>
                    <div class="container">
                        <div class="home-slide-inner">
                            <span class="eyebrow" data-anim>Construção industrial e infraestrutura</span>
                            <h1 data-anim><?= e($bTitle) ?></h1>
                            <?php if ($bSub): ?><p data-anim><?= e($bSub) ?></p><?php endif; ?>
                            <div class="home-slide-actions" data-anim>
                                <?php if ($b1t): ?><a class="button" href="<?= e($b1h ?: url('obras')) ?>"><?= e($b1t) ?></a><?php endif; ?>
                                <?php if ($b2t): ?><a class="button button-light" href="<?= e($b2h ?: url('contato')) ?>"><?= e($b2t) ?></a><?php endif; ?>
                                <?php if (!$b1t && !$b2t): ?>
                                    <a class="button" href="<?= e(url('obras')) ?>">Conheça as obras</a>
                                    <a class="button button-light" href="<?= e(url('contato')) ?>">Fale conosco</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="home-slide is-active" data-slide>
                <div class="home-slide-overlay" aria-hidden="true"></div>
                <div class="container">
                    <div class="home-slide-inner">
                        <span class="eyebrow" data-anim>Construção industrial e infraestrutura</span>
                        <h1 data-anim><?= e(config('name')) ?></h1>
                        <p data-anim>Planejamento, execução e acompanhamento técnico para obras industriais que exigem previsibilidade e confiança.</p>
                        <div class="home-slide-actions" data-anim>
                            <a class="button" href="<?= e(url('obras')) ?>">Conheça as obras</a>
                            <a class="button button-light" href="<?= e(url('contato')) ?>">Fale conosco</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (count($slides) > 1): ?>
        <button class="home-slider-arrow home-slider-prev" type="button" data-slider-prev aria-label="Slide anterior"><span aria-hidden="true">&lsaquo;</span></button>
        <button class="home-slider-arrow home-slider-next" type="button" data-slider-next aria-label="Próximo slide"><span aria-hidden="true">&rsaquo;</span></button>
        <div class="home-slider-dots" data-slider-dots>
            <?php foreach ($slides as $i => $b): ?>
                <button type="button" class="home-slider-dot<?= $i === 0 ? ' is-active' : '' ?>" data-slider-dot data-index="<?= $i ?>" aria-label="Ir para o slide <?= $i + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<section class="home-intro section">
    <div class="container home-intro-grid">
        <div>
            <span class="eyebrow">Institucional</span>
            <h2><?= e($introTitulo ?: 'Controle técnico para obras industriais.') ?></h2>
        </div>
        <div class="prose">
            <?php if ($introTexto): ?>
                <?= nl2br(e($introTexto)) ?>
            <?php else: ?>
                <p>A Mesquita Realizações atua em projetos que pedem organização, leitura técnica e execução responsável do início ao fim.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section section-soft home-section">
    <div class="container">
        <div class="section-heading section-heading-row">
            <div>
                <span class="eyebrow">Atuação</span>
                <h2>Setores em destaque</h2>
                <p>Áreas em que a empresa concentra experiência, método e capacidade de execução.</p>
            </div>
            <a class="text-link section-heading-link" href="<?= e(url('setores')) ?>">Ver todos os setores</a>
        </div>

        <?php if ($setores): ?>
            <div class="card-grid home-card-grid">
                <?php foreach ($setores as $setor): ?>
                    <?php View::partial('partials/sector-card', ['setor' => $setor]); ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <strong>Setores ainda não cadastrados.</strong>
                <p>Quando os setores forem publicados no painel, eles aparecerão aqui automaticamente.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="section home-section">
    <div class="container">
        <div class="section-heading section-heading-row">
            <div>
                <span class="eyebrow">Portfólio</span>
                <h2>Obras em destaque</h2>
                <p>Projetos selecionados para demonstrar capacidade técnica, organização e responsabilidade na entrega.</p>
            </div>
            <a class="text-link section-heading-link" href="<?= e(url('obras')) ?>">Acessar portfólio</a>
        </div>

        <?php if ($destaques): ?>
            <div class="card-grid home-card-grid">
                <?php foreach ($destaques as $obra): ?>
                    <?php View::partial('partials/work-card', ['obra' => $obra]); ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <strong>Nenhuma obra em destaque publicada.</strong>
                <p>Marque obras como destaque no painel para compor esta seção.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php if ($diferenciais): ?>
<section class="section section-soft home-proof">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow"><?= e($pagina['confiar_eyebrow'] ?? '') ?: 'Por que confiar' ?></span>
            <h2><?= e($pagina['confiar_titulo'] ?? '') ?: 'Uma atuação orientada por clareza, presença e previsibilidade.' ?></h2>
        </div>
        <div class="proof-grid">
            <?php foreach ($diferenciais as $i => $dif): ?>
            <article class="proof-card">
                <?php if (!empty($dif['icone'])): ?>
                    <span class="proof-icon"><?= lucide_icon($dif['icone'], 'icon', 28) ?></span>
                <?php else: ?>
                    <span><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
                <?php endif; ?>
                <h3><?= e($dif['titulo']) ?></h3>
                <?php if (!empty($dif['texto'])): ?>
                    <p><?= e($dif['texto']) ?></p>
                <?php endif; ?>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if ($gestao): ?>
<section class="section home-process home-process--photo">
    <div class="container home-process-grid">
        <div>
            <span class="eyebrow">Como atuamos</span>
            <h2>Método simples de entender, forte na execução.</h2>
            <p>Da análise inicial ao acompanhamento da obra, o processo prioriza previsibilidade, controle e comunicação direta.</p>
            <a class="button" href="<?= e(url('como-atuamos')) ?>">Conheça o processo</a>
        </div>
        <div class="process-steps">
            <?php foreach ($gestao as $card): ?>
            <article>
                <?php $iconeHtml = render_icon($card['icone_arquivo'] ?? '', $card['icone'] ?? '', 'icon', 24); ?>
                <?php if ($iconeHtml): ?>
                    <span class="process-step-icon" aria-hidden="true"><?= $iconeHtml ?></span>
                <?php endif; ?>
                <h3><?= e($card['titulo']) ?></h3>
                <?php if (!empty($card['texto'])): ?>
                    <p><?= e(truncate($card['texto'], 100)) ?></p>
                <?php endif; ?>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="home-final-cta">
    <div class="container home-final-cta-inner">
        <span class="eyebrow">Próximo passo</span>
        <h2>Vamos conversar sobre o seu projeto?</h2>
        <p>Apresente sua demanda e receba um retorno inicial para avaliar caminhos, escopo e próximos passos com clareza.</p>
        <div class="hero-actions">
            <a class="button" href="<?= e(url('contato')) ?>">Fale com a equipe</a>
            <a class="button button-outline" href="<?= e(url('obras')) ?>">Ver obras realizadas</a>
        </div>
    </div>
</section>
