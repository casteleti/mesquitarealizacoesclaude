<div class="panel-head">
    <div class="panel-title">
        <h2>Usuários</h2>
        <p>Gerencie quem pode acessar o painel.</p>
    </div>
    <a class="button" href="<?= e(url('admin/usuarios/create')) ?>">Novo usuário</a>
</div>
<div class="panel table-wrap">
    <?php if (!$items): ?>
        <div class="empty-state"><strong>Nenhum usuário cadastrado.</strong></div>
    <?php else: ?>
        <table>
            <thead><tr><th>Nome</th><th>E-mail</th><th>Cadastrado em</th><th>Ações</th></tr></thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td data-label="Nome"><?= e($item['name']) ?></td>
                        <td data-label="E-mail"><?= e($item['email']) ?></td>
                        <td data-label="Cadastrado em"><?= e(date_br($item['created_at'] ?? '')) ?></td>
                        <td data-label="Ações" class="actions">
                            <a href="<?= e(url('admin/usuarios/' . $item['id'] . '/edit')) ?>">Editar</a>
                            <form method="post" action="<?= e(url('admin/usuarios/' . $item['id'] . '/delete')) ?>" data-confirm="Remover usuário?">
                                <?= Csrf::field() ?><button type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
