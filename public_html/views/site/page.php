<?php
$pageKey = (string) ($page['page_key'] ?? '');
$title = trim((string) ($page['title'] ?? ''));
$subtitle = trim((string) ($page['subtitle'] ?? ''));
$content = trim((string) ($page['content'] ?? ''));
$imagePath = $page['image_path'] ?? '';
$imageAlt = $page['image_alt'] ?? $title;
$structured = is_array($page['structured'] ?? null) ? $page['structured'] : [];
$field = static function (string $key, string $fallback = '') use ($structured): string {
    return trim((string) ($structured[$key] ?? $fallback));
};
$items = static function (string $key, array $fallback) use ($structured): array {
    $rows = is_array($structured[$key] ?? null) ? $structured[$key] : [];
    $clean = [];
    foreach ($rows as $row) {
        $itemTitle = trim((string) ($row['title'] ?? ''));
        $itemText = trim((string) ($row['text'] ?? ''));
        if ($itemTitle !== '' || $itemText !== '') {
            $clean[] = ['title' => $itemTitle, 'text' => $itemText];
        }
    }

    return $clean ?: $fallback;
};
?>

<?php if ($pageKey === 'quem-somos'): ?>
    <?php
    $experienceText = $field('experience_text', $content ?: "A Mesquita Realizações atua na implantação, ampliação e modernização de operações industriais.\n\nAo longo de mais de duas décadas, participou de projetos em setores estratégicos como bioenergia, energia, indústria e infraestrutura logística, contribuindo para operações que exigem controle técnico, organização de campo e capacidade de execução.\n\nApós um ciclo de reestruturação e evolução operacional, a empresa inicia uma nova fase, com processos fortalecidos, lideranças atualizadas e uma estrutura técnica preparada para obras de maior complexidade.\n\nMais do que executar obras, buscamos conduzir cada etapa com planejamento, alinhamento operacional e responsabilidade técnica.");
    $differentials = $items('diff', [
        ['title' => 'Capacidade de execução', 'text' => 'Planejamento executivo, acompanhamento técnico e controle operacional aplicados à rotina de obras industriais.'],
        ['title' => 'Organização operacional', 'text' => 'Canteiros estruturados, processos definidos, comunicação objetiva e gestão mais eficiente dos recursos em campo.'],
        ['title' => 'Experiência técnica', 'text' => 'Atuação em plantas industriais, infraestrutura produtiva, utilidades e sistemas de apoio operacional.'],
        ['title' => 'Relacionamento profissional', 'text' => 'Postura transparente, responsabilidade na condução dos projetos e continuidade no atendimento ao cliente.'],
    ]);
    $values = $items('value', [
        ['title' => 'Segurança', 'text' => 'Compromisso com práticas responsáveis, prevenção e proteção das equipes em campo.'],
        ['title' => 'Responsabilidade', 'text' => 'Condução técnica e operacional baseada em clareza, comprometimento e respeito aos processos.'],
        ['title' => 'Organização', 'text' => 'Planejamento, alinhamento operacional e controle como base da execução.'],
        ['title' => 'Sustentabilidade', 'text' => 'Consciência sobre impactos operacionais, uso responsável de recursos e respeito ao ambiente de atuação.'],
    ]);
    ?>
    <?php if (!empty($internalBanner)): ?>
        <?php View::partial('partials/internal-banner', [
            'banner' => $internalBanner,
            'page' => $page,
            'defaultLabel' => $field('hero_label', 'Quem Somos'),
            'defaultTitle' => $title ?: 'Mais de 20 anos em construção industrial',
            'defaultSubtitle' => $subtitle ?: 'Atuação em obras industriais e infraestrutura para empresas que exigem execução organizada, controle técnico e previsibilidade operacional.',
        ]); ?>
    <?php else: ?>
    <section class="about-hero">
        <div class="container about-hero-grid">
            <div class="about-hero-copy">
                <span class="eyebrow"><?= e($field('hero_label', 'Quem Somos')) ?></span>
                <h1><?= e($title ?: 'Mais de 20 anos em construção industrial') ?></h1>
                <p><?= e($subtitle ?: 'Atuação em obras industriais e infraestrutura para empresas que exigem execução organizada, controle técnico e previsibilidade operacional.') ?></p>
            </div>
            <div class="about-hero-visual">
                <?php if ($imagePath): ?>
                    <img class="about-hero-image" src="<?= e(upload_url($imagePath)) ?>" alt="<?= e($imageAlt ?: $title) ?>" width="620" height="680" fetchpriority="high" decoding="async">
                <?php else: ?>
                    <div class="about-metric-card">
                        <strong><?= e($field('metric_number', '20+ anos')) ?></strong>
                        <span><?= e($field('metric_text', 'de atuação em obras industriais')) ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="section about-story">
        <div class="container about-story-grid">
            <div>
                <span class="eyebrow"><?= e($field('experience_label', 'Experiência')) ?></span>
                <h2><?= e($field('experience_title', 'Construção industrial com método, planejamento e responsabilidade')) ?></h2>
            </div>
            <div class="prose">
                <?= nl2br(e($experienceText)) ?>
                <blockquote class="about-quote"><?= e($field('experience_quote', 'Obras industriais exigem mais do que execução. Exigem organização, previsibilidade e responsabilidade em cada etapa.')) ?></blockquote>
            </div>
        </div>
    </section>

    <section class="section section-soft about-authority">
        <div class="container">
            <div class="section-heading">
                <span class="eyebrow"><?= e($field('differentials_label', 'Diferenciais')) ?></span>
                <h2><?= e($field('differentials_title', 'O que sustenta nossa atuação em campo')) ?></h2>
                <p><?= e($field('differentials_intro', 'Estrutura operacional, acompanhamento técnico e organização de execução voltados para obras industriais de médio e grande porte.')) ?></p>
            </div>
            <div class="authority-grid">
                <?php foreach ($differentials as $index => $item): ?>
                    <article class="authority-card">
                        <strong><?= e(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)) ?></strong>
                        <span><?= e($item['title']) ?></span>
                        <p><?= e($item['text']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="section about-commitments">
        <div class="container about-commitments-grid">
            <div>
                <span class="eyebrow"><?= e($field('values_label', 'Valores')) ?></span>
                <h2><?= e($field('values_title', 'Princípios que orientam nossa forma de executar')) ?></h2>
                <p class="about-values-intro"><?= e($field('values_intro', 'Cada obra exige decisões responsáveis, equipes alinhadas e compromisso contínuo com segurança, organização e qualidade operacional.')) ?></p>
            </div>
            <div class="proof-grid">
                <?php foreach ($values as $item): ?>
                    <article class="proof-card">
                        <span><?= e($item['title']) ?></span>
                        <h3><?= e($item['title']) ?></h3>
                        <p><?= e($item['text']) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="home-final-cta about-final-cta">
        <div class="container home-final-cta-inner">
            <span class="eyebrow">Próximo passo</span>
            <h2>Conheça como essa experiência aparece nas obras.</h2>
            <p>Veja projetos realizados ou fale com a equipe para apresentar uma demanda institucional, industrial ou de infraestrutura.</p>
            <div class="hero-actions">
                <a class="button" href="<?= e(url('obras')) ?>">Ver obras</a>
                <a class="button button-outline" href="<?= e(url('contato')) ?>">Fale conosco</a>
            </div>
        </div>
    </section>
<?php elseif ($pageKey === 'como-atuamos'): ?>
    <?php if (!empty($internalBanner)): ?>
        <?php View::partial('partials/internal-banner', [
            'banner' => $internalBanner,
            'page' => $page,
            'defaultLabel' => 'Como Atuamos',
            'defaultTitle' => $title ?: 'Como Atuamos',
            'defaultSubtitle' => $subtitle ?: 'Uma metodologia clara para transformar diagnóstico, planejamento e execução em obras conduzidas com previsibilidade.',
        ]); ?>
    <?php else: ?>
    <section class="method-hero">
        <div class="container method-hero-grid">
            <div class="method-hero-copy">
                <span class="eyebrow">Como Atuamos</span>
                <h1><?= e($title ?: 'Como Atuamos') ?></h1>
                <p><?= e($subtitle ?: 'Uma metodologia clara para transformar diagnóstico, planejamento e execução em obras conduzidas com previsibilidade.') ?></p>
                <div class="hero-actions">
                    <a class="button" href="<?= e(url('contato')) ?>">Fale com a equipe</a>
                    <a class="button button-light" href="<?= e(url('obras')) ?>">Ver obras</a>
                </div>
            </div>
            <div class="method-hero-visual">
                <?php if ($imagePath): ?>
                    <img class="method-hero-image" src="<?= e(upload_url($imagePath)) ?>" alt="<?= e($imageAlt ?: $title) ?>" width="640" height="520" fetchpriority="high" decoding="async">
                <?php else: ?>
                    <div class="method-image-placeholder" aria-hidden="true"><span>03</span></div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="section method-intro">
        <div class="container method-intro-grid">
            <div>
                <span class="eyebrow">Método de trabalho</span>
                <h2>Processo simples de entender, rigoroso na execução.</h2>
            </div>
            <div class="prose">
                <?= $content ? nl2br(e($content)) : '<p>A atuação começa pela leitura do contexto, avança para o planejamento das etapas e se sustenta no acompanhamento próximo da obra. O objetivo é reduzir ruídos, antecipar riscos e manter decisões alinhadas ao avanço real.</p>' ?>
            </div>
        </div>
    </section>

    <section class="section section-soft method-steps-section">
        <div class="container">
            <div class="section-heading">
                <span class="eyebrow">Etapas</span>
                <h2>Da primeira conversa ao acompanhamento da entrega.</h2>
                <p>Uma sequência objetiva para organizar expectativas, responsabilidades e decisões técnicas.</p>
            </div>
            <div class="method-steps-grid">
                <article><span>01</span><h3>Diagnóstico</h3><p>Entendimento do contexto, objetivos, restrições operacionais e pontos críticos antes de avançar.</p></article>
                <article><span>02</span><h3>Planejamento</h3><p>Organização de escopo, etapas, prioridades e recursos para orientar a execução com clareza.</p></article>
                <article><span>03</span><h3>Execução</h3><p>Acompanhamento de campo, comunicação direta e ajustes responsáveis ao longo da obra.</p></article>
            </div>
        </div>
    </section>

    <section class="section method-proof">
        <div class="container method-proof-grid">
            <div>
                <span class="eyebrow">Operação</span>
                <h2>Diferenciais que aparecem no andamento da obra.</h2>
            </div>
            <div class="proof-grid">
                <article class="proof-card"><span>Clareza</span><h3>Comunicação objetiva</h3><p>Informações essenciais organizadas para evitar decisões soltas e ruídos entre as partes.</p></article>
                <article class="proof-card"><span>Controle</span><h3>Leitura contínua</h3><p>Acompanhamento atento ao ritmo da obra, riscos, prioridades e necessidades práticas.</p></article>
                <article class="proof-card"><span>Responsabilidade</span><h3>Entrega bem conduzida</h3><p>Execução orientada por qualidade, segurança, organização e compromisso com o cliente.</p></article>
            </div>
        </div>
    </section>

    <section class="home-final-cta">
        <div class="container home-final-cta-inner">
            <span class="eyebrow">Próximo passo</span>
            <h2>Vamos avaliar o contexto da sua demanda?</h2>
            <p>Apresente o cenário do projeto para uma conversa inicial sobre escopo, prioridades e caminhos técnicos.</p>
            <div class="hero-actions">
                <a class="button" href="<?= e(url('contato')) ?>">Fale com a equipe</a>
                <a class="button button-outline" href="<?= e(url('obras')) ?>">Ver obras realizadas</a>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="page-hero">
        <div class="container">
            <span class="eyebrow">Mesquita Realizações</span>
            <h1><?= e($title) ?></h1>
            <?php if ($subtitle): ?><p><?= e($subtitle) ?></p><?php endif; ?>
        </div>
    </section>
    <section class="section">
        <div class="container split">
            <div class="prose"><?= nl2br(e($content)) ?></div>
            <?php if ($imagePath): ?>
                <img class="media" src="<?= e(upload_url($imagePath)) ?>" alt="<?= e($imageAlt ?: $title) ?>" loading="lazy" decoding="async" width="560" height="420">
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>
