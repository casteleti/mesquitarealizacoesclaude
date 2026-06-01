<?php
$statusLabels = Lead::STATUS;
$statusCores  = Lead::STATUS_CORES;
$rowClasses   = Lead::ROW_CLASSES;
?>
<div class="panel-head">
    <div class="panel-title">
        <h2>Leads</h2>
        <p>Contatos recebidos pelo formulário do site.</p>
    </div>
</div>

<div class="panel-filters">
    <form method="get" action="<?= e(url('admin/leads')) ?>">
        <label class="filter-label">Filtrar por status
            <select name="status" onchange="this.form.submit()">
                <option value="">Todos</option>
                <?php foreach ($statusLabels as $val => $label): ?>
                    <option value="<?= e((string) $val) ?>" <?= ((string)($status ?? '') === (string)$val) ? 'selected' : '' ?>><?= e($label) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </form>
</div>

<!-- Legenda do semáforo -->
<div class="lead-legend">
    <span class="lead-legend-item"><span class="lead-dot lead-dot-new"></span> Não lida</span>
    <span class="lead-legend-item"><span class="lead-dot lead-dot-read"></span> Lida</span>
    <span class="lead-legend-item"><span class="lead-dot lead-dot-replied"></span> Respondida</span>
</div>

<div class="panel table-wrap">
    <?php if (!$leads['data']): ?>
        <div class="empty-state"><strong>Nenhuma mensagem encontrada.</strong><p>Quando visitantes enviarem o formulário de contato, as mensagens aparecerão aqui.</p></div>
    <?php else: ?>
        <table class="leads-table">
            <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leads['data'] as $lead): ?>
                    <?php $rowClass = $rowClasses[$lead['status']] ?? ''; ?>
                    <tr class="<?= e($rowClass) ?>">
                        <td class="lead-status-dot-cell">
                            <span class="lead-dot lead-dot-<?= $lead['status'] === 1 ? 'new' : ($lead['status'] === 3 ? 'replied' : 'read') ?>"></span>
                        </td>
                        <td data-label="Nome">
                            <?php if ((int)$lead['status'] === 1): ?>
                                <strong><?= e($lead['nome']) ?></strong>
                            <?php else: ?>
                                <?= e($lead['nome']) ?>
                            <?php endif; ?>
                        </td>
                        <td data-label="E-mail"><?= e($lead['email']) ?></td>
                        <td data-label="Telefone"><?= e($lead['telefone']) ?></td>
                        <td data-label="Data"><?= e(date('d/m/Y H:i', strtotime($lead['created_at']))) ?></td>
                        <td data-label="Status">
                            <span class="badge <?= $statusCores[$lead['status']] ?? 'badge-muted' ?>">
                                <?= e($statusLabels[$lead['status']] ?? '-') ?>
                            </span>
                        </td>
                        <td data-label="Ações" class="actions lead-actions">
                            <a class="btn-table" href="<?= e(url('admin/leads/' . $lead['id'])) ?>">Ver</a>

                            <?php if ((int)$lead['status'] !== 3): ?>
                                <form method="post" action="<?= e(url('admin/leads/' . $lead['id'] . '/status')) ?>">
                                    <?= Csrf::field() ?>
                                    <input type="hidden" name="status" value="3">
                                    <button class="btn-table btn-table-success" title="Marcar como respondida">✓ Respondida</button>
                                </form>
                            <?php endif; ?>

                            <form method="post" action="<?= e(url('admin/leads/' . $lead['id'] . '/delete')) ?>" data-confirm="Excluir esta mensagem?">
                                <?= Csrf::field() ?>
                                <button class="btn-table btn-table-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($leads['last_page'] > 1): ?>
            <div class="pagination">
                <?php for ($p = 1; $p <= $leads['last_page']; $p++): ?>
                    <a href="?page=<?= $p ?>&status=<?= e((string)($status ?? '')) ?>" class="<?= $p === $leads['current_page'] ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>
</div>
