<?php
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
if ($errors):
?>
<div class="form-errors">
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= e($error) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
