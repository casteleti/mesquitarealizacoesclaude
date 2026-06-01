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
                    <svg class="footer-contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z"/></svg>
                    <span><?= nl2br(e($address)) ?></span>
                </p>
            <?php endif; ?>
            <?php if ($phoneDigits !== ''): ?>
                <a class="footer-contact-item" href="tel:<?= e($phoneDigits) ?>">
                    <svg class="footer-contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.17,1.4,8.12,8.12,0,0,0-.75.56L134.87,160c-15.42-7.49-31.34-23.29-38.83-38.51l20.78-24.71c.2-.25.39-.5.57-.77a16,16,0,0,0,1.32-15.06l0-.12L97.54,33.64a16,16,0,0,0-16.62-9.52A56.26,56.26,0,0,0,32,80c0,79.4,64.6,144,144,144a56.26,56.26,0,0,0,55.88-48.92A16,16,0,0,0,222.37,158.46ZM176,208A128.14,128.14,0,0,1,48,80,40.2,40.2,0,0,1,82.87,40a.61.61,0,0,0,0,.12l21,47L83.2,111.86a6.13,6.13,0,0,0-.57.77,16,16,0,0,0-1,15.7c9.06,18.53,27.73,37.06,46.46,46.11a16,16,0,0,0,15.75-1.14,8.44,8.44,0,0,0,.74-.56L168.89,152l47,21.05h0s.08,0,.11,0A40.21,40.21,0,0,1,176,208Z"/></svg>
                    <span><?= e($phone) ?></span>
                </a>
            <?php endif; ?>
            <?php if ($email !== ''): ?>
                <a class="footer-contact-item" href="mailto:<?= e($email) ?>">
                    <svg class="footer-contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48Zm-96,85.15L52.57,64H203.43ZM98.71,128,40,181.81V74.19Zm11.84,10.85,12,11.05a8,8,0,0,0,10.82,0l12-11.05,58,53.15H52.57ZM157.29,128,216,74.18V181.82Z"/></svg>
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
