<form class="panel form-grid" method="post" enctype="multipart/form-data" action="<?= e($item ? url('admin/setores/' . $item['id']) : url('admin/setores')) ?>">
<?= Csrf::field() ?>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Conteudo do setor</h2>
        <p>Apresente o segmento com linguagem tecnica, objetiva e facil de manter.</p>
    </div>

    <label>Nome do setor
        <input name="name" value="<?= e($item['name'] ?? '') ?>" required>
        <small class="field-help">Exemplo: Bioenergia, Energia, Industria ou Infraestrutura Logistica.</small>
    </label>

    <label>Resumo tecnico
        <textarea name="summary" rows="4"><?= e($item['summary'] ?? '') ?></textarea>
        <small class="field-help">Texto curto exibido na area principal da pagina de setores.</small>
    </label>

    <label class="full">Descricao completa
        <textarea name="content" rows="10"><?= e($item['content'] ?? '') ?></textarea>
        <small class="field-help">Explique a atuacao, tipos de obra, contexto operacional e diferenciais deste setor.</small>
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Imagem do setor</h2>
        <p>Use imagens horizontais e tecnicas para manter o padrao visual da pagina.</p>
    </div>

    <label>Imagem principal
        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" data-preview-input data-preview-target="sector-main-preview" data-warning-target="sector-main-warning" data-image-ratio="1.6" data-image-min-width="1200" data-image-min-height="750">
        <small class="field-help">Imagem recomendada: 1600x1000px - proporcao 16:10. Tamanho minimo: 1200x750px.</small>
        <small class="field-warning" id="sector-main-warning" hidden></small>
    </label>

    <label>Thumbnail opcional
        <input type="file" name="thumbnail" accept="image/jpeg,image/png,image/webp" data-preview-input data-preview-target="sector-thumb-preview" data-warning-target="sector-thumb-warning" data-image-ratio="1.428" data-image-min-width="600" data-image-min-height="420">
        <small class="field-help">Opcional. Recomendada: 600x420px para uso em navegacao e futuras listagens.</small>
        <small class="field-warning" id="sector-thumb-warning" hidden></small>
    </label>

    <div class="upload-preview-grid full">
        <div>
            <span class="preview-label">Imagem principal</span>
            <?php if (!empty($item['image_path'])): ?>
                <img class="image-preview image-preview-wide" id="sector-main-preview" data-preview src="<?= e(upload_url($item['image_path'])) ?>" alt="Preview da imagem principal">
            <?php else: ?>
                <img class="image-preview image-preview-wide" id="sector-main-preview" data-preview hidden alt="Preview da imagem principal">
            <?php endif; ?>
        </div>
        <div>
            <span class="preview-label">Thumbnail</span>
            <?php if (!empty($item['thumbnail_path'])): ?>
                <img class="image-preview" id="sector-thumb-preview" data-preview src="<?= e(upload_url($item['thumbnail_path'])) ?>" alt="Preview do thumbnail">
            <?php else: ?>
                <img class="image-preview" id="sector-thumb-preview" data-preview hidden alt="Preview do thumbnail">
            <?php endif; ?>
        </div>
    </div>

    <label>Texto alternativo da imagem
        <input name="image_alt" value="<?= e($item['image_alt'] ?? '') ?>">
        <small class="field-help">Descreva a imagem em uma frase simples para acessibilidade e SEO.</small>
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Publicacao e chamada</h2>
        <p>Controle a visibilidade e o botao exibido ao visitante.</p>
    </div>

    <label>Texto do botao
        <input name="button_label" value="<?= e($item['button_label'] ?? '') ?>" placeholder="Ver obras do setor">
        <small class="field-help">Se ficar vazio, o site usa automaticamente "Ver obras do setor".</small>
    </label>

    <label>Link do botao
        <input name="button_url" value="<?= e($item['button_url'] ?? '') ?>" placeholder="<?= e(url('obras')) ?>">
        <small class="field-help">Opcional. Se ficar vazio, o botao aponta para a pagina tecnica do proprio setor.</small>
    </label>

    <label class="check">
        <input type="checkbox" name="is_active" value="1" <?= !isset($item['is_active']) || $item['is_active'] ? 'checked' : '' ?>>
        Publicado
        <small class="field-help">Desmarque para deixar o setor oculto no site.</small>
    </label>
</div>

<details class="form-section advanced">
    <summary><span>Avancado: URL amigavel e posicao</span><small>Normalmente o sistema pode manter esses campos como estao.</small></summary>
    <div class="advanced-grid">
        <label>URL amigavel
            <input name="slug" value="<?= e($item['slug'] ?? '') ?>">
            <small class="field-help">Endereco da pagina. Use letras minusculas e hifens, sem espacos.</small>
        </label>
        <label>Posicao
            <input type="number" name="sort_order" value="<?= e((string)($item['sort_order'] ?? 0)) ?>">
            <small class="field-help">Numeros menores aparecem primeiro.</small>
        </label>
    </div>
</details>

<?php View::partial('partials/admin-seo-fields', ['item' => $item ?? []]); ?>

<div class="form-actions"><button class="button" type="submit">Salvar alteracoes</button></div>
</form>
