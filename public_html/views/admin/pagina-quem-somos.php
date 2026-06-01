<form class="panel form-grid" method="post" enctype="multipart/form-data" action="<?= e(url('admin/paginas/quem-somos')) ?>">
<?= Csrf::field() ?>
<input type="hidden" name="hero_imagem_atual" value="<?= e($campos['hero_imagem'] ?? '') ?>">

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Hero da página</h2>
        <p>Cabeçalho exibido no topo da página Quem Somos.</p>
    </div>
    <label>Título
        <input name="hero_titulo" value="<?= e($campos['hero_titulo'] ?? '') ?>" maxlength="150" placeholder="Quem Somos">
    </label>
    <label class="full">Subtítulo
        <input name="hero_subtitulo" value="<?= e($campos['hero_subtitulo'] ?? '') ?>" maxlength="200">
    </label>
    <label>Imagem de fundo do banner
        <input type="file" name="hero_imagem" accept="image/jpeg,image/png,image/webp" data-preview-input>
        <small class="field-help">Opcional. JPG, PNG ou WebP. Recomendado: 1600×600px horizontal.</small>
    </label>
    <?php if (!empty($campos['hero_imagem'])): ?>
        <img class="image-preview image-preview-wide" data-preview src="<?= e(upload_url($campos['hero_imagem'])) ?>" alt="Banner atual">
    <?php else: ?>
        <img class="image-preview image-preview-wide" data-preview hidden alt="Preview">
    <?php endif; ?>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Seção — A empresa</h2>
        <p>Bloco principal de apresentação institucional.</p>
    </div>
    <label>Headline
        <input name="sobre_titulo" value="<?= e($campos['sobre_titulo'] ?? '') ?>" maxlength="100" placeholder="Execução responsável, do diagnóstico à entrega.">
        <small class="field-help">Título principal à esquerda da seção.</small>
    </label>
    <label class="full">Texto
        <textarea name="sobre_texto" rows="6"><?= e($campos['sobre_texto'] ?? '') ?></textarea>
        <small class="field-help">Dois ou três parágrafos sobre a empresa.</small>
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Missão e Visão</h2>
        <p>Cards exibidos à direita do texto principal.</p>
    </div>
    <label>Título do bloco missão
        <input name="missao_titulo" value="<?= e($campos['missao_titulo'] ?? 'Missão') ?>" maxlength="80">
    </label>
    <label class="full">Texto da missão
        <textarea name="missao_texto" rows="3"><?= e($campos['missao_texto'] ?? '') ?></textarea>
    </label>
    <label>Título do bloco visão
        <input name="visao_titulo" value="<?= e($campos['visao_titulo'] ?? 'Visão') ?>" maxlength="80">
    </label>
    <label class="full">Texto da visão
        <textarea name="visao_texto" rows="3"><?= e($campos['visao_texto'] ?? '') ?></textarea>
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Seção — Valores</h2>
        <p>Headline e subtítulo da seção. Os cards são gerenciados em <a href="<?= e(url('admin/valores')) ?>">Valores</a>.</p>
    </div>
    <label>Headline
        <input name="valores_titulo" value="<?= e($campos['valores_titulo'] ?? '') ?>" maxlength="100" placeholder="O que orienta cada decisão.">
    </label>
    <label class="full">Subtítulo
        <input name="valores_subtitulo" value="<?= e($campos['valores_subtitulo'] ?? '') ?>" maxlength="200" placeholder="Princípios que guiam a postura técnica, a comunicação e a entrega da equipe em todo projeto.">
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Seção — Diferenciais</h2>
        <p>Headline e subtítulo da seção. Os cards são gerenciados em <a href="<?= e(url('admin/diferenciais')) ?>">Diferenciais</a>.</p>
    </div>
    <label>Headline
        <input name="diferenciais_titulo" value="<?= e($campos['diferenciais_titulo'] ?? '') ?>" maxlength="100" placeholder="Por que a Mesquita Realizações.">
    </label>
    <label class="full">Subtítulo
        <input name="diferenciais_subtitulo" value="<?= e($campos['diferenciais_subtitulo'] ?? '') ?>" maxlength="200" placeholder="Aspectos práticos da atuação que fazem diferença em obras que exigem método e controle.">
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>CTA final</h2>
        <p>Chamada para ação no final da página.</p>
    </div>
    <label>Headline
        <input name="cta_titulo" value="<?= e($campos['cta_titulo'] ?? '') ?>" maxlength="100" placeholder="Quer conversar sobre uma demanda técnica?">
    </label>
    <label class="full">Texto
        <input name="cta_texto" value="<?= e($campos['cta_texto'] ?? '') ?>" maxlength="200" placeholder="Compartilhe o contexto do projeto para receber um retorno inicial claro...">
    </label>
</div>

<div class="form-actions"><button class="button" type="submit">Salvar</button></div>
</form>
