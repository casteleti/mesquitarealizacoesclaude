<form class="panel form-grid" method="post" enctype="multipart/form-data" action="<?= e($item ? url('admin/gestao/' . $item['id'] . '/edit') : url('admin/gestao/create')) ?>">
<?= Csrf::field() ?>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2><?= $item ? 'Editar card de gestão' : 'Novo card de gestão' ?></h2>
        <p>Destaque um pilar da gestão de obras: segurança, qualidade, comunicação, etc.</p>
    </div>

    <?php View::partial('partials/form-errors'); ?>

    <label>Título <span class="required">*</span>
        <input name="titulo" value="<?= e(old('titulo', $item['titulo'] ?? '')) ?>" required maxlength="35">
        <small class="field-help">Máx. 35 caracteres. Ex: Segurança em campo, Qualidade de execução.</small>
    </label>

    <label class="full">Texto descritivo
        <textarea name="texto" rows="3"><?= e(old('texto', $item['texto'] ?? '')) ?></textarea>
        <small class="field-help">Máx. 100 caracteres. Explique brevemente este pilar.</small>
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
        <input name="icone" value="<?= e(old('icone', $item['icone'] ?? '')) ?>" placeholder="Ex: shield-check, wrench, hard-hat">
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
    <a href="<?= e(url('admin/gestao')) ?>">Cancelar</a>
    <button class="button" type="submit">Salvar</button>
</div>
</form>
