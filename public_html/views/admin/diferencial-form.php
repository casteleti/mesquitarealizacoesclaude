<form class="panel form-grid" method="post" enctype="multipart/form-data" action="<?= e($item ? url('admin/diferenciais/' . $item['id'] . '/edit') : url('admin/diferenciais/create')) ?>">
<?= Csrf::field() ?>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2><?= $item ? 'Editar diferencial' : 'Novo diferencial' ?></h2>
        <p>Destaque um aspecto real e objetivo da execução.</p>
    </div>

    <?php View::partial('partials/form-errors'); ?>

    <label>Título <span class="required">*</span>
        <input name="titulo" value="<?= e(old('titulo', $item['titulo'] ?? '')) ?>" required maxlength="35">
        <small class="field-help">Máx. 35 caracteres. Ex: Capacidade de execução, Planejamento estruturado.</small>
    </label>

    <label class="full">Texto descritivo
        <textarea name="texto" rows="3"><?= e(old('texto', $item['texto'] ?? '')) ?></textarea>
        <small class="field-help">Máx. 100 caracteres. Uma frase curta que detalha o diferencial.</small>
    </label>

    <label>Exibir em <span class="required">*</span>
        <select name="exibir_em" required>
            <option value="1" <?= (old('exibir_em', (string)($item['exibir_em'] ?? '1')) === '1') ? 'selected' : '' ?>>Home</option>
            <option value="2" <?= (old('exibir_em', (string)($item['exibir_em'] ?? '1')) === '2') ? 'selected' : '' ?>>Quem Somos</option>
            <option value="3" <?= (old('exibir_em', (string)($item['exibir_em'] ?? '1')) === '3') ? 'selected' : '' ?>>Ambas</option>
        </select>
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
        <input name="icone" value="<?= e(old('icone', $item['icone'] ?? '')) ?>" placeholder="Ex: check-circle, shield-check, wrench">
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
    <a href="<?= e(url('admin/diferenciais')) ?>">Cancelar</a>
    <button class="button" type="submit">Salvar</button>
</div>
</form>
