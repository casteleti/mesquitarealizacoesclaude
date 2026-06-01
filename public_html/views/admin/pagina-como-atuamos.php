<form class="panel form-grid" method="post" enctype="multipart/form-data" action="<?= e(url('admin/paginas/como-atuamos')) ?>">
<?= Csrf::field() ?>
<input type="hidden" name="hero_imagem_atual" value="<?= e($campos['hero_imagem'] ?? '') ?>">

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Hero da página</h2>
        <p>Cabeçalho exibido no topo da página Como Atuamos.</p>
    </div>
    <label>Título
        <input name="hero_titulo" value="<?= e($campos['hero_titulo'] ?? '') ?>" maxlength="150" placeholder="Como Atuamos">
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
        <h2>Texto introdutório</h2>
        <p>Exibido antes da lista de etapas. Opcional.</p>
    </div>
    <label class="full">Texto
        <textarea name="intro_texto" rows="4"><?= e($campos['intro_texto'] ?? '') ?></textarea>
        <small class="field-help">Se preenchido, aparece acima das etapas do processo.</small>
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Seção — Etapas</h2>
        <p>Headline e subtítulo da seção. As etapas individuais são gerenciadas em <a href="<?= e(url('admin/processo')) ?>">Processo</a>.</p>
    </div>
    <label>Headline
        <input name="etapas_titulo" value="<?= e($campos['etapas_titulo'] ?? '') ?>" maxlength="100" placeholder="Como conduzimos cada projeto.">
    </label>
    <label class="full">Subtítulo
        <input name="etapas_subtitulo" value="<?= e($campos['etapas_subtitulo'] ?? '') ?>" maxlength="200" placeholder="Um método estruturado que reduz imprevistos, mantém o cliente informado e garante execução com responsabilidade.">
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Seção — Gestão</h2>
        <p>Headline e subtítulo da seção. Os cards são gerenciados em <a href="<?= e(url('admin/gestao')) ?>">Gestão</a>.</p>
    </div>
    <label>Headline
        <input name="gestao_titulo" value="<?= e($campos['gestao_titulo'] ?? '') ?>" maxlength="100" placeholder="Pilares da nossa gestão de obra.">
    </label>
    <label class="full">Subtítulo
        <input name="gestao_subtitulo" value="<?= e($campos['gestao_subtitulo'] ?? '') ?>" maxlength="200" placeholder="Aspectos práticos que asseguram organização, segurança e qualidade de campo durante toda a execução.">
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>CTA final</h2>
        <p>Chamada para ação no final da página.</p>
    </div>
    <label>Headline
        <input name="cta_titulo" value="<?= e($campos['cta_titulo'] ?? '') ?>" maxlength="100" placeholder="Quer avaliar um projeto com nossa equipe?">
    </label>
    <label class="full">Texto
        <input name="cta_texto" value="<?= e($campos['cta_texto'] ?? '') ?>" maxlength="200" placeholder="Compartilhe sua demanda para uma conversa inicial sobre contexto, escopo e viabilidade técnica.">
    </label>
    <label>Botão principal — texto
        <input name="cta_btn1_texto" value="<?= e($campos['cta_btn1_texto'] ?? '') ?>" maxlength="40" placeholder="Fale com a equipe">
    </label>
    <label>Botão principal — link
        <input name="cta_btn1_link" value="<?= e($campos['cta_btn1_link'] ?? '') ?>" maxlength="200" placeholder="/contato">
    </label>
    <label>Botão secundário — texto
        <input name="cta_btn2_texto" value="<?= e($campos['cta_btn2_texto'] ?? '') ?>" maxlength="40" placeholder="Ver obras realizadas">
    </label>
    <label>Botão secundário — link
        <input name="cta_btn2_link" value="<?= e($campos['cta_btn2_link'] ?? '') ?>" maxlength="200" placeholder="/obras">
    </label>
</div>

<div class="form-actions"><button class="button" type="submit">Salvar</button></div>
</form>
