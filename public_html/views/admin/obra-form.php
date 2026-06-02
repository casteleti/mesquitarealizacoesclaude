<?php $isEdit = !empty($item); ?>
<form class="panel form-grid" method="post" enctype="multipart/form-data"
      action="<?= e($isEdit ? url('admin/obras/' . $item['id'] . '/edit') : url('admin/obras/create')) ?>">
    <?= Csrf::field() ?>
    <?php View::partial('partials/form-errors'); ?>

    <div class="form-section form-section-open">
        <div class="section-label"><h2>Informações da obra</h2><p>Dados principais exibidos no portfólio.</p></div>

        <label>Título da obra
            <input name="title" value="<?= e(old('title', $item['title'] ?? '')) ?>" required>
        </label>
        <label>Cliente
            <input name="cliente" value="<?= e(old('cliente', $item['cliente'] ?? '')) ?>">
        </label>
        <label>Setor relacionado
            <select name="setor_id">
                <option value="">Sem setor</option>
                <?php foreach ($setores as $s): ?>
                    <option value="<?= e((string) $s['id']) ?>"
                        <?= (int) ($item['setor_id'] ?? 0) === (int) $s['id'] ? 'selected' : '' ?>>
                        <?= e($s['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Localização
            <input name="localizacao" value="<?= e(old('localizacao', $item['localizacao'] ?? '')) ?>" placeholder="Ex: Ribeirão Preto, SP">
        </label>
        <label>Subtítulo
            <input name="subtitulo" value="<?= e(old('subtitulo', $item['subtitulo'] ?? '')) ?>">
            <small class="field-help">Aparece abaixo do título na página da obra.</small>
        </label>
        <label>Data início
            <input name="data_inicio" value="<?= e(old('data_inicio', $item['data_inicio'] ?? '')) ?>" placeholder="Ex: Março/2024">
        </label>
        <label>Data conclusão
            <input name="data_conclusao" value="<?= e(old('data_conclusao', $item['data_conclusao'] ?? '')) ?>" placeholder="Ex: Dezembro/2024">
        </label>
        <label class="full">Descrição completa
            <textarea name="descricao" rows="10"><?= e(old('descricao', $item['descricao'] ?? '')) ?></textarea>
            <small class="field-help">Texto principal da página da obra.</small>
        </label>
        <label class="full">Escopo / Serviços executados
            <textarea name="escopo" rows="5"><?= e(old('escopo', $item['escopo'] ?? '')) ?></textarea>
        </label>
    </div>

    <div class="form-section form-section-open">
        <div class="section-label">
            <h2>Imagem principal</h2>
            <p>Foto de capa exibida nos cards e no topo da página da obra.</p>
        </div>
        <label>Imagem
            <input type="file" name="imagem_principal" accept="image/jpeg,image/png,image/webp" data-preview-input>
            <small class="field-help">JPG, PNG ou WebP. Tamanho ideal: <strong>1280×720px</strong> (proporção 16:9). Máx. 8MB.</small>
        </label>
        <?php if (!empty($item['imagem_principal'])): ?>
            <img class="image-preview" data-preview src="<?= e(upload_url($item['imagem_principal'])) ?>" alt="Preview">
        <?php else: ?>
            <img class="image-preview" data-preview hidden alt="Preview">
        <?php endif; ?>

        <label class="check">
            <input type="checkbox" name="destaque" value="1" <?= !empty($item['destaque']) ? 'checked' : '' ?>>
            Destacar na Home
        </label>
        <label class="check">
            <input type="checkbox" name="ativo" value="1" <?= !isset($item['ativo']) || $item['ativo'] ? 'checked' : '' ?>>
            Publicado
        </label>
    </div>

    <details class="form-section advanced">
        <summary><span>Avançado: URL e posição</span></summary>
        <div class="advanced-grid">
            <label>URL amigável
                <input name="slug" value="<?= e(old('slug', $item['slug'] ?? '')) ?>">
                <small class="field-help">Letras minúsculas e hífens. Gerado automaticamente se vazio.</small>
            </label>
            <label>Posição
                <input type="number" name="ordem" value="<?= e((string) ($item['ordem'] ?? 0)) ?>">
            </label>
        </div>
    </details>

    <details class="form-section advanced">
        <summary><span>SEO</span><small>Título e descrição para Google.</small></summary>
        <div class="advanced-grid">
            <label>Título SEO
                <input name="seo_title" value="<?= e(old('seo_title', $item['seo_title'] ?? '')) ?>" maxlength="60">
                <small class="field-help">Máx. 60 caracteres. Se vazio usa o título da obra.</small>
            </label>
            <label class="full">Descrição SEO
                <textarea name="seo_description" rows="3" maxlength="155"><?= e(old('seo_description', $item['seo_description'] ?? '')) ?></textarea>
                <small class="field-help">Máx. 155 caracteres.</small>
            </label>
        </div>
    </details>

    <div class="form-actions">
        <button class="button" type="submit">Salvar alterações</button>
        <a href="<?= e(url('admin/obras')) ?>">Cancelar</a>
    </div>
</form>
