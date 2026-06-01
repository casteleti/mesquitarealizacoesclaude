<form class="panel form-grid" method="post" enctype="multipart/form-data" action="<?= e($item ? url('admin/valores/' . $item['id'] . '/edit') : url('admin/valores/create')) ?>">
<?= Csrf::field() ?>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2><?= $item ? 'Editar valor' : 'Novo valor' ?></h2>
        <p>Use linguagem institucional, direta. Um valor por card.</p>
    </div>

    <?php View::partial('partials/form-errors'); ?>

    <label>Título <span class="required">*</span>
        <input name="titulo" value="<?= e(old('titulo', $item['titulo'] ?? '')) ?>" required maxlength="35">
        <small class="field-help">Máx. 35 caracteres. Ex: Responsabilidade técnica, Comunicação direta.</small>
    </label>

    <label class="full">Resumo
        <input name="resumo" value="<?= e(old('resumo', $item['resumo'] ?? '')) ?>" maxlength="100">
        <small class="field-help">Máx. 100 caracteres. Frase curta exibida abaixo do título.</small>
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Ícone</h2>
        <p>Faça upload de um ícone SVG ou PNG, ou use o nome de um ícone do sistema.</p>
    </div>

    <label>Upload de ícone (SVG ou PNG)
        <input type="file" name="icone_arquivo" accept="image/svg+xml,image/png,image/webp" data-preview-input>
        <small class="field-help">Recomendado: SVG 32×32px. Prioridade sobre o ícone do sistema.</small>
    </label>
    <?php if (!empty($item['icone_arquivo'])): ?>
        <div style="display:flex;align-items:center;gap:10px;margin-top:4px">
            <img data-preview src="<?= e(upload_url($item['icone_arquivo'])) ?>" width="32" height="32" style="filter:invert(18%) sepia(96%) saturate(1000%) hue-rotate(343deg) brightness(97%)" alt="Ícone atual">
            <span class="field-help">Ícone atual</span>
        </div>
    <?php else: ?>
        <img data-preview hidden width="32" height="32" alt="Preview">
    <?php endif; ?>

    <label>Ou: ícone do sistema (nome Lucide)
        <input name="icone" value="<?= e(old('icone', $item['icone'] ?? '')) ?>" placeholder="Ex: star, shield, award, target">
        <small class="field-help">Usado apenas se não houver upload. <a href="https://lucide.dev/icons/" target="_blank" rel="noopener">Ver ícones disponíveis</a></small>
    </label>
</div>

<details class="form-section advanced">
    <summary><span>Avançado: posição e visibilidade</span></summary>
    <div class="advanced-grid">
        <label>Posição
            <input type="number" name="ordem" value="<?= e(old('ordem', (string)($item['ordem'] ?? 0))) ?>">
        </label>
        <label class="check">
            <input type="checkbox" name="ativo" value="1" <?= old('ativo', (string)($item['ativo'] ?? '1')) ? 'checked' : '' ?>>
            Ativo
        </label>
    </div>
</details>

<div class="form-actions">
    <a href="<?= e(url('admin/valores')) ?>">Cancelar</a>
    <button class="button" type="submit">Salvar</button>
</div>
</form>
