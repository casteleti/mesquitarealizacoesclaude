<?php $adminPath = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '', '/'); ?>
<?php
$adminActive = static function (string $path) use ($adminPath): string {
    return $adminPath === $path || str_starts_with($adminPath, $path . '/') ? 'is-active' : '';
};
?>
<aside class="admin-sidebar" data-admin-sidebar>
    <a class="admin-brand" href="<?= e(url('admin/dashboard')) ?>"><?= e(config('name')) ?></a>
    <nav>
        <span>Visão geral</span>
        <a class="<?= $adminActive('admin/dashboard') ?>" href="<?= e(url('admin/dashboard')) ?>">Dashboard</a>
        <a class="<?= $adminActive('admin/leads') ?>" href="<?= e(url('admin/leads')) ?>">Leads</a>

        <span>Conteúdo do site</span>
        <a class="<?= $adminActive('admin/banners') ?>" href="<?= e(url('admin/banners')) ?>">Banners</a>
        <a class="<?= $adminActive('admin/paginas/home') ?>" href="<?= e(url('admin/paginas/home')) ?>">Home</a>
        <a class="<?= $adminActive('admin/paginas/quem-somos') ?>" href="<?= e(url('admin/paginas/quem-somos')) ?>">Quem Somos</a>
        <a class="<?= $adminActive('admin/paginas/como-atuamos') ?>" href="<?= e(url('admin/paginas/como-atuamos')) ?>">Como Atuamos</a>
        <a class="<?= $adminActive('admin/paginas/contato') ?>" href="<?= e(url('admin/paginas/contato')) ?>">Contato</a>

        <span>Portfólio</span>
        <a class="<?= $adminActive('admin/setores') ?>" href="<?= e(url('admin/setores')) ?>">Setores</a>
        <a class="<?= $adminActive('admin/setores-destaque') ?>" href="<?= e(url('admin/setores-destaque')) ?>">Destaque na Home</a>
        <a class="<?= $adminActive('admin/obras') ?>" href="<?= e(url('admin/obras')) ?>">Obras</a>

        <span>Diferenciais e valores</span>
        <a class="<?= $adminActive('admin/diferenciais') ?>" href="<?= e(url('admin/diferenciais')) ?>">Diferenciais</a>
        <a class="<?= $adminActive('admin/valores') ?>" href="<?= e(url('admin/valores')) ?>">Valores</a>
        <a class="<?= $adminActive('admin/processo') ?>" href="<?= e(url('admin/processo')) ?>">Como Atuamos (etapas)</a>
        <a class="<?= $adminActive('admin/gestao') ?>" href="<?= e(url('admin/gestao')) ?>">Gestão</a>

        <span>Otimização</span>
        <a class="<?= $adminActive('admin/seo') ?>" href="<?= e(url('admin/seo')) ?>">SEO</a>

        <?php if (Auth::check()): ?>
            <span>Sistema</span>
            <a class="<?= $adminActive('admin/configuracoes') ?>" href="<?= e(url('admin/configuracoes')) ?>">Configurações</a>
            <a class="<?= $adminActive('admin/usuarios') ?>" href="<?= e(url('admin/usuarios')) ?>">Usuários</a>
        <?php endif; ?>
        <a class="nav-exit" href="<?= e(url('admin/logout')) ?>">Sair</a>
    </nav>
</aside>
