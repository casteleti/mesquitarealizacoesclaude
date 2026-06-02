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

        // Variante de teste do slider novo (via entrar2.php)
        $view = (($GLOBALS['HOME_VARIANT'] ?? null) === 2) ? 'site/home2' : 'site/home';

        $this->view($view, compact(
            'banners', 'setores', 'destaques', 'diferenciais',
            'gestao', 'pagina', 'config', 'seo'
        ));
    }
}
