<form class="panel form-grid" method="post" action="<?= e($item ? url('admin/gestao/' . $item['id'] . '/edit') : url('admin/gestao/create')) ?>">
<?= Csrf::field() ?>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2><?= $item ? 'Editar card de gestão' : 'Novo card de gestão' ?></h2>
        <p>Destaque um pilar da gestão de obras: segurança, qualidade, comunicação, etc.</p>
    </div>

    <?php View::partial('partials/form-errors'); ?>

    <label>Ícone <span class="required">*</span>
        <input name="icone" value="<?= e(old('icone', $item['icone'] ?? '')) ?>" required placeholder="fa-solid fa-shield-halved">
        <small class="field-help">Classe CSS do ícone (Font Awesome ou similar). Obrigatório.</small>
    </label>

    <label>Título <span class="required">*</span>
        <input name="titulo" value="<?= e(old('titulo', $item['titulo'] ?? '')) ?>" required maxlength="100">
        <small class="field-help">Exemplo: Segurança em campo, Qualidade de execução, Comunicação direta.</small>
    </label>

    <label class="full">Texto descritivo
        <textarea name="texto" rows="4"><?= e(old('texto', $item['texto'] ?? '')) ?></textarea>
        <small class="field-help">Explique brevemente como este pilar se manifesta no dia a dia das obras.</small>
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
