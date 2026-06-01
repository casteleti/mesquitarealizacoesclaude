<?php

declare(strict_types=1);

class AdminProcessController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $items = EtapaProcesso::findAll('', [], 'ordem ASC');
        $this->view('admin/process-list', compact('items'));
    }

    public function create(): void
    {
        $this->requireAdmin();
        $this->view('admin/process-form', ['item' => null]);
    }

    public function store(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $v = new Validator($_POST);
        $v->required('numero', 'Número')
          ->required('titulo', 'Título')->maxLength('titulo', 100, 'Título');

        if (!$v->passes()) {
            $_SESSION['old'] = $_POST;
            $_SESSION['errors'] = $v->errors();
            $this->redirect('/admin/processo/create');
        }

        EtapaProcesso::insert([
            'numero'          => strip_tags(trim($_POST['numero'])),
            'titulo'          => strip_tags(trim($_POST['titulo'])),
            'descricao'       => strip_tags(trim($_POST['descricao'] ?? '')),
            'icone'           => strip_tags(trim($_POST['icone'] ?? '')),
            'bloco_titulo'    => strip_tags(trim($_POST['bloco_titulo'] ?? '')),
            'topico_1'        => strip_tags(trim($_POST['topico_1'] ?? '')),
            'topico_2'        => strip_tags(trim($_POST['topico_2'] ?? '')),
            'topico_3'        => strip_tags(trim($_POST['topico_3'] ?? '')),
            'resultado_titulo'=> strip_tags(trim($_POST['resultado_titulo'] ?? '')),
            'resultado_texto' => strip_tags(trim($_POST['resultado_texto'] ?? '')),
            'ordem'           => (int) ($_POST['ordem'] ?? 0),
            'ativo'           => isset($_POST['ativo']) ? 1 : 0,
        ]);

        $this->flash('success', 'Etapa criada.');
        $this->redirect('/admin/processo');
    }

    public function edit(string $id): void
    {
        $this->requireAdmin();
        $item = EtapaProcesso::find((int) $id);
        if (!$item) {
            $this->abort(404);
        }
        $this->view('admin/process-form', compact('item'));
    }

    public function update(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $v = new Validator($_POST);
        $v->required('numero', 'Número')
          ->required('titulo', 'Título')->maxLength('titulo', 100, 'Título');

        if (!$v->passes()) {
            $_SESSION['old'] = $_POST;
            $_SESSION['errors'] = $v->errors();
            $this->redirect('/admin/processo/' . $id . '/edit');
        }

        EtapaProcesso::update((int) $id, [
            'numero'          => strip_tags(trim($_POST['numero'])),
            'titulo'          => strip_tags(trim($_POST['titulo'])),
            'descricao'       => strip_tags(trim($_POST['descricao'] ?? '')),
            'icone'           => strip_tags(trim($_POST['icone'] ?? '')),
            'bloco_titulo'    => strip_tags(trim($_POST['bloco_titulo'] ?? '')),
            'topico_1'        => strip_tags(trim($_POST['topico_1'] ?? '')),
            'topico_2'        => strip_tags(trim($_POST['topico_2'] ?? '')),
            'topico_3'        => strip_tags(trim($_POST['topico_3'] ?? '')),
            'resultado_titulo'=> strip_tags(trim($_POST['resultado_titulo'] ?? '')),
            'resultado_texto' => strip_tags(trim($_POST['resultado_texto'] ?? '')),
            'ordem'           => (int) ($_POST['ordem'] ?? 0),
            'ativo'           => isset($_POST['ativo']) ? 1 : 0,
        ]);

        $this->flash('success', 'Etapa atualizada.');
        $this->redirect('/admin/processo');
    }

    public function delete(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        EtapaProcesso::delete((int) $id);
        $this->flash('success', 'Etapa excluída.');
        $this->redirect('/admin/processo');
    }

    public function toggle(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        $item = EtapaProcesso::find((int) $id);
        if ($item) {
            EtapaProcesso::update((int) $id, ['ativo' => $item['ativo'] ? 0 : 1]);
        }
        $this->redirect('/admin/processo');
    }

    public function reorder(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        foreach ($_POST['ids'] ?? [] as $pos => $id) {
            EtapaProcesso::update((int) $id, ['ordem' => (int) $pos]);
        }
        $this->json(['ok' => true]);
    }
}
