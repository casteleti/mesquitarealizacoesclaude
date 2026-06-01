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

    public function store(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $v = new Validator($_POST);
        $v->required('titulo', 'Título')->required('icone', 'Ícone');

        if (!$v->passes()) {
            $_SESSION['old'] = $_POST;
            $_SESSION['errors'] = $v->errors();
            $this->redirect('/admin/gestao/create');
        }

        GestaoCard::insert([
            'icone'  => strip_tags(trim($_POST['icone'])),
            'titulo' => strip_tags(trim($_POST['titulo'])),
            'texto'  => strip_tags(trim($_POST['texto'] ?? '')),
            'ordem'  => (int) ($_POST['ordem'] ?? 0),
            'ativo'  => isset($_POST['ativo']) ? 1 : 0,
        ]);

        $this->flash('success', 'Card criado.');
        $this->redirect('/admin/gestao');
    }

    public function edit(string $id): void
    {
        $this->requireAdmin();
        $item = GestaoCard::find((int) $id);
        if (!$item) {
            $this->abort(404);
        }
        $this->view('admin/gestao-form', compact('item'));
    }

    public function update(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $v = new Validator($_POST);
        $v->required('titulo', 'Título')->required('icone', 'Ícone');

        if (!$v->passes()) {
            $_SESSION['old'] = $_POST;
            $_SESSION['errors'] = $v->errors();
            $this->redirect('/admin/gestao/' . $id . '/edit');
        }

        GestaoCard::update((int) $id, [
            'icone'  => strip_tags(trim($_POST['icone'])),
            'titulo' => strip_tags(trim($_POST['titulo'])),
            'texto'  => strip_tags(trim($_POST['texto'] ?? '')),
            'ordem'  => (int) ($_POST['ordem'] ?? 0),
            'ativo'  => isset($_POST['ativo']) ? 1 : 0,
        ]);

        $this->flash('success', 'Card atualizado.');
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
        if ($item) {
            GestaoCard::update((int) $id, ['ativo' => $item['ativo'] ? 0 : 1]);
        }
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
