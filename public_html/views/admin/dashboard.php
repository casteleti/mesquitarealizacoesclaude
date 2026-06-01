<section class="dashboard-hero">
    <div>
        <span>Painel administrativo</span>
        <h1>Atualize o site com clareza e segurança.</h1>
        <p>Use os atalhos abaixo para editar as áreas principais, publicar obras e acompanhar contatos recebidos.</p>
    </div>
    <a class="button button-light" href="<?= e(url('')) ?>" target="_blank" rel="noopener">Ver site publicado</a>
</section>

<div class="metric-grid">
    <article><span>Obras cadastradas</span><strong><?= e((string) $stats['obras_total']) ?></strong></article>
    <article><span>Obras ativas</span><strong><?= e((string) $stats['obras_ativas']) ?></strong></article>
    <article><span>Setores ativos</span><strong><?= e((string) $stats['setores_ativos']) ?></strong></article>
    <article><span>Leads novos</span><strong><?= e((string) $stats['leads_novos']) ?></strong></article>
</div>

<div class="panel">
    <div class="panel-title">
        <h2>Atalhos rápidos</h2>
        <p>Acesse as áreas mais usadas sem procurar no menu.</p>
    </div>
    <div class="action-row quick-actions">
        <a class="button" href="<?= e(url('admin/paginas/home')) ?>">Editar Home</a>
        <a class="button button-light" href="<?= e(url('admin/obras/create')) ?>">Cadastrar obra</a>
        <a class="button button-light" href="<?= e(url('admin/setores/create')) ?>">Cadastrar setor</a>
    </div>
</div>

<div class="panel">
    <div class="panel-title">
        <h2>Mensagens recentes</h2>
        <p>Últimos contatos enviados pelo formulário do site.</p>
    </div>
    <?php if ($stats['leads_total'] === 0): ?>
        <div class="empty-state">
            <strong>Nenhuma mensagem recebida ainda.</strong>
            <p>Quando alguém enviar o formulário de contato, as mensagens aparecerão aqui.</p>
        </div>
    <?php else: ?>
        <p><a class="button button-light" href="<?= e(url('admin/leads')) ?>">Ver todas as mensagens (<?= e((string) $stats['leads_total']) ?>)</a></p>
    <?php endif; ?>
</div>
