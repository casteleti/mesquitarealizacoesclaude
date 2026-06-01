<form class="panel form-grid" method="post" enctype="multipart/form-data" action="<?= e(url('admin/paginas/quem-somos')) ?>">
<?= Csrf::field() ?>
<input type="hidden" name="hero_imagem_atual" value="<?= e($campos['hero_imagem'] ?? '') ?>">

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Hero da página</h2>
        <p>Cabeçalho exibido no topo da página Quem Somos.</p>
    </div>
    <label>Título
        <input name="hero_titulo" value="<?= e($campos['hero_titulo'] ?? '') ?>" maxlength="150" placeholder="Quem Somos">
    </label>
    <label class="full">Subtítulo
        <input name="hero_subtitulo" value="<?= e($campos['hero_subtitulo'] ?? '') ?>" maxlength="200">
    </label>
    <label>Imagem de fundo do banner
        <input type="file" name="hero_imagem" accept="image/jpeg,image/png,image/webp" data-preview-input>
        <small class="field-help">Opcional. JPG, PNG ou WebP. Recomendado: 1600x600px horizontal.</small>
    </label>
    <?php if (!empty($campos['hero_imagem'])): ?>
        <img class="image-preview image-preview-wide" data-preview src="<?= e(upload_url($campos['hero_imagem'])) ?>" alt="Banner atual">
    <?php else: ?>
        <img class="image-preview image-preview-wide" data-preview hidden alt="Preview">
    <?php endif; ?>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Sobre a empresa</h2>
        <p>Apresentação institucional principal. Dois ou três parágrafos sobre a Mesquita Realizações.</p>
    </div>
    <label class="full">Texto
        <textarea name="sobre_texto" rows="8"><?= e($campos['sobre_texto'] ?? '') ?></textarea>
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Missão e visão</h2>
        <p>Blocos exibidos ao lado do texto principal.</p>
    </div>
    <label>Título do bloco missão
        <input name="missao_titulo" value="<?= e($campos['missao_titulo'] ?? 'Missão') ?>" maxlength="80">
    </label>
    <label class="full">Texto da missão
        <textarea name="missao_texto" rows="3"><?= e($campos['missao_texto'] ?? '') ?></textarea>
    </label>
    <label>Título do bloco visão
        <input name="visao_titulo" value="<?= e($campos['visao_titulo'] ?? 'Visão') ?>" maxlength="80">
    </label>
    <label class="full">Texto da visão
        <textarea name="visao_texto" rows="3"><?= e($campos['visao_texto'] ?? '') ?></textarea>
    </label>
</div>

<div class="form-actions"><button class="button" type="submit">Salvar</button></div>
</form>
