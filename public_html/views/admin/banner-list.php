<div class="panel-head">
    <div class="panel-title">
        <h2>Banners</h2>
        <p>Gerencie os banners exibidos na Home do site.</p>
    </div>
    <a class="button" href="<?= e(url('admin/banners/create')) ?>">Novo banner</a>
</div>
<div class="panel table-wrap">
    <?php if (!$items): ?>
        <div class="empty-state"><strong>Nenhum banner cadastrado.</strong><p>Crie um banner para a seção principal da Home.</p></div>
    <?php else: ?>
        <table>
            <thead><tr><th>Título</th><th>Label</th><th>Status</th><th>Posição</th><th>Ações</th></tr></thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td data-label="Título"><?= e($item['headline']) ?></td>
                        <td data-label="Label"><?= e($item['label'] ?? '—') ?></td>
                        <td data-label="Status"><span class="badge <?= $item['ativo'] ? 'badge-success' : 'badge-muted' ?>"><?= $item['ativo'] ? 'Publicado' : 'Oculto' ?></span></td>
                        <td data-label="Posição"><?= $item['ordem'] ?></td>
                        <td data-label="Ações" class="actions">
                            <a href="<?= e(url('admin/banners/' . $item['id'] . '/edit')) ?>">Editar</a>
                            <form method="post" action="<?= e(url('admin/banners/' . $item['id'] . '/delete')) ?>" data-confirm="Remover banner?">
                                <?= Csrf::field() ?><button type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
