<?php

declare(strict_types=1);

class AdminSeoController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $setores = Setor::findAll('', [], 'ordem ASC');
        $obras   = Obra::findAll('', [], 'ordem ASC');
        $this->view('admin/seo-index', compact('setores', 'obras'));
    }

    public function save(string $pagina): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $allowed = PaginaConteudo::paginas();
        if (!in_array($pagina, $allowed, true)) {
            $this->abort(404);
        }

        $campos = PaginaConteudo::get($pagina);
        $campos['seo_title']       = strip_tags(trim($_POST['seo_title'] ?? ''));
        $campos['seo_description'] = strip_tags(trim($_POST['seo_description'] ?? ''));
        PaginaConteudo::save($pagina, $campos);

        $this->flash('success', 'SEO salvo.');
        $this->redirect('/admin/seo');
    }
}
