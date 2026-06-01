<?php

declare(strict_types=1);

class Seo
{
    private static array $defaults = [
        'title'       => 'Mesquita Realizações',
        'description' => 'Construção industrial e infraestrutura para obras de grande porte.',
        'robots'      => 'index, follow',
        'og_type'     => 'website',
        'og_image'    => '/assets/images/og-default.jpg',
        'site_name'   => 'Mesquita Realizações',
    ];

    public static function meta(array $data = []): array
    {
        $d = array_merge(self::$defaults, $data);

        $title = $d['title'];
        if ($title !== self::$defaults['title']) {
            $title .= ' | Mesquita Realizações';
        }

        return [
            'title'          => $title,
            'description'    => $d['description'],
            'robots'         => $d['robots'],
            'canonical'      => $d['canonical'] ?? self::currentUrl(),
            'og_title'       => $d['og_title']  ?? $title,
            'og_description' => $d['og_description'] ?? $d['description'],
            'og_image'       => $d['og_image'],
            'og_type'        => $d['og_type'],
            'og_url'         => $d['canonical'] ?? self::currentUrl(),
            'site_name'      => $d['site_name'],
            'breadcrumb'     => $d['breadcrumb']     ?? null,
            'preload_image'  => $d['preload_image']  ?? null,
            'schema_type'    => $d['schema_type']    ?? null,
        ];
    }

    public static function breadcrumb(array $items): string
    {
        $list = [];
        foreach ($items as $i => $item) {
            $list[] = [
                '@type'    => 'ListItem',
                'position' => $i + 1,
                'name'     => $item['name'],
                'item'     => $item['url'] ?? null,
            ];
        }
        return json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $list,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    private static function currentUrl(): string
    {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        return $scheme . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
}
