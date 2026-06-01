<?php

declare(strict_types=1);

class AdminDiferencialController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $items = Diferencial::findAll('', [], 'ordem ASC');
        $this->view('admin/diferencial-list', compact('items'));
    }

    public function create(): void
    {
        $this->requireAdmin();
        $this->view('admin/diferencial-form', ['item' => null]);
    }

    public function store(): void
    {
        $this->save();
    }

    public function edit(string $id): void
    {
        $this->requireAdmin();
        $item = Diferencial::find((int) $id);
        if (!$item) { $this->abort(404); }
        $this->view('admin/diferencial-form', compact('item'));
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
        $v->required('titulo', 'Título')->maxLength('titulo', 35, 'Título')
          ->required('exibir_em', 'Exibir em');

        if (!$v->passes()) {
            $_SESSION['old']    = $_POST;
            $_SESSION['errors'] = $v->errors();
            $this->redirect($id ? '/admin/diferenciais/' . $id . '/edit' : '/admin/diferenciais/create');
        }

        $current      = $id ? (Diferencial::find($id) ?? []) : [];
        $iconeArquivo = $current['icone_arquivo'] ?? '';

        if (!empty($_FILES['icone_arquivo']['tmp_name'])) {
            $novo = Upload::image($_FILES['icone_arquivo'], 'icones', $iconeArquivo ?: null);
            if ($novo) {
                $iconeArquivo = $novo;
            }
        }

        $data = [
            'titulo'        => strip_tags(trim($_POST['titulo'])),
            'texto'         => strip_tags(trim($_POST['texto'] ?? '')),
            'icone'         => strip_tags(trim($_POST['icone'] ?? '')),
            'icone_arquivo' => $iconeArquivo,
            'exibir_em'     => (int) ($_POST['exibir_em'] ?? 1),
            'ordem'         => (int) ($_POST['ordem'] ?? 0),
            'ativo'         => isset($_POST['ativo']) ? 1 : 0,
        ];

        try {
            if ($id) {
                Diferencial::update($id, $data);
            } else {
                Diferencial::insert($data);
            }
            $this->flash('success', 'Diferencial salvo.');
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->flash('error', 'Não foi possível salvar.');
        }

        $this->redirect('/admin/diferenciais');
    }

    public function delete(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        Diferencial::delete((int) $id);
        $this->flash('success', 'Diferencial excluído.');
        $this->redirect('/admin/diferenciais');
    }

    public function toggle(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        $item = Diferencial::find((int) $id);
        if ($item) {
            Diferencial::update((int) $id, ['ativo' => $item['ativo'] ? 0 : 1]);
        }
        $this->redirect('/admin/diferenciais');
    }

    public function reorder(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        foreach ($_POST['ids'] ?? [] as $pos => $id) {
            Diferencial::update((int) $id, ['ordem' => (int) $pos]);
        }
        $this->json(['ok' => true]);
    }
}
