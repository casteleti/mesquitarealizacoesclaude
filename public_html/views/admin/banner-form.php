<?php $isEdit = !empty($item); ?>
<form class="panel form-grid" method="post" enctype="multipart/form-data"
      action="<?= e($isEdit ? url('admin/banners/' . $item['id'] . '/edit') : url('admin/banners/create')) ?>">
    <?= Csrf::field() ?>
    <?php View::partial('partials/form-errors'); ?>

    <div class="form-section form-section-open">
        <div class="section-label"><h2>Conteúdo do banner</h2><p>Texto curto, direto e institucional.</p></div>

        <label>Label / Chamada superior
            <input name="label" value="<?= e(old('label', $item['label'] ?? '')) ?>" placeholder="Ex: QUEM SOMOS, OBRAS">
            <small class="field-help">Texto pequeno acima do título principal. Opcional.</small>
        </label>
        <label>Título principal
            <input name="headline" value="<?= e(old('headline', $item['headline'] ?? '')) ?>" required>
            <small class="field-help">Frase forte e curta. É o destaque visual do banner.</small>
        </label>
        <label class="full">Subtítulo
            <textarea name="subheadline" rows="3"><?= e(old('subheadline', $item['subheadline'] ?? '')) ?></textarea>
            <small class="field-help">Complemento breve. Uma ou duas linhas.</small>
        </label>
        <label>Botão primário — texto
            <input name="botao_primario_texto" value="<?= e(old('botao_primario_texto', $item['botao_primario_texto'] ?? '')) ?>" placeholder="Ver obras">
        </label>
        <label>Botão primário — link
            <input name="botao_primario_link" value="<?= e(old('botao_primario_link', $item['botao_primario_link'] ?? '')) ?>" placeholder="/obras">
        </label>
        <label>Botão secundário — texto
            <input name="botao_secundario_texto" value="<?= e(old('botao_secundario_texto', $item['botao_secundario_texto'] ?? '')) ?>" placeholder="Fale conosco">
        </label>
        <label>Botão secundário — link
            <input name="botao_secundario_link" value="<?= e(old('botao_secundario_link', $item['botao_secundario_link'] ?? '')) ?>" placeholder="/contato">
        </label>
    </div>

    <div class="form-section form-section-open">
        <div class="section-label"><h2>Imagem</h2></div>
        <label>Imagem do banner
            <input type="file" name="imagem" accept="image/jpeg,image/png,image/webp" data-preview-input>
            <small class="field-help">Recomendado: 1920x1080px. JPG ou WebP otimizado.</small>
        </label>
        <?php if (!empty($item['imagem'])): ?>
            <img class="image-preview image-preview-wide" data-preview src="<?= e(upload_url($item['imagem'])) ?>" alt="Preview">
        <?php else: ?>
            <img class="image-preview image-preview-wide" data-preview hidden alt="Preview">
        <?php endif; ?>
    </div>

    <details class="form-section advanced">
        <summary><span>Publicação e posição</span></summary>
        <div class="advanced-grid">
            <label>Posição
                <input type="number" name="ordem" value="<?= e((string) ($item['ordem'] ?? 0)) ?>">
                <small class="field-help">Números menores aparecem primeiro.</small>
            </label>
            <label class="check">
                <input type="checkbox" name="ativo" value="1" <?= !isset($item['ativo']) || $item['ativo'] ? 'checked' : '' ?>>
                Publicado
            </label>
        </div>
    </details>

    <div class="form-actions">
        <button class="button" type="submit">Salvar alterações</button>
        <a href="<?= e(url('admin/banners')) ?>">Cancelar</a>
    </div>
</form>
