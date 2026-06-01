<?php
$footerSectors = [];
try {
    $footerSectors = Setor::ativos();
} catch (Throwable $e) {
    error_log($e->getMessage());
}

$phone    = (string) ($settings['telefone'] ?? '');
$whatsapp = (string) ($settings['whatsapp'] ?? '');
$email    = (string) ($settings['email'] ?? '');
$address  = (string) ($settings['endereco'] ?? '');

$phoneDigits    = preg_replace('/\D+/', '', $phone);
$whatsappDigits = preg_replace('/\D+/', '', $whatsapp);

// Ícones sociais — sempre exibidos; href fica '#' se URL não configurada
$socialLinks = [
    'linkedin'  => ['label' => 'LinkedIn',  'url' => $settings['linkedin']  ?? '', 'icon' => 'linkedin.svg'],
    'instagram' => ['label' => 'Instagram', 'url' => $settings['instagram'] ?? '', 'icon' => 'instagram.svg'],
    'facebook'  => ['label' => 'Facebook',  'url' => $settings['facebook']  ?? '', 'icon' => 'facebook.svg'],
];

if ($whatsappDigits !== '') {
    $socialLinks['whatsapp'] = ['label' => 'WhatsApp', 'url' => 'https://wa.me/' . $whatsappDigits, 'icon' => 'whatsapp.svg'];
}

$hasSocial = true; // sempre mostrar bloco de ícones
$footerText = trim((string) ($settings['footer_text'] ?? ''));
if ($footerText === '') {
    $footerText = 'Construção de obras industriais e de infraestrutura para empresas que precisam ampliar ou implantar operações produtivas.';
}
?>

<footer class="site-footer" role="contentinfo">
    <div class="container footer-grid">
        <div class="footer-company">
            <a class="footer-brand" href="<?= e(url('/')) ?>" aria-label="Mesquita Realizações - Página inicial">
                <img class="footer-logo" src="<?= e(asset('images/logo-branco.svg')) ?>" alt="Mesquita Realizações" width="220" height="55" loading="lazy">
            </a>
            <p class="footer-text"><?= e($footerText) ?></p>

            <div class="footer-social" aria-label="Redes sociais">
                <?php foreach ($socialLinks as $social): ?>
                    <?php
                        $href      = trim((string) $social['url']) !== '' ? $social['url'] : '#';
                        $external  = $href !== '#';
                    ?>
                    <a class="footer-social-icon"
                       href="<?= e($href) ?>"
                       <?= $external ? 'target="_blank" rel="noopener noreferrer"' : '' ?>
                       aria-label="<?= e($social['label']) ?> da Mesquita Realizações">
                        <img src="<?= e(asset('icons/' . $social['icon'])) ?>"
                             alt="<?= e($social['label']) ?>"
                             width="26" height="26" loading="lazy">
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <nav class="footer-column" aria-label="Navegação do rodapé">
            <span>Navegação</span>
            <a href="<?= e(url('/')) ?>">Home</a>
            <a href="<?= e(url('quem-somos')) ?>">Quem Somos</a>
            <a href="<?= e(url('setores')) ?>">Setores</a>
            <a href="<?= e(url('obras')) ?>">Obras</a>
            <a href="<?= e(url('como-atuamos')) ?>">Como Atuamos</a>
            <a href="<?= e(url('contato')) ?>">Contato</a>
        </nav>

        <div class="footer-column">
            <span>Setores</span>
            <?php if (!empty($footerSectors)): ?>
                <?php foreach (array_slice($footerSectors, 0, 6) as $setor): ?>
                    <a href="<?= e(url('setores/' . $setor['slug'])) ?>"><?= e($setor['title']) ?></a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Segmentos atendidos com planejamento técnico e execução responsável.</p>
            <?php endif; ?>
        </div>

        <address class="footer-column footer-contact">
            <span>Contato</span>
            <?php if ($address !== ''): ?>
                <p class="footer-contact-item">
                    <img class="footer-contact-icon" src="<?= e(asset('icons/localizacao.svg')) ?>" alt="" aria-hidden="true" width="16" height="16">
                    <span><?= nl2br(e($address)) ?></span>
                </p>
            <?php endif; ?>
            <?php if ($phoneDigits !== ''): ?>
                <a class="footer-contact-item" href="tel:<?= e($phoneDigits) ?>">
                    <img class="footer-contact-icon" src="<?= e(asset('icons/phone-call.svg')) ?>" alt="" aria-hidden="true" width="16" height="16">
                    <span><?= e($phone) ?></span>
                </a>
            <?php endif; ?>
            <?php if ($email !== ''): ?>
                <a class="footer-contact-item" href="mailto:<?= e($email) ?>">
                    <img class="footer-contact-icon" src="<?= e(asset('icons/o-email.svg')) ?>" alt="" aria-hidden="true" width="16" height="16">
                    <span><?= e($email) ?></span>
                </a>
            <?php endif; ?>
        </address>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <span>&copy; <?= date('Y') ?> <?= e($settings['nome'] ?? config('name')) ?>. Todos os direitos reservados.</span>
        </div>
    </div>
</footer>
