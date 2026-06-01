<form class="panel form-grid" method="post" enctype="multipart/form-data" action="<?= e(url('admin/paginas/contato')) ?>">
<?= Csrf::field() ?>
<input type="hidden" name="hero_imagem_atual" value="<?= e($campos['hero_imagem'] ?? '') ?>">

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Hero da página</h2>
        <p>Cabeçalho exibido no topo da página de Contato.</p>
    </div>
    <label>Título
        <input name="hero_titulo" value="<?= e($campos['hero_titulo'] ?? '') ?>" maxlength="150" placeholder="Fale Conosco">
    </label>
    <label class="full">Subtítulo
        <input name="hero_subtitulo" value="<?= e($campos['hero_subtitulo'] ?? '') ?>" maxlength="200">
        <small class="field-help">Breve orientação sobre como usar o formulário ou os canais diretos.</small>
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
        <h2>Seção de canais</h2>
        <p>Título e introdução exibidos ao lado do formulário, acima dos canais de contato.</p>
    </div>
    <label>Eyebrow (texto vermelho acima do título)
        <input name="secao_eyebrow" value="<?= e($campos['secao_eyebrow'] ?? '') ?>" maxlength="60" placeholder="Canais diretos">
        <small class="field-help">Opcional. Se vazio, exibe "Canais diretos".</small>
    </label>
    <label class="full">Título da seção
        <input name="secao_titulo" value="<?= e($campos['secao_titulo'] ?? '') ?>" maxlength="100" placeholder="Fale com a Mesquita Realizações.">
        <small class="field-help">Opcional. Se vazio, o site exibe o texto padrão.</small>
    </label>
    <label class="full">Parágrafo de introdução
        <textarea name="sobre_texto" rows="4"><?= e($campos['sobre_texto'] ?? '') ?></textarea>
        <small class="field-help">Opcional. Se vazio, o site exibe o texto padrão.</small>
    </label>
</div>

<p class="form-hint">Os canais de contato (telefone, WhatsApp, e-mail, endereço) são gerenciados em <a href="<?= e(url('admin/configuracoes')) ?>">Configurações</a>.</p>

<div class="form-actions"><button class="button" type="submit">Salvar</button></div>
</form>
