<form class="panel form-grid" method="post" enctype="multipart/form-data" action="<?= e($item ? url('admin/obras/' . $item['id']) : url('admin/obras')) ?>">
<?= Csrf::field() ?>
<div class="form-section form-section-open">
    <div class="section-label"><h2>Informações da obra</h2><p>Dados principais exibidos no portfólio e na página da obra.</p></div>
    <label>Nome da obra <input name="name" value="<?= e($item['name'] ?? '') ?>" required><small class="field-help">Use um nome fácil de reconhecer.</small></label>
    <label>Setor relacionado <select name="sector_id"><option value="">Sem setor</option><?php foreach ($sectors as $sector): ?><option value="<?= e((string)$sector['id']) ?>" <?= (int)($item['sector_id'] ?? 0) === (int)$sector['id'] ? 'selected' : '' ?>><?= e($sector['name']) ?></option><?php endforeach; ?></select><small class="field-help">Ajuda a conectar a obra à área de atuação.</small></label>
    <label>Localização <input name="location" value="<?= e($item['location'] ?? '') ?>"><small class="field-help">Exemplo: Ribeirão Preto, SP.</small></label>
    <label>Resumo <textarea name="summary" rows="4"><?= e($item['summary'] ?? '') ?></textarea><small class="field-help">Texto curto usado nos cards e no início da página.</small></label>
    <label class="full">Texto completo <textarea name="content" rows="10"><?= e($item['content'] ?? '') ?></textarea><small class="field-help">Descreva escopo, contexto, atuação e pontos relevantes do projeto.</small></label>
</div>
<div class="form-section form-section-open">
    <div class="section-label"><h2>Imagem e publicação</h2><p>Controle a imagem principal e a visibilidade no site.</p></div>
    <label>Imagem principal <input type="file" name="image" accept="image/jpeg,image/png,image/webp" data-preview-input><small class="field-help">Use JPG, PNG ou WebP. Prefira imagem horizontal e nítida.</small></label>
    <label>Texto alternativo <input name="image_alt" value="<?= e($item['image_alt'] ?? '') ?>"><small class="field-help">Descreva a imagem em uma frase simples.</small></label>
    <?php if (!empty($item['image_path'])): ?><img class="image-preview" data-preview src="<?= e(upload_url($item['image_path'])) ?>" alt="Preview"><?php else: ?><img class="image-preview" data-preview hidden alt="Preview"><?php endif; ?>
    <label class="check"><input type="checkbox" name="is_active" value="1" <?= !isset($item['is_active']) || $item['is_active'] ? 'checked' : '' ?>> Publicado <small class="field-help">Desmarque para deixar a obra oculta no site.</small></label>
</div>
<details class="form-section advanced">
    <summary><span>Avançado: URL, destaque e posição</span><small>Campos opcionais para controlar exibição e organização.</small></summary>
    <div class="advanced-grid">
        <label>URL amigável <input name="slug" value="<?= e($item['slug'] ?? '') ?>"><small class="field-help">Endereço da página. Use letras minúsculas e hífens, sem espaços.</small></label>
        <label>Posição <input type="number" name="sort_order" value="<?= e((string)($item['sort_order'] ?? 0)) ?>"><small class="field-help">Números menores aparecem primeiro.</small></label>
        <label class="check"><input type="checkbox" name="is_featured" value="1" <?= !empty($item['is_featured']) ? 'checked' : '' ?>> Destacar na Home <small class="field-help">Use para mostrar esta obra entre os destaques da página inicial.</small></label>
    </div>
</details>
<?php View::partial('partials/admin-seo-fields', ['item' => $item ?? []]); ?>
<div class="form-actions"><button class="button" type="submit">Salvar alterações</button></div>
</form>
