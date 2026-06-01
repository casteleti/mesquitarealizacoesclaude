<div class="panel-head">
    <div class="panel-title">
        <h2>Setores em destaque na Home</h2>
        <p>Escolha de 1 a 4 setores e defina a ordem em que aparecem na página inicial.</p>
    </div>
</div>

<form class="panel form-grid" method="post" action="<?= e(url('admin/setores-destaque')) ?>" id="form-destaque">
    <?= Csrf::field() ?>
    <?php View::partial('partials/flash'); ?>

    <div class="form-section form-section-open">
        <div class="section-label">
            <h2>Selecione os setores</h2>
            <p>Marque até 4 setores e escolha a posição de cada um. A ordem determina como aparecem na home.</p>
        </div>

        <div class="destaque-counter" id="destaque-counter">
            <span id="destaque-count"><?= count($selecionados) ?></span>/4 selecionados
        </div>

        <div class="destaque-list" id="destaque-list">
            <?php foreach ($setores as $setor): ?>
                <?php
                    $id         = (int) $setor['id'];
                    $checked    = isset($selecionados[$id]);
                    $posAtual   = $selecionados[$id] ?? 1;
                    $obras_count = (int) ($setor['obras_count'] ?? 0);
                ?>
                <div class="destaque-item <?= $checked ? 'is-selected' : '' ?>" data-setor-id="<?= $id ?>">
                    <label class="destaque-check">
                        <input
                            type="checkbox"
                            name="setor_ids[]"
                            value="<?= $id ?>"
                            <?= $checked ? 'checked' : '' ?>
                            data-destaque-checkbox
                        >
                        <span class="destaque-nome"><?= e($setor['title']) ?></span>
                        <?php if ($obras_count > 0): ?>
                            <span class="destaque-obras"><?= $obras_count ?> obra<?= $obras_count !== 1 ? 's' : '' ?></span>
                        <?php else: ?>
                            <span class="destaque-obras destaque-obras-vazio">sem obras</span>
                        <?php endif; ?>
                    </label>

                    <label class="destaque-pos <?= $checked ? '' : 'destaque-pos-disabled' ?>">
                        <span>Posição</span>
                        <select
                            name="setor_ordem[<?= $id ?>]"
                            data-destaque-select
                            <?= $checked ? '' : 'disabled' ?>
                        >
                            <?php for ($p = 1; $p <= 4; $p++): ?>
                                <option value="<?= $p ?>" <?= $posAtual === $p ? 'selected' : '' ?>><?= $p ?>ª</option>
                            <?php endfor; ?>
                        </select>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>

        <p class="field-help" style="margin-top:12px">
            A página <a href="<?= e(url('setores')) ?>" target="_blank">/setores</a> continua exibindo <strong>todos</strong> os setores, independente desta configuração.
        </p>
    </div>

    <div class="form-actions">
        <button class="button" type="submit">Salvar configuração</button>
        <a href="<?= e(url('admin/dashboard')) ?>">Cancelar</a>
    </div>
</form>

<script>
(function () {
    const MAX = 4;
    const checkboxes = document.querySelectorAll('[data-destaque-checkbox]');
    const counter    = document.getElementById('destaque-count');

    function updateCounter() {
        const checked = document.querySelectorAll('[data-destaque-checkbox]:checked').length;
        counter.textContent = checked;
        counter.closest('.destaque-counter').classList.toggle('destaque-counter-full', checked >= MAX);
    }

    checkboxes.forEach(function (cb) {
        cb.addEventListener('change', function () {
            const item   = this.closest('.destaque-item');
            const sel    = item.querySelector('[data-destaque-select]');
            const posLbl = item.querySelector('.destaque-pos');

            // Bloquear se já tiver MAX e tentando marcar mais
            const total = document.querySelectorAll('[data-destaque-checkbox]:checked').length;
            if (this.checked && total > MAX) {
                this.checked = false;
                alert('Máximo de ' + MAX + ' setores em destaque. Desmarque um antes de adicionar outro.');
                return;
            }

            // Impedir desmarcar todos
            if (!this.checked && total === 0) {
                this.checked = true;
                alert('Selecione pelo menos 1 setor em destaque.');
                return;
            }

            item.classList.toggle('is-selected', this.checked);
            sel.disabled = !this.checked;
            posLbl.classList.toggle('destaque-pos-disabled', !this.checked);

            updateCounter();
        });
    });

    updateCounter();
})();
</script>

<style>
.destaque-counter {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 20px;
    background: var(--color-surface, #f5f5f5);
    font-size: .85rem;
    font-weight: 600;
    margin-bottom: 18px;
    border: 1px solid var(--color-border, #e0e0e0);
}
.destaque-counter-full { background: #fff3cd; border-color: #ffc107; color: #856404; }

.destaque-list { display: flex; flex-direction: column; gap: 10px; }

.destaque-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 14px 18px;
    border: 2px solid var(--color-border, #e4e4e7);
    border-radius: 8px;
    background: #fafafa;
    transition: border-color .15s, background .15s;
}
.destaque-item.is-selected {
    border-color: var(--color-red, #c0392b);
    background: #fff;
}

.destaque-check {
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    flex: 1;
    font-weight: normal;
    margin: 0;
}
.destaque-check input[type=checkbox] { width: 18px; height: 18px; cursor: pointer; flex-shrink: 0; }
.destaque-nome { font-weight: 600; font-size: .95rem; }
.destaque-obras { font-size: .78rem; color: #666; background: #f0f0f0; padding: 2px 8px; border-radius: 20px; }
.destaque-obras-vazio { color: #aaa; }

.destaque-pos {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: .85rem;
    color: #555;
    white-space: nowrap;
}
.destaque-pos span { font-weight: 500; }
.destaque-pos select {
    padding: 4px 8px;
    border-radius: 6px;
    border: 1px solid var(--color-border, #ddd);
    font-size: .85rem;
    min-width: 60px;
}
.destaque-pos-disabled { opacity: .4; pointer-events: none; }
</style>
