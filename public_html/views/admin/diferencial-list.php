<div class="panel-head">
    <div class="panel-title">
        <h2>Diferenciais</h2>
        <p>Destaque os aspectos práticos que diferenciam a Mesquita na execução de obras.</p>
    </div>
    <a class="button" href="<?= e(url('admin/diferenciais/create')) ?>">Novo diferencial</a>
</div>

<div class="panel table-wrap">
    <?php if (!$items): ?>
        <div class="empty-state"><strong>Nenhum diferencial cadastrado.</strong><p>Cadastre diferenciais para exibir na home e na página Quem Somos.</p></div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Exibir em</th>
                    <th>Status</th>
                    <th>Posição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $exibirLabels = [1 => 'Home', 2 => 'Quem Somos', 3 => 'Ambas'];
                foreach ($items as $item):
                ?>
                    <tr>
                        <td data-label="Título"><?= e($item['titulo']) ?></td>
                        <td data-label="Exibir em"><?= e($exibirLabels[$item['exibir_em']] ?? '-') ?></td>
                        <td data-label="Status"><span class="badge <?= $item['ativo'] ? 'badge-success' : 'badge-muted' ?>"><?= $item['ativo'] ? 'Ativo' : 'Oculto' ?></span></td>
                        <td data-label="Posição"><?= e((string) $item['ordem']) ?></td>
                        <td data-label="Ações" class="actions">
                            <a href="<?= e(url('admin/diferenciais/' . $item['id'] . '/edit')) ?>">Editar</a>
                            <form method="post" action="<?= e(url('admin/diferenciais/' . $item['id'] . '/toggle')) ?>"><?= Csrf::field() ?><button><?= $item['ativo'] ? 'Ocultar' : 'Publicar' ?></button></form>
                            <form method="post" action="<?= e(url('admin/diferenciais/' . $item['id'] . '/delete')) ?>" data-confirm="Excluir diferencial?"><?= Csrf::field() ?><button>Excluir</button></form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
