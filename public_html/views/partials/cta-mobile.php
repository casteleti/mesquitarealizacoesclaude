<?php
$whatsapp = trim((string) ($settings['whatsapp'] ?? $config['whatsapp'] ?? ''));
$phone    = trim((string) ($settings['telefone'] ?? $config['telefone'] ?? ''));
if (!$whatsapp && !$phone) return;
$waHref    = $whatsapp ? 'https://wa.me/' . preg_replace('/\D+/', '', $whatsapp) : '';
$phoneHref = $phone ? 'tel:' . preg_replace('/\D+/', '', $phone) : '';
?>
<div class="cta-mobile" aria-label="Canais de contato rápido">
    <?php if ($waHref): ?>
        <a class="cta-mobile-btn cta-mobile-wa" href="<?= e($waHref) ?>" target="_blank" rel="noopener">
            <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false" width="20" height="20" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                <path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.558 4.122 1.532 5.857L.057 23.804a.5.5 0 0 0 .61.635l6.157-1.615A11.94 11.94 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 0 1-5.015-1.378l-.36-.214-3.727.977 1.003-3.642-.234-.374A9.818 9.818 0 0 1 2.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/>
            </svg>
            WhatsApp
        </a>
    <?php endif; ?>
    <?php if ($phoneHref): ?>
        <a class="cta-mobile-btn cta-mobile-phone" href="<?= e($phoneHref) ?>">
            <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.91a16 16 0 0 0 6 6l.9-.9a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>
            Ligar
        </a>
    <?php endif; ?>
</div>
