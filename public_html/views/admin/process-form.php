<form class="panel form-grid" method="post" action="<?= e($item ? url('admin/processo/' . $item['id'] . '/edit') : url('admin/processo/create')) ?>">
<?= Csrf::field() ?>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2><?= $item ? 'Editar etapa' : 'Nova etapa' ?></h2>
        <p>Descreva a etapa de forma clara e técnica. Use o número para indicar a sequência.</p>
    </div>

    <?php View::partial('partials/form-errors'); ?>

    <label>Número <span class="required">*</span>
        <input name="numero" value="<?= e(old('numero', $item['numero'] ?? '')) ?>" required maxlength="10" placeholder="01">
        <small class="field-help">Exibido como identificador visual da etapa. Exemplo: 01, 02, 03.</small>
    </label>

    <label>Título <span class="required">*</span>
        <input name="titulo" value="<?= e(old('titulo', $item['titulo'] ?? '')) ?>" required maxlength="100">
        <small class="field-help">Exemplo: Diagnóstico, Planejamento, Execução, Entrega.</small>
    </label>

    <label class="full">Descrição
        <textarea name="descricao" rows="3"><?= e(old('descricao', $item['descricao'] ?? '')) ?></textarea>
        <small class="field-help">Breve explicação do que acontece nesta etapa.</small>
    </label>

    <label>Ícone
        <input name="icone" value="<?= e(old('icone', $item['icone'] ?? '')) ?>" placeholder="fa-solid fa-magnifying-glass">
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Bloco de tópicos</h2>
        <p>Opcional. Use para detalhar ações, entregas ou critérios desta etapa.</p>
    </div>

    <label class="full">Título do bloco
        <input name="bloco_titulo" value="<?= e(old('bloco_titulo', $item['bloco_titulo'] ?? '')) ?>" maxlength="100">
        <small class="field-help">Exemplo: O que fazemos nesta etapa, Entregas desta fase.</small>
    </label>

    <label>Tópico 1
        <input name="topico_1" value="<?= e(old('topico_1', $item['topico_1'] ?? '')) ?>" maxlength="200">
    </label>
    <label>Tópico 2
        <input name="topico_2" value="<?= e(old('topico_2', $item['topico_2'] ?? '')) ?>" maxlength="200">
    </label>
    <label>Tópico 3
        <input name="topico_3" value="<?= e(old('topico_3', $item['topico_3'] ?? '')) ?>" maxlength="200">
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Resultado da etapa</h2>
        <p>Opcional. Destaque o entregável ou o objetivo alcançado ao final desta fase.</p>
    </div>

    <label>Título do resultado
        <input name="resultado_titulo" value="<?= e(old('resultado_titulo', $item['resultado_titulo'] ?? '')) ?>" maxlength="100">
        <small class="field-help">Exemplo: Resultado, Entrega, O que você recebe.</small>
    </label>

    <label class="full">Texto do resultado
        <textarea name="resultado_texto" rows="3"><?= e(old('resultado_texto', $item['resultado_texto'] ?? '')) ?></textarea>
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
    <a href="<?= e(url('admin/processo')) ?>">Cancelar</a>
    <button class="button" type="submit">Salvar</button>
</div>
</form>
