<?php
// $items = [['label' => 'Texto', 'url' => '...'], ...]  — último sem url
$items = $items ?? [];
if (!$items) return;
?>
<nav class="breadcrumb" aria-label="Você está em">
    <?php foreach ($items as $i => $item): ?>
        <?php if ($i > 0): ?><span aria-hidden="true">/</span><?php endif; ?>
        <?php if (!empty($item['url'])): ?>
            <a href="<?= e($item['url']) ?>"><?= e($item['label']) ?></a>
        <?php else: ?>
            <span aria-current="page"><?= e($item['label']) ?></span>
        <?php endif; ?>
    <?php endforeach; ?>
</nav>
