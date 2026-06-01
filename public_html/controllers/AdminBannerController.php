<?php

declare(strict_types=1);

class AdminBannerController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $items = Banner::findAll('', [], 'ordem ASC');
        $this->view('admin/banner-list', compact('items'));
    }

    public function create(): void
    {
        $this->requireAdmin();
        $this->view('admin/banner-form', ['item' => null]);
    }

    public function edit(string $id): void
    {
        $this->requireAdmin();
        $item = Banner::find((int) $id);
        if (!$item) {
            $this->abort(404);
        }
        $this->view('admin/banner-form', compact('item'));
    }

    public function store(): void
    {
        $this->save();
    }

    public function update(string $id): void
    {
        $this->save((int) $id);
    }

    private function save(?int $id = null): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $v = new Validator($_POST);
        $v->required('headline', 'Título');

        if (!$v->passes()) {
            $_SESSION['old']    = $_POST;
            $_SESSION['errors'] = $v->errors();
            $this->redirect($id ? '/admin/banners/' . $id . '/edit' : '/admin/banners/create');
        }

        $current = $id ? (Banner::find($id) ?? []) : [];

        $imagem = null;
        if (!empty($_FILES['imagem']['tmp_name'])) {
            $imagem = Upload::image($_FILES['imagem'], 'banners', $current['imagem'] ?? null);
        }
        $imagem = $imagem ?? ($current['imagem'] ?? '');

        $data = [
            'label'                  => strip_tags(trim($_POST['label'] ?? '')),
            'headline'               => strip_tags(trim($_POST['headline'])),
            'subheadline'            => strip_tags(trim($_POST['subheadline'] ?? '')),
            'imagem'                 => $imagem,
            'botao_primario_texto'   => strip_tags(trim($_POST['botao_primario_texto'] ?? '')),
            'botao_primario_link'    => strip_tags(trim($_POST['botao_primario_link'] ?? '')),
            'botao_secundario_texto' => strip_tags(trim($_POST['botao_secundario_texto'] ?? '')),
            'botao_secundario_link'  => strip_tags(trim($_POST['botao_secundario_link'] ?? '')),
            'ativo'                  => isset($_POST['ativo']) ? 1 : 0,
            'ordem'                  => (int) ($_POST['ordem'] ?? 0),
        ];

        try {
            if ($id) {
                Banner::update($id, $data);
            } else {
                Banner::insert($data);
            }
            $this->flash('success', 'Banner salvo com sucesso.');
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->flash('error', 'Não foi possível salvar o banner.');
        }

        $this->redirect('/admin/banners');
    }

    public function delete(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        try {
            Banner::delete((int) $id);
            $this->flash('success', 'Banner removido.');
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->flash('error', 'Não foi possível remover o banner.');
        }
        $this->redirect('/admin/banners');
    }

    public function toggle(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        $item = Banner::find((int) $id);
        if ($item) {
            Banner::update((int) $id, ['ativo' => $item['ativo'] ? 0 : 1]);
        }
        $this->redirect('/admin/banners');
    }

    public function reorder(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        foreach ($_POST['ids'] ?? [] as $pos => $id) {
            Banner::update((int) $id, ['ordem' => (int) $pos]);
        }
        $this->json(['ok' => true]);
    }
}
