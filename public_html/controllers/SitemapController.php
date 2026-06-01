<?php

declare(strict_types=1);

class SitemapController extends Controller
{
    public function index(): void
    {
        header('Content-Type: application/xml; charset=utf-8');

        $cfg    = Configuracao::getAll();
        $base   = rtrim($cfg['site_url'] ?? ('http://' . ($_SERVER['HTTP_HOST'] ?? 'localhost')), '/');
        $obras  = Obra::findAll('ativo = 1', [], 'updated_at DESC');
        $setores = Setor::ativos();

        $urls = [
            ['loc' => $base . '/',              'priority' => '1.0', 'freq' => 'weekly'],
            ['loc' => $base . '/quem-somos',    'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => $base . '/setores',       'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => $base . '/obras',         'priority' => '0.9', 'freq' => 'weekly'],
            ['loc' => $base . '/como-atuamos',  'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => $base . '/contato',       'priority' => '0.7', 'freq' => 'yearly'],
        ];

        foreach ($obras as $obra) {
            $urls[] = [
                'loc'      => $base . '/obras/' . $obra['slug'],
                'priority' => '0.7',
                'freq'     => 'monthly',
                'lastmod'  => $obra['updated_at'] ? date('Y-m-d', strtotime($obra['updated_at'])) : date('Y-m-d'),
            ];
        }

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $url) {
            echo '  <url>' . "\n";
            echo '    <loc>' . e($url['loc']) . '</loc>' . "\n";
            if (!empty($url['lastmod'])) {
                echo '    <lastmod>' . $url['lastmod'] . '</lastmod>' . "\n";
            }
            echo '    <changefreq>' . $url['freq'] . '</changefreq>' . "\n";
            echo '    <priority>' . $url['priority'] . '</priority>' . "\n";
            echo '  </url>' . "\n";
        }
        echo '</urlset>';
        exit;
    }
}
