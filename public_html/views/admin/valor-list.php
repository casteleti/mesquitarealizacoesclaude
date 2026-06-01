<div class="panel-head">
    <div class="panel-title">
        <h2>Valores institucionais</h2>
        <p>Princípios que orientam a postura técnica e a cultura da empresa.</p>
    </div>
    <a class="button" href="<?= e(url('admin/valores/create')) ?>">Novo valor</a>
</div>

<div class="panel table-wrap">
    <?php if (!$items): ?>
        <div class="empty-state"><strong>Nenhum valor cadastrado.</strong><p>Cadastre os valores institucionais para exibi-los na página Quem Somos.</p></div>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>Título</th><th>Resumo</th><th>Status</th><th>Posição</th><th>Ações</th></tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td data-label="Título"><?= e($item['titulo']) ?></td>
                        <td data-label="Resumo"><?= e(truncate($item['resumo'] ?? $item['texto'] ?? '', 60)) ?></td>
                        <td data-label="Status"><span class="badge <?= $item['ativo'] ? 'badge-success' : 'badge-muted' ?>"><?= $item['ativo'] ? 'Ativo' : 'Oculto' ?></span></td>
                        <td data-label="Posição"><?= e((string) $item['ordem']) ?></td>
                        <td data-label="Ações" class="actions">
                            <a href="<?= e(url('admin/valores/' . $item['id'] . '/edit')) ?>">Editar</a>
                            <form method="post" action="<?= e(url('admin/valores/' . $item['id'] . '/toggle')) ?>"><?= Csrf::field() ?><button><?= $item['ativo'] ? 'Ocultar' : 'Publicar' ?></button></form>
                            <form method="post" action="<?= e(url('admin/valores/' . $item['id'] . '/delete')) ?>" data-confirm="Excluir valor?"><?= Csrf::field() ?><button>Excluir</button></form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
