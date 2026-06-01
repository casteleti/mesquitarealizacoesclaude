<?php
$heroBanner   = $banners[0] ?? null;
$heroTitle    = trim((string) ($heroBanner['headline']    ?? $pagina['hero_titulo']    ?? config('name')));
$heroSubtitle = trim((string) ($heroBanner['subheadline'] ?? $pagina['hero_subtitulo'] ?? ''));
$heroImage    = $heroBanner['imagem'] ?? '';
$primaryText  = $heroBanner['botao_primario_texto']  ?? 'Conheça as obras';
$primaryHref  = $heroBanner['botao_primario_link']   ?? url('obras');
$secondText   = $heroBanner['botao_secundario_texto'] ?? '';
$secondHref   = $heroBanner['botao_secundario_link']  ?? '';
$introTitulo  = trim((string) ($pagina['intro_titulo'] ?? ''));
$introTexto   = trim((string) ($pagina['intro_texto'] ?? ''));
?>

<section class="home-hero">
    <div class="container home-hero-grid">
        <div class="home-hero-copy">
            <span class="eyebrow">Construção industrial e infraestrutura</span>
            <h1><?= e($heroTitle) ?></h1>
            <?php if ($heroSubtitle): ?>
                <p><?= e($heroSubtitle) ?></p>
            <?php else: ?>
                <p>Planejamento, execução e acompanhamento técnico para obras industriais que exigem previsibilidade e confiança.</p>
            <?php endif; ?>
            <div class="hero-actions">
                <a class="button" href="<?= e($primaryHref) ?>"><?= e($primaryText) ?></a>
                <?php if ($secondText && $secondHref): ?>
                    <a class="button button-light" href="<?= e($secondHref) ?>"><?= e($secondText) ?></a>
                <?php else: ?>
                    <a class="button button-light" href="<?= e(url('contato')) ?>">Fale conosco</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="home-hero-visual">
            <?php if ($heroImage): ?>
                <img class="home-hero-image" src="<?= e(upload_url($heroImage)) ?>" alt="<?= e($heroTitle) ?>" width="680" height="520" fetchpriority="high" decoding="async">
            <?php else: ?>
                <div class="home-hero-placeholder" aria-hidden="true">
                    <span>MR</span>
                </div>
            <?php endif; ?>
        </div>
    </div>
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
            <span class="eyebrow">Por que confiar</span>
            <h2>Uma atuação orientada por clareza, presença e previsibilidade.</h2>
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

<?php if ($processo): ?>
<section class="section home-process">
    <div class="container home-process-grid">
        <div>
            <span class="eyebrow">Como atuamos</span>
            <h2>Método simples de entender, forte na execução.</h2>
            <p>Da análise inicial ao acompanhamento da obra, o processo prioriza previsibilidade, controle e comunicação direta.</p>
            <a class="button" href="<?= e(url('como-atuamos')) ?>">Conheça o processo</a>
        </div>
        <div class="process-steps">
            <?php foreach ($processo as $etapa): ?>
            <article>
                <span><?= e($etapa['numero']) ?></span>
                <h3><?= e($etapa['titulo']) ?></h3>
                <?php if (!empty($etapa['descricao'])): ?>
                    <p><?= e(truncate($etapa['descricao'], 100)) ?></p>
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
