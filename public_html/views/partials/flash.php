<?php foreach (flash() as $type => $message): ?>
    <div class="alert alert-<?= e($type) ?>"><?= e($message) ?></div>
<?php endforeach; ?>
