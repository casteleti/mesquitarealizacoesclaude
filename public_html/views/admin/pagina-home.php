<form class="panel form-grid" method="post" enctype="multipart/form-data" action="<?= e(url('admin/paginas/home')) ?>">
<?= Csrf::field() ?>


<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Seção institucional</h2>
        <p>Texto de apresentação da empresa logo abaixo do hero.</p>
    </div>
    <label>Headline
        <input name="intro_titulo" value="<?= e($campos['intro_titulo'] ?? '') ?>" maxlength="100" placeholder="Controle técnico para obras industriais.">
        <small class="field-help">Título em destaque à esquerda da seção. Deixe vazio para usar o texto padrão.</small>
    </label>
    <label class="full">Texto
        <textarea name="intro_texto" rows="5"><?= e($campos['intro_texto'] ?? '') ?></textarea>
        <small class="field-help">Dois ou três parágrafos sobre a empresa. Linguagem técnica e direta.</small>
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Seção "Por que confiar"</h2>
        <p>Eyebrow e título da seção de diferenciais na home. Os itens são gerenciados em <a href="<?= e(url('admin/diferenciais')) ?>">Diferenciais</a>.</p>
    </div>
    <label>Eyebrow (texto vermelho acima do título)
        <input name="confiar_eyebrow" value="<?= e($campos['confiar_eyebrow'] ?? '') ?>" maxlength="40" placeholder="Por que confiar">
        <small class="field-help">Máx. 40 caracteres. Deixe vazio para usar o texto padrão.</small>
    </label>
    <label class="full">Título da seção
        <input name="confiar_titulo" value="<?= e($campos['confiar_titulo'] ?? '') ?>" maxlength="100" placeholder="Uma atuação orientada por clareza, presença e previsibilidade.">
        <small class="field-help">Máx. 100 caracteres. Deixe vazio para usar o texto padrão.</small>
    </label>
</div>

<div class="form-section form-section-open">
    <div class="section-label">
        <h2>Seção CTA final</h2>
        <p>Chamada para ação no final da página home.</p>
    </div>
    <label>Título do CTA
        <input name="cta_titulo" value="<?= e($campos['cta_titulo'] ?? '') ?>" maxlength="100">
    </label>
    <label class="full">Texto do CTA
        <textarea name="cta_texto" rows="3"><?= e($campos['cta_texto'] ?? '') ?></textarea>
    </label>
</div>

<div class="form-actions"><button class="button" type="submit">Salvar</button></div>
</form>
