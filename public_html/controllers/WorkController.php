<?php

declare(strict_types=1);

class WorkController extends Controller
{
    private int $perPage = 9;

    public function index(): void
    {
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $setor  = $_GET['setor'] ?? null;
        $pagina = PaginaConteudo::get('obras');
        $config = Configuracao::getAll();

        $obras        = Obra::paginar($page, $this->perPage, $setor ?: null);
        $obrasJson    = json_encode(Obra::todosParaFiltro($setor ?: null), JSON_UNESCAPED_UNICODE);
        $setores      = Setor::comObras();
        $setorAtivo   = $setor ? Setor::findBySlug($setor) : null;

        $seo = Seo::meta([
            'title'       => $pagina['seo_title'] ?? 'Obras',
            'description' => $pagina['seo_description'] ?? '',
        ]);

        $this->view('site/obras', compact(
            'obras', 'obrasJson', 'setores', 'setorAtivo',
            'pagina', 'config', 'seo', 'setor'
        ));
    }

    public function show(string $slug): void
    {
        $obra = Obra::findBySlug($slug);
        if (!$obra) {
            $this->abort(404);
        }

        $imagens    = ObraImagem::deObra((int) $obra['id']);
        $relacionadas = Obra::relacionadas((int) $obra['id'], $obra['setor_id'] ? (int) $obra['setor_id'] : null);
        $pagina     = PaginaConteudo::get('obras');
        $config     = Configuracao::getAll();

        $seoTitle = $obra['seo_title'] ?: ($obra['title'] . ' | Mesquita Realizações');
        $seoDesc  = $obra['seo_description'] ?: truncate($obra['descricao'] ?? $obra['subtitulo'] ?? '', 155);
        $seoImage = $obra['seo_image'] ?: $obra['imagem_principal'] ?: ($imagens[0]['caminho'] ?? '');

        $seo = Seo::meta([
            'title'       => $seoTitle,
            'description' => $seoDesc,
            'og_image'    => $seoImage,
            'og_type'     => 'article',
            'canonical'   => '/obras/' . $obra['slug'],
        ]);

        $this->view('site/obra-detalhe', compact(
            'obra', 'imagens', 'relacionadas', 'pagina', 'config', 'seo'
        ));
    }
}
