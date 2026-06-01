<?php

declare(strict_types=1);

class AdminUserController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $items = User::findAll('', [], 'name ASC');
        $this->view('admin/user-list', compact('items'));
    }

    public function create(): void
    {
        $this->requireAdmin();
        $this->view('admin/user-form', ['item' => null]);
    }

    public function edit(string $id): void
    {
        $this->requireAdmin();
        $item = User::find((int) $id);
        if (!$item) {
            $this->abort(404);
        }
        $this->view('admin/user-form', compact('item'));
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
        $v->required('name', 'Nome')->maxLength('name', 100, 'Nome')
          ->required('email', 'E-mail')->email('email');

        if (!$id) {
            $v->required('password', 'Senha');
        }

        if (!$v->passes()) {
            $_SESSION['old']    = $_POST;
            $_SESSION['errors'] = $v->errors();
            $this->redirect($id ? '/admin/usuarios/' . $id . '/edit' : '/admin/usuarios/create');
        }

        $data = [
            'name'  => strip_tags(trim($_POST['name'])),
            'email' => trim($_POST['email']),
        ];

        $password = trim($_POST['password'] ?? '');
        if ($password !== '') {
            $data['password'] = User::hashPassword($password);
        }

        try {
            if ($id) {
                User::update($id, $data);
            } else {
                $data['password'] = User::hashPassword($password);
                User::insert($data);
            }
            $this->flash('success', 'Usuário salvo.');
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->flash('error', 'Não foi possível salvar. Verifique se o e-mail já está em uso.');
        }

        $this->redirect('/admin/usuarios');
    }

    public function delete(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        if ((int) $id === (int) Auth::id()) {
            $this->flash('error', 'Você não pode excluir o próprio usuário.');
            $this->redirect('/admin/usuarios');
        }
        try {
            User::delete((int) $id);
            $this->flash('success', 'Usuário removido.');
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->flash('error', 'Não foi possível remover o usuário.');
        }
        $this->redirect('/admin/usuarios');
    }
}
