<div class="panel-head">
    <div class="panel-title">
        <h2>Cards de gestão</h2>
        <p>Pilares de gestão exibidos na página Como Atuamos.</p>
    </div>
    <a class="button" href="<?= e(url('admin/gestao/create')) ?>">Novo card</a>
</div>

<div class="panel table-wrap">
    <?php if (!$items): ?>
        <div class="empty-state"><strong>Nenhum card cadastrado.</strong><p>Cadastre os pilares de gestão para exibi-los na página Como Atuamos.</p></div>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>Ícone</th><th>Título</th><th>Status</th><th>Posição</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td data-label="Ícone"><?= e($item['icone']) ?></td>
                        <td data-label="Título"><?= e($item['titulo']) ?></td>
                        <td data-label="Status"><span class="badge <?= $item['ativo'] ? 'badge-success' : 'badge-muted' ?>"><?= $item['ativo'] ? 'Ativo' : 'Oculto' ?></span></td>
                        <td data-label="Posição"><?= e((string) $item['ordem']) ?></td>
                        <td data-label="Ações" class="actions">
                            <a href="<?= e(url('admin/gestao/' . $item['id'] . '/edit')) ?>">Editar</a>
                            <form method="post" action="<?= e(url('admin/gestao/' . $item['id'] . '/toggle')) ?>"><?= Csrf::field() ?><button><?= $item['ativo'] ? 'Ocultar' : 'Publicar' ?></button></form>
                            <form method="post" action="<?= e(url('admin/gestao/' . $item['id'] . '/delete')) ?>" data-confirm="Excluir card?"><?= Csrf::field() ?><button>Excluir</button></form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
