<?php

declare(strict_types=1);

class SitemapController extends Controller
{
    private function base(): string
    {
        $cfg = Configuracao::getAll();
        return rtrim($cfg['site_url'] ?? ('http://' . ($_SERVER['HTTP_HOST'] ?? 'localhost')), '/');
    }

    private function xmlHeader(): void
    {
        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    }

    private function urlTag(array $url): string
    {
        $out  = "  <url>\n";
        $out .= "    <loc>" . htmlspecialchars($url['loc'], ENT_XML1) . "</loc>\n";
        if (!empty($url['lastmod']))   $out .= "    <lastmod>{$url['lastmod']}</lastmod>\n";
        if (!empty($url['freq']))      $out .= "    <changefreq>{$url['freq']}</changefreq>\n";
        if (!empty($url['priority'])) $out .= "    <priority>{$url['priority']}</priority>\n";
        $out .= "  </url>\n";
        return $out;
    }

    // /sitemap.xml — índice com sub-sitemaps
    public function index(): void
    {
        $this->xmlHeader();
        $base = $this->base();
        $now  = date('Y-m-d');

        echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ([
            ['loc' => $base . '/sitemap-pages.xml',   'lastmod' => $now],
            ['loc' => $base . '/sitemap-obras.xml',   'lastmod' => $now],
            ['loc' => $base . '/sitemap-setores.xml', 'lastmod' => $now],
        ] as $sm) {
            echo "  <sitemap>\n";
            echo "    <loc>" . htmlspecialchars($sm['loc'], ENT_XML1) . "</loc>\n";
            echo "    <lastmod>{$sm['lastmod']}</lastmod>\n";
            echo "  </sitemap>\n";
        }
        echo '</sitemapindex>';
        exit;
    }

    // /sitemap-pages.xml — páginas estáticas
    public function pages(): void
    {
        $this->xmlHeader();
        $base = $this->base();

        $urls = [
            ['loc' => $base . '/',             'priority' => '1.0', 'freq' => 'weekly'],
            ['loc' => $base . '/quem-somos',   'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => $base . '/setores',      'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => $base . '/obras',        'priority' => '0.9', 'freq' => 'weekly'],
            ['loc' => $base . '/como-atuamos', 'priority' => '0.8', 'freq' => 'monthly'],
            ['loc' => $base . '/contato',      'priority' => '0.7', 'freq' => 'yearly'],
        ];

        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $url) echo $this->urlTag($url);
        echo '</urlset>';
        exit;
    }

    // /sitemap-obras.xml — obras ativas
    public function obras(): void
    {
        $this->xmlHeader();
        $base  = $this->base();
        $obras = Obra::findAll('ativo = 1', [], 'updated_at DESC');

        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($obras as $obra) {
            echo $this->urlTag([
                'loc'      => $base . '/obras/' . $obra['slug'],
                'priority' => '0.7',
                'freq'     => 'monthly',
                'lastmod'  => $obra['updated_at'] ? date('Y-m-d', strtotime($obra['updated_at'])) : date('Y-m-d'),
            ]);
        }
        echo '</urlset>';
        exit;
    }

    // /sitemap-setores.xml — setores ativos
    public function setores(): void
    {
        $this->xmlHeader();
        $base    = $this->base();
        $setores = Setor::ativos();

        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($setores as $setor) {
            echo $this->urlTag([
                'loc'      => $base . '/setores/' . $setor['slug'],
                'priority' => '0.8',
                'freq'     => 'monthly',
                'lastmod'  => $setor['updated_at'] ? date('Y-m-d', strtotime($setor['updated_at'])) : date('Y-m-d'),
            ]);
        }
        echo '</urlset>';
        exit;
    }
}
