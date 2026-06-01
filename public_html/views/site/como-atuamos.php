<?php
$heroTitle    = trim((string) ($pagina['hero_titulo'] ?? 'Como Atuamos'));
$heroSubtitle = trim((string) ($pagina['hero_subtitulo'] ?? ''));
$introTexto   = trim((string) ($pagina['intro_texto'] ?? ''));
$heroImagem   = trim((string) ($pagina['hero_imagem'] ?? ''));
?>

<section class="page-hero" <?= page_hero_style($heroImagem) ?>>
    <div class="container page-hero-grid">
        <div class="page-hero-copy">
            <span class="eyebrow">Processo</span>
            <h1><?= e($heroTitle) ?></h1>
            <?php if ($heroSubtitle): ?>
                <p><?= e($heroSubtitle) ?></p>
            <?php else: ?>
                <p>Do diagnóstico inicial à entrega final — um processo claro, com comunicação direta e acompanhamento próximo em cada etapa da obra.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if ($introTexto): ?>
<section class="section section-soft">
    <div class="container prose" style="max-width:720px">
        <?= nl2br(e($introTexto)) ?>
    </div>
</section>
<?php endif; ?>

<?php if ($processo): ?>
<section class="section process-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Etapas</span>
            <h2>Como conduzimos cada projeto.</h2>
            <p>Um método estruturado que reduz imprevistos, mantém o cliente informado e garante execução com responsabilidade.</p>
        </div>
        <ol class="process-timeline">
            <?php foreach ($processo as $etapa): ?>
                <li class="process-step">
                    <span class="process-step-num"><?= e($etapa['numero']) ?></span>
                    <div class="process-step-body">
                        <h3><?= e($etapa['titulo']) ?></h3>
                        <?php if (!empty($etapa['descricao'])): ?>
                            <p><?= e($etapa['descricao']) ?></p>
                        <?php endif; ?>

                        <?php
                        $topicos = array_filter([
                            $etapa['topico_1'] ?? '',
                            $etapa['topico_2'] ?? '',
                            $etapa['topico_3'] ?? '',
                        ]);
                        ?>
                        <?php if ($topicos): ?>
                            <?php if (!empty($etapa['bloco_titulo'])): ?>
                                <strong class="process-bloco-titulo"><?= e($etapa['bloco_titulo']) ?></strong>
                            <?php endif; ?>
                            <ul class="process-topicos">
                                <?php foreach ($topicos as $tp): ?>
                                    <li><?= e($tp) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (!empty($etapa['resultado_titulo']) || !empty($etapa['resultado_texto'])): ?>
                            <div class="process-resultado">
                                <?php if (!empty($etapa['resultado_titulo'])): ?>
                                    <strong><?= e($etapa['resultado_titulo']) ?></strong>
                                <?php endif; ?>
                                <?php if (!empty($etapa['resultado_texto'])): ?>
                                    <p><?= e($etapa['resultado_texto']) ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>
<?php endif; ?>

<?php if ($gestao): ?>
<section class="section section-soft gestao-section">
    <div class="container">
        <div class="section-heading">
            <span class="eyebrow">Gestão</span>
            <h2>Pilares da nossa gestão de obra.</h2>
            <p>Aspectos práticos que asseguram organização, segurança e qualidade de campo durante toda a execução.</p>
        </div>
        <div class="gestao-grid">
            <?php foreach ($gestao as $card): ?>
                <article class="gestao-card">
                    <?php if (!empty($card['icone'])): ?>
                        <span class="gestao-icon" aria-hidden="true"><?= lucide_icon($card['icone'], 'icon', 28) ?></span>
                    <?php endif; ?>
                    <h3><?= e($card['titulo']) ?></h3>
                    <?php if (!empty($card['texto'])): ?>
                        <p><?= e($card['texto']) ?></p>
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
        <h2>Quer avaliar um projeto com nossa equipe?</h2>
        <p>Compartilhe sua demanda para uma conversa inicial sobre contexto, escopo e viabilidade técnica.</p>
        <div class="hero-actions">
            <a class="button" href="<?= e(url('contato')) ?>">Fale com a equipe</a>
            <a class="button button-outline" href="<?= e(url('obras')) ?>">Ver obras realizadas</a>
        </div>
    </div>
</section>
