<?php $isEdit = !empty($item); ?>
<form class="panel form-grid" method="post" enctype="multipart/form-data"
      action="<?= e($isEdit ? url('admin/setores/' . $item['id'] . '/edit') : url('admin/setores/create')) ?>">
    <?= Csrf::field() ?>
    <?php View::partial('partials/form-errors'); ?>

    <div class="form-section form-section-open">
        <div class="section-label"><h2>Conteúdo do setor</h2><p>Apresente o segmento com linguagem técnica e objetiva.</p></div>

        <label>Nome do setor
            <input name="title" value="<?= e(old('title', $item['title'] ?? '')) ?>" required>
            <small class="field-help">Ex: Bioenergia, Energia, Indústria, Infraestrutura Logística.</small>
        </label>
        <label>Ícone (classe CSS)
            <input name="icone" value="<?= e(old('icone', $item['icone'] ?? '')) ?>" placeholder="Ex: icon-energia">
        </label>
        <label>Título curto (Home)
            <input name="titulo_home" value="<?= e(old('titulo_home', $item['titulo_home'] ?? '')) ?>" maxlength="30">
            <small class="field-help">Versão compacta exibida nos cards da home. Máx. 30 caracteres.</small>
        </label>
        <label>Descrição curta
            <input name="descricao_curta" value="<?= e(old('descricao_curta', $item['descricao_curta'] ?? '')) ?>" maxlength="80">
            <small class="field-help">Máx. 80 caracteres para o card da home.</small>
        </label>
        <label>Título da página interna
            <input name="titulo_pagina" value="<?= e(old('titulo_pagina', $item['titulo_pagina'] ?? '')) ?>" maxlength="60">
        </label>
        <label class="full">Descrição completa
            <textarea name="descricao" rows="8"><?= e(old('descricao', $item['descricao'] ?? '')) ?></textarea>
            <small class="field-help">Texto da página do setor. Explique atuação, tipos de obra e diferenciais.</small>
        </label>
    </div>

    <div class="form-section form-section-open">
        <div class="section-label"><h2>Imagem do setor</h2></div>
        <label>Imagem principal
            <input type="file" name="imagem" accept="image/jpeg,image/png,image/webp" data-preview-input>
            <small class="field-help">Recomendado: 1600x1000px. JPG ou WebP.</small>
        </label>
        <?php if (!empty($item['imagem'])): ?>
            <img class="image-preview image-preview-wide" data-preview src="<?= e(upload_url($item['imagem'])) ?>" alt="Preview">
        <?php else: ?>
            <img class="image-preview image-preview-wide" data-preview hidden alt="Preview">
        <?php endif; ?>
    </div>

    <div class="form-section form-section-open">
        <div class="section-label"><h2>Publicação e chamada</h2></div>
        <label>Texto do botão
            <input name="botao_texto" value="<?= e(old('botao_texto', $item['botao_texto'] ?? '')) ?>" placeholder="Ver obras do setor">
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
                <small class="field-help">Gerado automaticamente se vazio.</small>
            </label>
            <label>Posição
                <input type="number" name="ordem" value="<?= e((string) ($item['ordem'] ?? 0)) ?>">
            </label>
        </div>
    </details>

    <div class="form-actions">
        <button class="button" type="submit">Salvar alterações</button>
        <a href="<?= e(url('admin/setores')) ?>">Cancelar</a>
    </div>
</form>
