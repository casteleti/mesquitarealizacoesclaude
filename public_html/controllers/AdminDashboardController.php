<?php

declare(strict_types=1);

class AdminDashboardController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();

        $stats = [
            'obras_total'   => Obra::count(),
            'obras_ativas'  => Obra::count('ativo = 1'),
            'setores_ativos'=> Setor::count('ativo = 1'),
            'leads_novos'   => Lead::novos(),
            'leads_total'   => Lead::count(),
        ];

        $this->view('admin/dashboard', compact('stats'));
    }
}
