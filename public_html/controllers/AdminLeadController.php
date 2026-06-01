<?php

declare(strict_types=1);

class AdminLeadController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();

        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $status = $_GET['status'] ?? '';

        $where  = [];
        $params = [];
        if ($status !== '') {
            $where[]  = 'status = ?';
            $params[] = (int) $status;
        }

        $leads = Lead::paginate(
            $page, 20,
            implode(' AND ', $where) ?: '',
            $params,
            'created_at DESC'
        );

        $this->view('admin/lead-list', compact('leads', 'status'));
    }

    public function show(string $id): void
    {
        $this->requireAdmin();
        $lead = Lead::find((int) $id);
        if (!$lead) {
            $this->abort(404);
        }
        Lead::marcarLida((int) $id);
        $lead = Lead::find((int) $id);
        $this->view('admin/lead-detail', compact('lead'));
    }

    public function updateStatus(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $status = (int) ($_POST['status'] ?? 0);
        if (!array_key_exists($status, Lead::STATUS)) {
            $this->flash('error', 'Status inválido.');
        } else {
            Lead::update((int) $id, ['status' => $status]);
            $this->flash('success', 'Status atualizado.');
        }
        $this->redirect('/admin/leads/' . $id);
    }

    public function delete(string $id): void
    {
        $this->requireAdmin();
        $this->csrfVerify();
        Lead::delete((int) $id);
        $this->flash('success', 'Lead excluído.');
        $this->redirect('/admin/leads');
    }
}
