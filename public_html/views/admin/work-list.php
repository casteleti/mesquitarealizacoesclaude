<div class="panel-head">
    <div class="panel-title">
        <h2>Obras</h2>
        <p>Cadastre projetos, relacione setores e destaque obras importantes na Home.</p>
    </div>
    <a class="button" href="<?= e(url('admin/obras/create')) ?>">Nova obra</a>
</div>
<div class="panel table-wrap">
    <?php if (!$items): ?>
        <div class="empty-state"><strong>Nenhuma obra cadastrada ainda.</strong><p>Cadastre uma obra para começar a montar o portfólio técnico.</p></div>
    <?php else: ?>
        <table>
            <thead><tr><th>Nome</th><th>Setor</th><th>Status</th><th>Destaque</th><th>Ações</th></tr></thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td data-label="Nome"><?= e($item['name']) ?></td>
                        <td data-label="Setor"><?= e($item['sector_name'] ?? '') ?></td>
                        <td data-label="Status"><span class="badge <?= $item['is_active'] ? 'badge-success' : 'badge-muted' ?>"><?= $item['is_active'] ? 'Publicado' : 'Oculto' ?></span></td>
                        <td data-label="Destaque"><?= $item['is_featured'] ? '<span class="badge badge-gold">Sim</span>' : '<span class="badge badge-muted">Não</span>' ?></td>
                        <td data-label="Ações" class="actions"><a href="<?= e(url('admin/obras/' . $item['id'] . '/edit')) ?>">Editar</a><form method="post" action="<?= e(url('admin/obras/' . $item['id'] . '/delete')) ?>" data-confirm="Remover obra?"><?= Csrf::field() ?><button>Excluir</button></form></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
