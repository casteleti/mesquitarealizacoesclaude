<?php

declare(strict_types=1);

class AdminDestaqueController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();

        $setores  = Setor::todosAdmin();
        $config   = Configuracao::getAll();

        // Posições atuais: [posicao => setor_id]
        $selecionados = [];
        for ($i = 1; $i <= 4; $i++) {
            $id = (int) ($config['setor_destaque_' . $i] ?? 0);
            if ($id > 0) {
                $selecionados[$id] = $i;
            }
        }

        $this->view('admin/setores-destaque', compact('setores', 'selecionados'));
    }

    public function save(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $setor_ids  = $_POST['setor_ids'] ?? [];
        $setor_ordem = $_POST['setor_ordem'] ?? [];

        // Validação PHP: máx 4, mín 1
        if (count($setor_ids) < 1) {
            $this->flash('error', 'Selecione pelo menos 1 setor.');
            $this->redirect('/admin/setores-destaque');
        }

        if (count($setor_ids) > 4) {
            $this->flash('error', 'Máximo de 4 setores em destaque.');
            $this->redirect('/admin/setores-destaque');
        }

        // Validar IDs e ordens
        $setor_ids = array_map('intval', $setor_ids);
        $posicoes = [1 => null, 2 => null, 3 => null, 4 => null];

        foreach ($setor_ids as $id) {
            if ($id <= 0) {
                continue;
            }
            $setor = Setor::find($id);
            if (!$setor) {
                continue;
            }
            $pos = (int) ($setor_ordem[$id] ?? 0);
            if ($pos < 1 || $pos > 4) {
                continue;
            }
            $posicoes[$pos] = $id;
        }

        // Salvar posições 1-4 (null vira string vazia)
        $data = [];
        for ($i = 1; $i <= 4; $i++) {
            $data['setor_destaque_' . $i] = $posicoes[$i] ?? '';
        }

        try {
            Configuracao::saveAll($data);
            $this->flash('success', 'Setores em destaque atualizados.');
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->flash('error', 'Não foi possível salvar.');
        }

        $this->redirect('/admin/setores-destaque');
    }
}
