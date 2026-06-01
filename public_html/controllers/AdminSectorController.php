<?php

declare(strict_types=1);

class AdminSectorController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $items = Setor::todosAdmin();
        $this->view('admin/setor-list', compact('items'));
    }

    public function create(): void
    {
        $this->requireAdmin();
        $this->view('admin/setor-form', ['item' => null]);
    }

    public function edit(string $id): void
    {
        $this->requireAdmin();
        $item = Setor::find((int) $id);
        if (!$item) {
            $this->abort(404);
        }
        $this->view('admin/setor-form', compact('item'));
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
        $v->required('title', 'Nome')->maxLength('title', 100, 'Nome');

        if (!$v->passes()) {
            $_SESSION['old']    = $_POST;
            $_SESSION['errors'] = $v->errors();
            $this->redirect($id ? '/admin/setores/' . $id . '/edit' : '/admin/setores/create');
        }

        $current = $id ? (Setor::find($id) ?? []) : [];
        $title   = strip_tags(trim($_POST['title']));
        $slugVal = strip_tags(trim($_POST['slug'] ?? '')) ?: slug($title);

        $imagem = null;
        if (!empty($_FILES['imagem']['tmp_name'])) {
            $imagem = Upload::image($_FILES['imagem'], 'setores', $current['imagem'] ?? null);
        }
        $imagem = $imagem ?? ($current['imagem'] ?? '');

        $data = [
            'title'           => $title,
            'slug'            => $slugVal,
            'icone'           => strip_tags(trim($_POST['icone'] ?? '')),
            'titulo_home'     => strip_tags(trim($_POST['titulo_home'] ?? '')),
            'descricao_curta' => strip_tags(trim($_POST['descricao_curta'] ?? '')),
            'imagem'          => $imagem,
            'titulo_pagina'   => strip_tags(trim($_POST['titulo_pagina'] ?? '')),
            'descricao'       => trim($_POST['descricao'] ?? ''),
            'botao_texto'     => strip_tags(trim($_POST['botao_texto'] ?? '')),
            'ativo'           => isset($_POST['ativo']) ? 1 : 0,
            'ordem'           => (int) ($_POST['ordem'] ?? 0),
        ];

        try {
            if ($id) {
                Setor::update($id, $data);
            } else {
                Setor::insert($data);
            }
            $this->flash('success', 'Setor salvo com sucesso.');
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->flash('error', 'Não foi possível salvar. Verifique se o slug já existe.');
        }

        $this->redirect('/admin/setores');
    }

    public function delete(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        $obras = Obra::count('setor_id = ?', [(int) $id]);
        if ($obras > 0) {
            $this->flash('error', 'Este setor possui ' . $obras . ' obra(s) relacionada(s). Reatribua antes de excluir.');
            $this->redirect('/admin/setores');
        }
        try {
            Setor::delete((int) $id);
            $this->flash('success', 'Setor removido.');
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->flash('error', 'Não foi possível remover o setor.');
        }
        $this->redirect('/admin/setores');
    }

    public function toggle(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        $item = Setor::find((int) $id);
        if ($item) {
            Setor::update((int) $id, ['ativo' => $item['ativo'] ? 0 : 1]);
        }
        $this->redirect('/admin/setores');
    }

    public function reorder(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        foreach ($_POST['ids'] ?? [] as $pos => $id) {
            Setor::update((int) $id, ['ordem' => (int) $pos]);
        }
        $this->json(['ok' => true]);
    }
}
