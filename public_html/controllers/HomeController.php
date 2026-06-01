<?php

declare(strict_types=1);

class HomeController extends Controller
{
    public function index(): void
    {
        $banners      = Banner::ativos();
        $setores      = Setor::destaques();
        $destaques    = Obra::destaques(6);
        $diferenciais = Diferencial::paraHome();
        $gestao       = GestaoCard::ativos();
        $pagina       = PaginaConteudo::get('home');
        $config       = Configuracao::getAll();

        $seo = Seo::meta([
            'title'       => $pagina['seo_title'] ?? '',
            'description' => $pagina['seo_description'] ?? '',
        ]);

        $this->view('site/home', compact(
            'banners', 'setores', 'destaques', 'diferenciais',
            'gestao', 'pagina', 'config', 'seo'
        ));
    }
}
