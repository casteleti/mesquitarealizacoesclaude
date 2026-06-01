<article class="content-card setor-card">
    <?php if (!empty($setor['imagem'])): ?>
        <img src="<?= e(upload_url($setor['imagem'])) ?>" alt="<?= e($setor['title']) ?>" loading="lazy" decoding="async" width="520" height="340">
    <?php else: ?>
        <div class="card-media-placeholder" aria-hidden="true"></div>
    <?php endif; ?>
    <div>
        <h3><?= e($setor['titulo_home'] ?: $setor['title']) ?></h3>
        <?php if (!empty($setor['descricao_curta'])): ?>
            <p><?= e($setor['descricao_curta']) ?></p>
        <?php endif; ?>
        <a class="text-link" href="<?= e(url('setores/' . $setor['slug'])) ?>"><?= e($setor['botao_texto'] ?: 'Ver setor') ?></a>
    </div>
</article>
