<?php
$paginas = [
    'home'         => 'Home',
    'quem-somos'   => 'Quem Somos',
    'setores'      => 'Setores',
    'obras'        => 'Obras',
    'como-atuamos' => 'Como Atuamos',
    'contato'      => 'Contato',
];
?>
<div class="panel">
    <div class="panel-title">
        <h2>Páginas principais</h2>
        <p>Atalhos para revisar título e descrição de cada página.</p>
    </div>
    <div class="link-grid">
        <?php foreach ($paginas as $key => $label): ?>
            <a href="<?= e(url('admin/paginas/' . $key)) ?>"><span>Página</span><strong><?= e($label) ?></strong></a>
        <?php endforeach; ?>
    </div>
</div>

<div class="panel">
    <div class="panel-title">
        <h2>Conteúdos com SEO próprio</h2>
        <p>Setores e obras têm campos de SEO nos seus próprios formulários.</p>
    </div>
    <div class="link-grid">
        <?php foreach ($setores as $setor): ?>
            <a href="<?= e(url('admin/setores/' . $setor['id'] . '/edit')) ?>">
                <span>Setor</span><strong><?= e($setor['title']) ?></strong>
            </a>
        <?php endforeach; ?>
        <?php foreach ($obras as $obra): ?>
            <a href="<?= e(url('admin/obras/' . $obra['id'] . '/edit')) ?>">
                <span>Obra</span><strong><?= e($obra['title']) ?></strong>
            </a>
        <?php endforeach; ?>
    </div>
</div>
