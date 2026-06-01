<form class="panel form-grid" method="post" action="<?= e($item ? url('admin/valores/' . $item['id'] . '/edit') : url('admin/valores/create')) ?>">
<?= Csrf::field() ?>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2><?= $item ? 'Editar valor' : 'Novo valor' ?></h2>
        <p>Use linguagem institucional, direta. Um valor por card.</p>
    </div>

    <?php View::partial('partials/form-errors'); ?>

    <label>Título <span class="required">*</span>
        <input name="titulo" value="<?= e(old('titulo', $item['titulo'] ?? '')) ?>" required maxlength="100">
        <small class="field-help">Exemplo: Responsabilidade técnica, Comunicação direta, Presença em campo.</small>
    </label>

    <label class="full">Resumo
        <input name="resumo" value="<?= e(old('resumo', $item['resumo'] ?? '')) ?>" maxlength="150">
        <small class="field-help">Uma frase que resume o valor. Exibida em destaque.</small>
    </label>

    <label class="full">Texto completo
        <textarea name="texto" rows="4"><?= e(old('texto', $item['texto'] ?? '')) ?></textarea>
        <small class="field-help">Detalhamento opcional do valor. Não exibido em listagens.</small>
    </label>

    <label>Ícone
        <input name="icone" value="<?= e(old('icone', $item['icone'] ?? '')) ?>" placeholder="fa-solid fa-star">
        <small class="field-help">Classe CSS do ícone. Opcional.</small>
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Tópicos complementares</h2>
        <p>Até 3 tópicos opcionais para detalhar o valor.</p>
    </div>

    <label>Tópico 1
        <input name="topico_1" value="<?= e(old('topico_1', $item['topico_1'] ?? '')) ?>" maxlength="150">
    </label>
    <label>Tópico 2
        <input name="topico_2" value="<?= e(old('topico_2', $item['topico_2'] ?? '')) ?>" maxlength="150">
    </label>
    <label>Tópico 3
        <input name="topico_3" value="<?= e(old('topico_3', $item['topico_3'] ?? '')) ?>" maxlength="150">
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
