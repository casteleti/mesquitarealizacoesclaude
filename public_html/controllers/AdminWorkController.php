<?php

declare(strict_types=1);

class AdminWorkController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $items = Obra::todosAdmin();
        $this->view('admin/obra-list', compact('items'));
    }

    public function create(): void
    {
        $this->requireAdmin();
        $setores = Setor::findAll('', [], 'ordem ASC');
        $this->view('admin/obra-form', ['item' => null, 'setores' => $setores]);
    }

    public function edit(string $id): void
    {
        $this->requireAdmin();
        $item = Obra::find((int) $id);
        if (!$item) {
            $this->abort(404);
        }
        $setores = Setor::findAll('', [], 'ordem ASC');
        $this->view('admin/obra-form', compact('item', 'setores'));
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
        $v->required('title', 'Título')->maxLength('title', 200, 'Título');

        if (!$v->passes()) {
            $_SESSION['old']    = $_POST;
            $_SESSION['errors'] = $v->errors();
            $this->redirect($id ? '/admin/obras/' . $id . '/edit' : '/admin/obras/create');
        }

        $current = $id ? (Obra::find($id) ?? []) : [];
        $title   = strip_tags(trim($_POST['title']));
        $slugVal = strip_tags(trim($_POST['slug'] ?? '')) ?: slug($title);

        $imagem = null;
        if (!empty($_FILES['imagem_principal']['tmp_name'])) {
            $imagem = Upload::image($_FILES['imagem_principal'], 'obras', $current['imagem_principal'] ?? null);
        }
        $imagem = $imagem ?? ($current['imagem_principal'] ?? '');

        $data = [
            'title'           => $title,
            'slug'            => $slugVal,
            'cliente'         => strip_tags(trim($_POST['cliente'] ?? '')),
            'setor_id'        => ($_POST['setor_id'] ?? '') !== '' ? (int) $_POST['setor_id'] : null,
            'localizacao'     => strip_tags(trim($_POST['localizacao'] ?? '')),
            'subtitulo'       => strip_tags(trim($_POST['subtitulo'] ?? '')),
            'data_inicio'     => strip_tags(trim($_POST['data_inicio'] ?? '')),
            'data_conclusao'  => strip_tags(trim($_POST['data_conclusao'] ?? '')),
            'descricao'       => trim($_POST['descricao'] ?? ''),
            'escopo'          => strip_tags(trim($_POST['escopo'] ?? '')),
            'imagem_principal'=> $imagem,
            'destaque'        => isset($_POST['destaque']) ? 1 : 0,
            'ativo'           => isset($_POST['ativo']) ? 1 : 0,
            'ordem'           => (int) ($_POST['ordem'] ?? 0),
            'seo_title'       => strip_tags(trim($_POST['seo_title'] ?? '')),
            'seo_description' => strip_tags(trim($_POST['seo_description'] ?? '')),
        ];

        try {
            if ($id) {
                Obra::update($id, $data);
            } else {
                Obra::insert($data);
            }
            $this->flash('success', 'Obra salva com sucesso.');
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->flash('error', 'Não foi possível salvar. Verifique se o slug já existe.');
        }

        $this->redirect('/admin/obras');
    }

    public function delete(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        try {
            Obra::delete((int) $id);
            $this->flash('success', 'Obra removida.');
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->flash('error', 'Não foi possível remover a obra.');
        }
        $this->redirect('/admin/obras');
    }

    public function toggle(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        $item = Obra::find((int) $id);
        if ($item) {
            Obra::update((int) $id, ['ativo' => $item['ativo'] ? 0 : 1]);
        }
        $this->redirect('/admin/obras');
    }

    public function reorder(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        foreach ($_POST['ids'] ?? [] as $pos => $id) {
            Obra::update((int) $id, ['ordem' => (int) $pos]);
        }
        $this->json(['ok' => true]);
    }

    public function addImage(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        $obra = Obra::find((int) $id);
        if (!$obra) {
            $this->json(['error' => 'Obra não encontrada.'], 404);
        }
        if (empty($_FILES['imagem']['tmp_name'])) {
            $this->json(['error' => 'Nenhuma imagem enviada.'], 422);
        }
        $caminho = Upload::image($_FILES['imagem'], 'obras/galeria', null);
        if (!$caminho) {
            $this->json(['error' => 'Falha no upload.'], 422);
        }
        $imgId = ObraImagem::insert([
            'obra_id'    => (int) $id,
            'caminho'    => $caminho,
            'legenda'    => strip_tags(trim($_POST['legenda'] ?? '')),
            'ordem'      => (int) ($_POST['ordem'] ?? 0),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $this->json(['ok' => true, 'id' => $imgId, 'caminho' => $caminho]);
    }

    public function deleteImage(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        ObraImagem::delete((int) $id);
        $this->json(['ok' => true]);
    }

    public function reorderImages(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        foreach ($_POST['ids'] ?? [] as $pos => $id) {
            ObraImagem::update((int) $id, ['ordem' => (int) $pos]);
        }
        $this->json(['ok' => true]);
    }
}
