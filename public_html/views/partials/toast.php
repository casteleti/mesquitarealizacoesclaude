<?php
// Renders flash messages as dismissible toasts
// Called in layout or per-page; uses session flash keys: success, error, warning, info
$messages = flash();
if (!$messages) return;
?>
<div class="toast-stack" role="status" aria-live="polite">
    <?php foreach ($messages as $type => $text): ?>
        <div class="toast toast-<?= e($type) ?>" data-toast>
            <span><?= e($text) ?></span>
            <button type="button" class="toast-close" aria-label="Fechar" data-toast-close>&times;</button>
        </div>
    <?php endforeach; ?>
</div>
