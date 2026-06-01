<form class="panel form-grid" method="post" enctype="multipart/form-data" action="<?= e(url('admin/paginas/setores')) ?>">
<?= Csrf::field() ?>
<input type="hidden" name="hero_imagem_atual" value="<?= e($campos['hero_imagem'] ?? '') ?>">

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Hero da página</h2>
        <p>Cabeçalho exibido no topo da página Setores.</p>
    </div>
    <label>Título
        <input name="hero_titulo" value="<?= e($campos['hero_titulo'] ?? '') ?>" maxlength="150" placeholder="Setores">
    </label>
    <label class="full">Subtítulo
        <input name="hero_subtitulo" value="<?= e($campos['hero_subtitulo'] ?? '') ?>" maxlength="200">
        <small class="field-help">Breve descrição das áreas de atuação.</small>
    </label>
    <label>Imagem de fundo do banner
        <input type="file" name="hero_imagem" accept="image/jpeg,image/png,image/webp" data-preview-input>
        <small class="field-help">Opcional. JPG, PNG ou WebP. Recomendado: 1600x600px horizontal.</small>
    </label>
    <?php if (!empty($campos['hero_imagem'])): ?>
        <img class="image-preview image-preview-wide" data-preview src="<?= e(upload_url($campos['hero_imagem'])) ?>" alt="Banner atual">
    <?php else: ?>
        <img class="image-preview image-preview-wide" data-preview hidden alt="Preview">
    <?php endif; ?>
</div>

<div class="form-actions"><button class="button" type="submit">Salvar</button></div>
</form>
