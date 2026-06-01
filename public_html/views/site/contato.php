<?php
$title      = trim((string) ($pagina['hero_titulo']    ?? 'Fale Conosco'));
$subtitle   = trim((string) ($pagina['hero_subtitulo'] ?? ''));
$heroImagem = trim((string) ($pagina['hero_imagem']    ?? ''));
$phone      = trim((string) ($config['telefone']       ?? ''));
$whatsapp  = trim((string) ($config['whatsapp']       ?? ''));
$email     = trim((string) ($config['email']          ?? ''));
$address   = trim((string) ($config['endereco']       ?? ''));
$mapsEmbed = trim((string) ($config['maps_embed']     ?? ''));

$phoneDigits    = preg_replace('/\D+/', '', $phone);
$whatsappDigits = preg_replace('/\D+/', '', $whatsapp);
$whatsappHref   = $whatsappDigits !== '' ? 'https://wa.me/' . $whatsappDigits : '';
$mapsSearch     = $address !== '' ? 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($address) : '';
?>

<section class="page-hero" <?= page_hero_style($heroImagem) ?>>
    <div class="container page-hero-grid">
        <div class="page-hero-copy">
            <span class="eyebrow">Contato</span>
            <h1><?= e($title ?: 'Fale Conosco') ?></h1>
            <?php if ($subtitle): ?>
                <p><?= e($subtitle) ?></p>
            <?php else: ?>
                <p>Compartilhe o contexto do seu projeto para receber um retorno objetivo sobre escopo e próximos passos.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section contact-section">
    <div class="container contact-layout">

        <!-- Lado esquerdo: informações de contato -->
        <div class="contact-info">
            <span class="eyebrow">Canais diretos</span>
            <h2>Fale com a<br>Mesquita Realizações.</h2>
            <p class="contact-intro">Envie uma mensagem pelo formulário ou use um dos canais abaixo para falar diretamente com a equipe.</p>

            <ul class="contact-channel-list">
                <?php if ($phone || $whatsapp): ?>
                <li class="contact-channel">
                    <span class="contact-channel-icon">
                        <img src="<?= e(asset('icons/phone-call.svg')) ?>" alt="" width="16" height="16" aria-hidden="true">
                    </span>
                    <div>
                        <span class="contact-channel-label">Telefone</span>
                        <?php if ($phone): ?>
                            <a class="contact-channel-value" href="tel:<?= e($phoneDigits) ?>"><?= e($phone) ?></a>
                        <?php endif; ?>
                        <?php if ($whatsapp): ?>
                            <a class="contact-channel-value contact-channel-wa" href="<?= e($whatsappHref) ?>" target="_blank" rel="noopener">
                                WhatsApp: <?= e($whatsapp) ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endif; ?>

                <?php if ($email): ?>
                <li class="contact-channel">
                    <span class="contact-channel-icon">
                        <img src="<?= e(asset('icons/o-email.svg')) ?>" alt="" width="16" height="16" aria-hidden="true">
                    </span>
                    <div>
                        <span class="contact-channel-label">E-mail</span>
                        <a class="contact-channel-value" href="mailto:<?= e($email) ?>"><?= e($email) ?></a>
                    </div>
                </li>
                <?php endif; ?>

                <?php if ($address): ?>
                <li class="contact-channel">
                    <span class="contact-channel-icon">
                        <img src="<?= e(asset('icons/localizacao.svg')) ?>" alt="" width="16" height="16" aria-hidden="true">
                    </span>
                    <div>
                        <span class="contact-channel-label">Endereço</span>
                        <?php if ($mapsSearch): ?>
                            <a class="contact-channel-value" href="<?= e($mapsSearch) ?>" target="_blank" rel="noopener"><?= nl2br(e($address)) ?></a>
                        <?php else: ?>
                            <span class="contact-channel-value"><?= nl2br(e($address)) ?></span>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Lado direito: formulário -->
        <div class="contact-form-wrap">
            <form class="contact-form-card" id="contact-form" method="post" action="<?= e(url('contato')) ?>" novalidate>
                <?= Csrf::field() ?>
                <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

                <div class="form-heading">
                    <span class="eyebrow">Mensagem</span>
                    <h3>Envie sua demanda</h3>
                </div>

                <div class="contact-form-fields">
                    <label class="contact-label">
                        <span>Nome</span>
                        <input name="nome" type="text" required autocomplete="name" value="<?= e(old('nome')) ?>" placeholder="Seu nome completo">
                    </label>
                    <label class="contact-label">
                        <span>E-mail</span>
                        <input name="email" type="email" required autocomplete="email" value="<?= e(old('email')) ?>" placeholder="seu@email.com">
                    </label>
                    <label class="contact-label">
                        <span>Telefone</span>
                        <input name="telefone" type="tel" required autocomplete="tel" value="<?= e(old('telefone')) ?>" placeholder="(00) 00000-0000">
                    </label>
                    <label class="contact-label contact-label-full">
                        <span>Mensagem</span>
                        <textarea name="mensagem" rows="5" required placeholder="Descreva brevemente sua demanda ou projeto..."><?= e(old('mensagem')) ?></textarea>
                    </label>
                </div>

                <div id="form-result" role="alert" aria-live="polite"></div>
                <button class="button contact-submit" type="submit">Enviar mensagem</button>
            </form>
        </div>

    </div>
</section>

<?php
// Google Maps: usa iframe configurado no painel, ou fallback embed pelo endereço
$hasMap = $mapsEmbed !== '' || $mapsSearch !== '';
?>
<?php if ($hasMap): ?>
<section class="contact-maps">
    <?php if ($mapsEmbed !== ''): ?>
        <iframe
            src="<?= e($mapsEmbed) ?>"
            width="100%" height="380"
            style="border:0;display:block"
            allowfullscreen loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Localização Mesquita Realizações">
        </iframe>
    <?php else: ?>
        <a class="contact-maps-fallback" href="<?= e($mapsSearch) ?>" target="_blank" rel="noopener">
            <span>Ver no Google Maps</span>
            <span class="contact-maps-address"><?= nl2br(e($address)) ?></span>
        </a>
    <?php endif; ?>
</section>
<?php endif; ?>
