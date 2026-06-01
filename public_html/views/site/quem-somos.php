<?php
$heroTitle          = trim((string) ($pagina['hero_titulo']           ?? 'Quem Somos'));
$heroSubtitle       = trim((string) ($pagina['hero_subtitulo']        ?? ''));
$heroImagem         = trim((string) ($pagina['hero_imagem']           ?? ''));
$heroImagemMobile   = trim((string) ($pagina['hero_imagem_mobile']    ?? ''));
$sobreTitulo        = trim((string) ($pagina['sobre_titulo']          ?? ''));
$sobreTexto         = trim((string) ($pagina['sobre_texto']           ?? ''));
$missaoTitulo       = trim((string) ($pagina['missao_titulo']         ?? 'Missão'));
$missaoTexto        = trim((string) ($pagina['missao_texto']          ?? ''));
$visaoTitulo        = trim((string) ($pagina['visao_titulo']          ?? 'Visão'));
$visaoTexto         = trim((string) ($pagina['visao_texto']           ?? ''));
$valoresTitulo      = trim((string) ($pagina['valores_titulo']        ?? ''));
$valoresSubtitulo   = trim((string) ($pagina['valores_subtitulo']     ?? ''));
$diferenciaisTitulo = trim((string) ($pagina['diferenciais_titulo']   ?? ''));
$diferenciaisSubtit = trim((string) ($pagina['diferenciais_subtitulo']?? ''));
$ctaTitulo          = trim((string) ($pagina['cta_titulo']            ?? ''));
$ctaTexto           = trim((string) ($pagina['cta_texto']             ?? ''));
?>

<section class="page-hero" <?= page_hero_style($heroImagem, $heroImagemMobile) ?>>
    <div class="container page-hero-grid">
        <div class="page-hero-copy">
            <span class="eyebrow">Institucional</span>
            <h1><?= e($heroTitle) ?></h1>
            <?php if ($heroSubtitle): ?>
                <p><?= e($heroSubtitle) ?></p>
            <?php else: ?>
                <p>Organização, método e responsabilidade técnica em projetos industriais que exigem previsibilidade de execução.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section about-section">
    <div class="container about-grid">
        <div class="about-text">
            <span class="eyebrow">A empresa</span>
            <h2><?= e($sobreTitulo ?: 'Execução responsável, do diagnóstico à entrega.') ?></h2>
            <div class="prose">
                <?php if ($sobreTexto): ?>
                    <?= nl2br(e($sobreTexto)) ?>
                <?php else: ?>
                    <p>A Mesquita Realizações atua em obras industriais e de infraestrutura com foco em planejamento técnico, acompanhamento de campo e comunicação direta com o cliente durante toda a execução.</p>
                    <p>Nossa atuação combina leitura técnica do contexto, organização das etapas e presença constante na obra — o que garante tomada de decisão ágil, redução de imprevistos e entrega dentro do que foi acordado.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="about-pillars">
            <div class="about-pillar">
                <strong><?= e($missaoTitulo) ?></strong>
                <?php if ($missaoTexto): ?>
                    <p><?= e($missaoTexto) ?></p>
                <?php else: ?>
                    <p>Entregar obras industriais com organização, segurança e resultado previsível, servindo clientes que precisam de responsabilidade técnica e presença na execução.</p>
                <?php endif; ?>
            </div>
            <div class="about-pillar">
                <strong><?= e($visaoTitulo) ?></strong>
                <?php if ($visaoTexto): ?>
                    <p><?= e($visaoTexto) ?></p>
                <?php else: ?>
                    <p>Ser referência em execução técnica para o setor industrial, reconhecida pela capacidade de transformar escopo complexo em obra entregue com previsibilidade.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php if ($valores): ?>
<section class="section section-soft values-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Valores</span>
            <h2><?= e($valoresTitulo ?: 'O que orienta cada decisão.') ?></h2>
            <?php if ($valoresSubtitulo): ?>
                <p><?= e($valoresSubtitulo) ?></p>
            <?php else: ?>
                <p>Princípios que guiam a postura técnica, a comunicação e a entrega da equipe em todo projeto.</p>
            <?php endif; ?>
        </div>
        <div class="values-grid">
            <?php foreach ($valores as $valor): ?>
                <article class="value-card">
                    <?php $iconeHtml = render_icon($valor['icone_arquivo'] ?? '', $valor['icone'] ?? '', 'icon', 28); ?>
                    <?php if ($iconeHtml): ?>
                        <span class="value-icon" aria-hidden="true"><?= $iconeHtml ?></span>
                    <?php endif; ?>
                    <h3><?= e($valor['titulo']) ?></h3>
                    <?php if (!empty($valor['resumo'])): ?>
                        <p><?= e($valor['resumo']) ?></p>
                    <?php elseif (!empty($valor['texto'])): ?>
                        <p><?= e(truncate($valor['texto'], 100)) ?></p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if ($diferenciais): ?>
<section class="section diferenciais-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Diferenciais</span>
            <h2><?= e($diferenciaisTitulo ?: 'Por que a Mesquita Realizações.') ?></h2>
            <?php if ($diferenciaisSubtit): ?>
                <p><?= e($diferenciaisSubtit) ?></p>
            <?php else: ?>
                <p>Aspectos práticos da atuação que fazem diferença em obras que exigem método e controle.</p>
            <?php endif; ?>
        </div>
        <div class="diferenciais-grid">
            <?php foreach ($diferenciais as $d): ?>
                <article class="diferencial-card">
                    <?php $iconeHtml = render_icon($d['icone_arquivo'] ?? '', $d['icone'] ?? '', 'icon', 28); ?>
                    <?php if ($iconeHtml): ?>
                        <span class="diferencial-icon" aria-hidden="true"><?= $iconeHtml ?></span>
                    <?php endif; ?>
                    <h3><?= e($d['titulo']) ?></h3>
                    <?php if (!empty($d['texto'])): ?>
                        <p><?= e($d['texto']) ?></p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="home-final-cta">
    <div class="container home-final-cta-inner">
        <span class="eyebrow">Contato</span>
        <h2><?= e($ctaTitulo ?: 'Quer conversar sobre uma demanda técnica?') ?></h2>
        <p><?= e($ctaTexto ?: 'Compartilhe o contexto do projeto para receber um retorno inicial claro sobre escopo, caminhos e próximos passos.') ?></p>
        <div class="hero-actions">
            <a class="button" href="<?= e(url('contato')) ?>">Fale com a equipe</a>
            <a class="button button-outline" href="<?= e(url('obras')) ?>">Ver obras realizadas</a>
        </div>
    </div>
</section>
