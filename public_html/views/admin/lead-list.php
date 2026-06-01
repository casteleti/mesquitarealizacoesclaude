<?php
$statusLabels = Lead::STATUS;
$statusColors = [1 => 'badge-warning', 2 => 'badge-muted', 3 => 'badge-info', 4 => 'badge-success', 5 => 'badge-danger'];
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

<div class="panel table-wrap">
    <?php if (!$leads['data']): ?>
        <div class="empty-state"><strong>Nenhum lead encontrado.</strong><p>Quando visitantes enviarem o formulário de contato, as mensagens aparecerão aqui.</p></div>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>Nome</th><th>Empresa</th><th>Tipo</th><th>Data</th><th>Status</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach ($leads['data'] as $lead): ?>
                    <tr>
                        <td data-label="Nome"><?= e($lead['nome']) ?></td>
                        <td data-label="Empresa"><?= e($lead['empresa']) ?></td>
                        <td data-label="Tipo"><?= e(Lead::TIPOS_PROJETO[$lead['tipo_projeto']] ?? $lead['tipo_projeto']) ?></td>
                        <td data-label="Data"><?= e(date('d/m/Y H:i', strtotime($lead['created_at']))) ?></td>
                        <td data-label="Status"><span class="badge <?= $statusColors[$lead['status']] ?? 'badge-muted' ?>"><?= e($statusLabels[$lead['status']] ?? '-') ?></span></td>
                        <td data-label="Ações" class="actions">
                            <a href="<?= e(url('admin/leads/' . $lead['id'])) ?>">Ver</a>
                            <form method="post" action="<?= e(url('admin/leads/' . $lead['id'] . '/delete')) ?>" data-confirm="Excluir este lead?"><?= Csrf::field() ?><button>Excluir</button></form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
