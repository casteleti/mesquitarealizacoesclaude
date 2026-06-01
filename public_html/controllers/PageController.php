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

        $seo = Seo::meta([
            'title'       => ($setor['titulo_pagina'] ?: $setor['title']) . ' | Setores',
            'description' => $setor['descricao_curta'] ?? '',
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
        ]);

        $this->view('site/como-atuamos', compact('pagina', 'processo', 'gestao', 'config', 'seo'));
    }
}
