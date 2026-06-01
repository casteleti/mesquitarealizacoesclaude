<?php

declare(strict_types=1);

class PageController extends Controller
{
    public function quemSomos(): void
    {
        $pagina       = PaginaConteudo::get('quem-somos');
        $diferenciais = Diferencial::paraQuemSomos();
        $valores      = Valor::ativos();
        $config       = Configuracao::getAll();

        $seo = Seo::meta([
            'title'       => $pagina['seo_title'] ?? 'Quem Somos',
            'description' => $pagina['seo_description'] ?? '',
            'canonical'   => '/quem-somos',
            'breadcrumb'  => Seo::breadcrumb([
                ['name' => 'Home',       'url' => absolute_url('/')],
                ['name' => 'Quem Somos', 'url' => absolute_url('quem-somos')],
            ]),
        ]);

        $this->view('site/quem-somos', compact('pagina', 'diferenciais', 'valores', 'config', 'seo'));
    }

    public function setores(): void
    {
        $pagina  = PaginaConteudo::get('setores');
        $setores = Setor::ativos();
        $config  = Configuracao::getAll();

        $seo = Seo::meta([
            'title'       => $pagina['seo_title'] ?? 'Setores',
            'description' => $pagina['seo_description'] ?? '',
            'canonical'   => '/setores',
            'breadcrumb'  => Seo::breadcrumb([
                ['name' => 'Home',    'url' => absolute_url('/')],
                ['name' => 'Setores', 'url' => absolute_url('setores')],
            ]),
        ]);

        $this->view('site/setores', compact('pagina', 'setores', 'config', 'seo'));
    }

    public function setor(string $slug): void
    {
        $setor = Setor::findBySlug($slug);
        if (!$setor) {
            $this->abort(404);
        }

        $obras  = Obra::todosParaFiltro($slug);
        $config = Configuracao::getAll();

        $heroUrl = !empty($setor['imagem']) ? '/' . ltrim($setor['imagem'], '/') : null;

        $seo = Seo::meta([
            'title'         => ($setor['titulo_pagina'] ?: $setor['title']) . ' | Setores',
            'description'   => $setor['descricao_curta'] ?? '',
            'canonical'     => '/setores/' . $setor['slug'],
            'preload_image' => $heroUrl,
            'breadcrumb'    => Seo::breadcrumb([
                ['name' => 'Home',              'url' => absolute_url('/')],
                ['name' => 'Setores',           'url' => absolute_url('setores')],
                ['name' => $setor['title'],     'url' => absolute_url('setores/' . $setor['slug'])],
            ]),
        ]);

        $this->view('site/sector-detail', compact('setor', 'obras', 'config', 'seo'));
    }

    public function comoAtuamos(): void
    {
        $pagina   = PaginaConteudo::get('como-atuamos');
        $processo = EtapaProcesso::ativos();
        $gestao   = GestaoCard::ativos();
        $config   = Configuracao::getAll();

        $seo = Seo::meta([
            'title'       => $pagina['seo_title'] ?? 'Como Atuamos',
            'description' => $pagina['seo_description'] ?? '',
            'canonical'   => '/como-atuamos',
            'breadcrumb'  => Seo::breadcrumb([
                ['name' => 'Home',         'url' => absolute_url('/')],
                ['name' => 'Como Atuamos', 'url' => absolute_url('como-atuamos')],
            ]),
        ]);

        $this->view('site/como-atuamos', compact('pagina', 'processo', 'gestao', 'config', 'seo'));
    }
}
