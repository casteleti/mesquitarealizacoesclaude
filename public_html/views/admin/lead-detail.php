<?php
$statusLabels = Lead::STATUS;
$statusColors = [1 => 'badge-warning', 2 => 'badge-muted', 3 => 'badge-info', 4 => 'badge-success', 5 => 'badge-danger'];
$tipoLabel = Lead::TIPOS_PROJETO[$lead['tipo_projeto']] ?? $lead['tipo_projeto'];
?>
<div class="panel-head">
    <div class="panel-title">
        <h2>Lead: <?= e($lead['nome']) ?></h2>
        <p>Recebido em <?= e(date('d/m/Y \à\s H:i', strtotime($lead['created_at']))) ?></p>
    </div>
    <a href="<?= e(url('admin/leads')) ?>">← Voltar</a>
</div>

<div class="panel form-grid">
    <div class="form-section form-section-open">
        <div class="section-label">
            <h2>Dados do contato</h2>
        </div>

        <dl class="detail-list">
            <div><dt>Nome</dt><dd><?= e($lead['nome']) ?></dd></div>
            <div><dt>Empresa</dt><dd><?= e($lead['empresa']) ?></dd></div>
            <div><dt>E-mail</dt><dd><a href="mailto:<?= e($lead['email']) ?>"><?= e($lead['email']) ?></a></dd></div>
            <div><dt>Telefone</dt><dd><?php if ($lead['telefone']): ?><a href="tel:<?= e(preg_replace('/\D+/', '', $lead['telefone'])) ?>"><?= e($lead['telefone']) ?></a><?php else: ?>—<?php endif; ?></dd></div>
            <div><dt>Tipo de projeto</dt><dd><?= e($tipoLabel) ?></dd></div>
            <?php if ($lead['local']): ?>
                <div><dt>Local da obra</dt><dd><?= e($lead['local']) ?></dd></div>
            <?php endif; ?>
            <div><dt>IP</dt><dd><?= e($lead['ip'] ?? '—') ?></dd></div>
        </dl>
    </div>

    <div class="form-section form-section-open">
        <div class="section-label">
            <h2>Mensagem</h2>
        </div>
        <div class="lead-message prose">
            <?= nl2br(e($lead['mensagem'])) ?>
        </div>
    </div>

    <div class="form-section form-section-open">
        <div class="section-label">
            <h2>Status</h2>
            <p>Status atual: <span class="badge <?= $statusColors[$lead['status']] ?? 'badge-muted' ?>"><?= e($statusLabels[$lead['status']] ?? '-') ?></span></p>
        </div>

        <?php View::partial('partials/flash'); ?>

        <form method="post" action="<?= e(url('admin/leads/' . $lead['id'] . '/status')) ?>">
            <?= Csrf::field() ?>
            <label>Alterar status
                <select name="status">
                    <?php foreach ($statusLabels as $val => $label): ?>
                        <option value="<?= e((string) $val) ?>" <?= ((int)$lead['status'] === $val) ? 'selected' : '' ?>><?= e($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <div class="form-actions" style="margin-top:1rem">
                <button class="button" type="submit">Atualizar status</button>
                <form method="post" action="<?= e(url('admin/leads/' . $lead['id'] . '/delete')) ?>" data-confirm="Excluir este lead permanentemente?"><?= Csrf::field() ?><button type="submit" class="button button-danger">Excluir lead</button></form>
            </div>
        </form>
    </div>
</div>
