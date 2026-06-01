<div class="panel-head">
    <div class="panel-title">
        <h2>Setores</h2>
        <p>Organize os segmentos atendidos e a ordem em que aparecem no site.</p>
    </div>
    <a class="button" href="<?= e(url('admin/setores/create')) ?>">Novo setor</a>
</div>

<div class="panel table-wrap">
    <?php if (!$items): ?>
        <div class="empty-state"><strong>Nenhum setor cadastrado ainda.</strong><p>Cadastre o primeiro setor para apresentar as áreas de atuação.</p></div>
    <?php else: ?>
        <table>
            <thead><tr><th>Nome</th><th>URL amigável</th><th>Obras</th><th>Status</th><th>Posição</th><th>Ações</th></tr></thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <?php $worksCount = (int) ($item['works_count'] ?? 0); ?>
                    <tr>
                        <td data-label="Nome"><?= e($item['name']) ?></td>
                        <td data-label="URL amigável"><?= e($item['slug']) ?></td>
                        <td data-label="Obras"><?= e((string) $worksCount) ?></td>
                        <td data-label="Status"><span class="badge <?= $item['is_active'] ? 'badge-success' : 'badge-muted' ?>"><?= $item['is_active'] ? 'Publicado' : 'Oculto' ?></span></td>
                        <td data-label="Posição"><?= e((string) $item['sort_order']) ?></td>
                        <td data-label="Ações" class="actions">
                            <a href="<?= e(url('admin/setores/' . $item['id'] . '/edit')) ?>">Editar</a>
                            <?php if ($worksCount > 0): ?>
                                <span class="action-muted" title="Este setor possui obras relacionadas. Reatribua as obras antes de excluir.">Excluir bloqueado</span>
                            <?php else: ?>
                                <form method="post" action="<?= e(url('admin/setores/' . $item['id'] . '/delete')) ?>" data-confirm="Remover setor?"><?= Csrf::field() ?><button>Excluir</button></form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
