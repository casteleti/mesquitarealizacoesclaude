<?php

declare(strict_types=1);

class AdminGestaoController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $items = GestaoCard::findAll('', [], 'ordem ASC');
        $this->view('admin/gestao-list', compact('items'));
    }

    public function create(): void
    {
        $this->requireAdmin();
        $this->view('admin/gestao-form', ['item' => null]);
    }

    public function store(): void { $this->save(); }

    public function edit(string $id): void
    {
        $this->requireAdmin();
        $item = GestaoCard::find((int) $id);
        if (!$item) { $this->abort(404); }
        $this->view('admin/gestao-form', compact('item'));
    }

    public function update(string $id): void { $this->save((int) $id); }

    private function save(?int $id = null): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $v = new Validator($_POST);
        $v->required('titulo', 'Título')->maxLength('titulo', 35, 'Título');

        if (!$v->passes()) {
            $_SESSION['old']    = $_POST;
            $_SESSION['errors'] = $v->errors();
            $this->redirect($id ? '/admin/gestao/' . $id . '/edit' : '/admin/gestao/create');
        }

        $current      = $id ? (GestaoCard::find($id) ?? []) : [];
        $iconeArquivo = $current['icone_arquivo'] ?? '';

        if (!empty($_FILES['icone_arquivo']['tmp_name'])) {
            $novo = Upload::image($_FILES['icone_arquivo'], 'icones', $iconeArquivo ?: null);
            if ($novo) { $iconeArquivo = $novo; }
        }

        $data = [
            'icone'         => strip_tags(trim($_POST['icone'] ?? '')),
            'icone_arquivo' => $iconeArquivo,
            'titulo'        => strip_tags(trim($_POST['titulo'])),
            'texto'         => strip_tags(trim($_POST['texto'] ?? '')),
            'ordem'         => (int) ($_POST['ordem'] ?? 0),
            'ativo'         => isset($_POST['ativo']) ? 1 : 0,
        ];

        try {
            $id ? GestaoCard::update($id, $data) : GestaoCard::insert($data);
            $this->flash('success', 'Card salvo.');
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->flash('error', 'Não foi possível salvar.');
        }

        $this->redirect('/admin/gestao');
    }

    public function delete(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        GestaoCard::delete((int) $id);
        $this->flash('success', 'Card excluído.');
        $this->redirect('/admin/gestao');
    }

    public function toggle(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        $item = GestaoCard::find((int) $id);
        if ($item) { GestaoCard::update((int) $id, ['ativo' => $item['ativo'] ? 0 : 1]); }
        $this->redirect('/admin/gestao');
    }

    public function reorder(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        foreach ($_POST['ids'] ?? [] as $pos => $id) {
            GestaoCard::update((int) $id, ['ordem' => (int) $pos]);
        }
        $this->json(['ok' => true]);
    }
}
