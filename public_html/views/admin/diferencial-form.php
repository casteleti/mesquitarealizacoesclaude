<form class="panel form-grid" method="post" action="<?= e($item ? url('admin/diferenciais/' . $item['id'] . '/edit') : url('admin/diferenciais/create')) ?>">
<?= Csrf::field() ?>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2><?= $item ? 'Editar diferencial' : 'Novo diferencial' ?></h2>
        <p>Use linguagem objetiva e técnica. Destaque um aspecto real da execução.</p>
    </div>

    <?php View::partial('partials/form-errors'); ?>

    <label>Título <span class="required">*</span>
        <input name="titulo" value="<?= e(old('titulo', $item['titulo'] ?? '')) ?>" required maxlength="100">
        <small class="field-help">Exemplo: Planejamento estruturado, Comunicação direta, Presença em campo.</small>
    </label>

    <label class="full">Texto descritivo
        <textarea name="texto" rows="3"><?= e(old('texto', $item['texto'] ?? '')) ?></textarea>
        <small class="field-help">Uma ou duas frases que detalham o diferencial. Opcional.</small>
    </label>

    <label>Ícone
        <input name="icone" value="<?= e(old('icone', $item['icone'] ?? '')) ?>" placeholder="fa-solid fa-check">
        <small class="field-help">Classe CSS do ícone (Font Awesome ou similar). Opcional.</small>
    </label>

    <label>Exibir em <span class="required">*</span>
        <select name="exibir_em" required>
            <option value="1" <?= (old('exibir_em', (string)($item['exibir_em'] ?? '1')) === '1') ? 'selected' : '' ?>>Home</option>
            <option value="2" <?= (old('exibir_em', (string)($item['exibir_em'] ?? '1')) === '2') ? 'selected' : '' ?>>Quem Somos</option>
            <option value="3" <?= (old('exibir_em', (string)($item['exibir_em'] ?? '1')) === '3') ? 'selected' : '' ?>>Ambas</option>
        </select>
    </label>
</div>

<details class="form-section advanced">
    <summary><span>Avançado: posição e visibilidade</span></summary>
    <div class="advanced-grid">
        <label>Posição
            <input type="number" name="ordem" value="<?= e(old('ordem', (string)($item['ordem'] ?? 0))) ?>">
            <small class="field-help">Números menores aparecem primeiro.</small>
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
