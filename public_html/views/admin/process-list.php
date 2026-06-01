<div class="panel-head">
    <div class="panel-title">
        <h2>Etapas do processo</h2>
        <p>Gerencie as etapas exibidas na página Como Atuamos.</p>
    </div>
    <a class="button" href="<?= e(url('admin/processo/create')) ?>">Nova etapa</a>
</div>

<div class="panel table-wrap">
    <?php if (!$items): ?>
        <div class="empty-state"><strong>Nenhuma etapa cadastrada.</strong><p>Cadastre as etapas do processo para exibi-las na página Como Atuamos.</p></div>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>Nº</th><th>Título</th><th>Status</th><th>Posição</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td data-label="Nº"><?= e($item['numero']) ?></td>
                        <td data-label="Título"><?= e($item['titulo']) ?></td>
                        <td data-label="Status"><span class="badge <?= $item['ativo'] ? 'badge-success' : 'badge-muted' ?>"><?= $item['ativo'] ? 'Ativo' : 'Oculto' ?></span></td>
                        <td data-label="Posição"><?= e((string) $item['ordem']) ?></td>
                        <td data-label="Ações" class="actions">
                            <a href="<?= e(url('admin/processo/' . $item['id'] . '/edit')) ?>">Editar</a>
                            <form method="post" action="<?= e(url('admin/processo/' . $item['id'] . '/toggle')) ?>"><?= Csrf::field() ?><button><?= $item['ativo'] ? 'Ocultar' : 'Publicar' ?></button></form>
                            <form method="post" action="<?= e(url('admin/processo/' . $item['id'] . '/delete')) ?>" data-confirm="Excluir etapa?"><?= Csrf::field() ?><button>Excluir</button></form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
