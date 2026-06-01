<article class="content-card work-card">
    <?php if (!empty($obra['imagem_principal'])): ?>
        <img src="<?= e(upload_url($obra['imagem_principal'])) ?>" alt="<?= e($obra['title']) ?>" loading="lazy" decoding="async" width="520" height="340">
    <?php else: ?>
        <div class="card-media-placeholder" aria-hidden="true"></div>
    <?php endif; ?>
    <div>
        <?php if (!empty($obra['setor_nome'])): ?>
            <span class="eyebrow"><?= e($obra['setor_nome']) ?></span>
        <?php endif; ?>
        <h3><?= e($obra['title']) ?></h3>
        <?php if (!empty($obra['subtitulo'])): ?>
            <p><?= e(truncate($obra['subtitulo'], 100)) ?></p>
        <?php endif; ?>
        <a class="text-link" href="<?= e(url('obras/' . $obra['slug'])) ?>">Ver obra</a>
    </div>
</article>
