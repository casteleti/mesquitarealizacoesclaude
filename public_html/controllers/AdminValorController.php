<?php

declare(strict_types=1);

class AdminValorController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $items = Valor::findAll('', [], 'ordem ASC');
        $this->view('admin/valor-list', compact('items'));
    }

    public function create(): void
    {
        $this->requireAdmin();
        $this->view('admin/valor-form', ['item' => null]);
    }

    public function store(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $v = new Validator($_POST);
        $v->required('titulo', 'Título')->maxLength('titulo', 100, 'Título');

        if (!$v->passes()) {
            $_SESSION['old'] = $_POST;
            $_SESSION['errors'] = $v->errors();
            $this->redirect('/admin/valores/create');
        }

        Valor::insert([
            'titulo'   => strip_tags(trim($_POST['titulo'])),
            'resumo'   => strip_tags(trim($_POST['resumo'] ?? '')),
            'texto'    => strip_tags(trim($_POST['texto'] ?? '')),
            'icone'    => strip_tags(trim($_POST['icone'] ?? '')),
            'topico_1' => strip_tags(trim($_POST['topico_1'] ?? '')),
            'topico_2' => strip_tags(trim($_POST['topico_2'] ?? '')),
            'topico_3' => strip_tags(trim($_POST['topico_3'] ?? '')),
            'ordem'    => (int) ($_POST['ordem'] ?? 0),
            'ativo'    => isset($_POST['ativo']) ? 1 : 0,
        ]);

        $this->flash('success', 'Valor criado.');
        $this->redirect('/admin/valores');
    }

    public function edit(string $id): void
    {
        $this->requireAdmin();
        $item = Valor::find((int) $id);
        if (!$item) {
            $this->abort(404);
        }
        $this->view('admin/valor-form', compact('item'));
    }

    public function update(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $v = new Validator($_POST);
        $v->required('titulo', 'Título')->maxLength('titulo', 100, 'Título');

        if (!$v->passes()) {
            $_SESSION['old'] = $_POST;
            $_SESSION['errors'] = $v->errors();
            $this->redirect('/admin/valores/' . $id . '/edit');
        }

        Valor::update((int) $id, [
            'titulo'   => strip_tags(trim($_POST['titulo'])),
            'resumo'   => strip_tags(trim($_POST['resumo'] ?? '')),
            'texto'    => strip_tags(trim($_POST['texto'] ?? '')),
            'icone'    => strip_tags(trim($_POST['icone'] ?? '')),
            'topico_1' => strip_tags(trim($_POST['topico_1'] ?? '')),
            'topico_2' => strip_tags(trim($_POST['topico_2'] ?? '')),
            'topico_3' => strip_tags(trim($_POST['topico_3'] ?? '')),
            'ordem'    => (int) ($_POST['ordem'] ?? 0),
            'ativo'    => isset($_POST['ativo']) ? 1 : 0,
        ]);

        $this->flash('success', 'Valor atualizado.');
        $this->redirect('/admin/valores');
    }

    public function delete(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        Valor::delete((int) $id);
        $this->flash('success', 'Valor excluído.');
        $this->redirect('/admin/valores');
    }

    public function toggle(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        $item = Valor::find((int) $id);
        if ($item) {
            Valor::update((int) $id, ['ativo' => $item['ativo'] ? 0 : 1]);
        }
        $this->redirect('/admin/valores');
    }

    public function reorder(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        $ids = $_POST['ids'] ?? [];
        foreach ($ids as $pos => $id) {
            Valor::update((int) $id, ['ordem' => (int) $pos]);
        }
        $this->json(['ok' => true]);
    }
}
