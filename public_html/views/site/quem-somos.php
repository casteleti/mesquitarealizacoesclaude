<?php
$heroTitle    = trim((string) ($pagina['hero_titulo'] ?? 'Quem Somos'));
$heroSubtitle = trim((string) ($pagina['hero_subtitulo'] ?? ''));
$sobreTexto   = trim((string) ($pagina['sobre_texto'] ?? ''));
$missaoTitulo = trim((string) ($pagina['missao_titulo'] ?? 'Nossa missão'));
$missaoTexto  = trim((string) ($pagina['missao_texto'] ?? ''));
$visaoTitulo  = trim((string) ($pagina['visao_titulo'] ?? 'Nossa visão'));
$visaoTexto   = trim((string) ($pagina['visao_texto'] ?? ''));
?>

<section class="page-hero">
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
            <h2>Execução responsável, do diagnóstico à entrega.</h2>
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
            <?php if ($missaoTexto): ?>
                <div class="about-pillar">
                    <strong><?= e($missaoTitulo) ?></strong>
                    <p><?= e($missaoTexto) ?></p>
                </div>
            <?php else: ?>
                <div class="about-pillar">
                    <strong>Missão</strong>
                    <p>Entregar obras industriais com organização, segurança e resultado previsível, servindo clientes que precisam de responsabilidade técnica e presença na execução.</p>
                </div>
            <?php endif; ?>

            <?php if ($visaoTexto): ?>
                <div class="about-pillar">
                    <strong><?= e($visaoTitulo) ?></strong>
                    <p><?= e($visaoTexto) ?></p>
                </div>
            <?php else: ?>
                <div class="about-pillar">
                    <strong>Visão</strong>
                    <p>Ser referência em execução técnica para o setor industrial, reconhecida pela capacidade de transformar escopo complexo em obra entregue com previsibilidade.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if ($valores): ?>
<section class="section section-soft values-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Valores</span>
            <h2>O que orienta cada decisão.</h2>
            <p>Princípios que guiam a postura técnica, a comunicação e a entrega da equipe em todo projeto.</p>
        </div>
        <div class="values-grid">
            <?php foreach ($valores as $valor): ?>
                <article class="value-card">
                    <?php if (!empty($valor['icone'])): ?>
                        <span class="value-icon" aria-hidden="true"><?= lucide_icon($valor['icone'], 'icon', 28) ?></span>
                    <?php endif; ?>
                    <h3><?= e($valor['titulo']) ?></h3>
                    <?php if (!empty($valor['resumo'])): ?>
                        <p><?= e($valor['resumo']) ?></p>
                    <?php elseif (!empty($valor['texto'])): ?>
                        <p><?= e(truncate($valor['texto'], 120)) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($valor['topico_1']) || !empty($valor['topico_2']) || !empty($valor['topico_3'])): ?>
                        <ul class="value-topics">
                            <?php foreach (['topico_1','topico_2','topico_3'] as $t): ?>
                                <?php if (!empty($valor[$t])): ?>
                                    <li><?= e($valor[$t]) ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
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
            <h2>Por que a Mesquita Realizações.</h2>
            <p>Aspectos práticos da atuação que fazem diferença em obras que exigem método e controle.</p>
        </div>
        <div class="diferenciais-grid">
            <?php foreach ($diferenciais as $d): ?>
                <article class="diferencial-card">
                    <?php if (!empty($d['icone'])): ?>
                        <span class="diferencial-icon" aria-hidden="true"><?= lucide_icon($d['icone'], 'icon', 28) ?></span>
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
        <h2>Quer conversar sobre uma demanda técnica?</h2>
        <p>Compartilhe o contexto do projeto para receber um retorno inicial claro sobre escopo, caminhos e próximos passos.</p>
        <div class="hero-actions">
            <a class="button" href="<?= e(url('contato')) ?>">Fale com a equipe</a>
            <a class="button button-outline" href="<?= e(url('obras')) ?>">Ver obras realizadas</a>
        </div>
    </div>
</section>
