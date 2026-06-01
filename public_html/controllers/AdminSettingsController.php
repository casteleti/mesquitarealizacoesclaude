<?php

declare(strict_types=1);

class AdminSettingsController extends Controller
{
    public function index(): void
    {
        $this->requireAdmin();
        $settings = Configuracao::getAll();
        $this->view('admin/settings-form', compact('settings'));
    }

    public function save(): void
    {
        $this->requireAdmin();
        $this->csrfVerify();

        $current  = Configuracao::getAll();
        $smtpPass = trim($_POST['smtp_pass'] ?? '');

        $data = [
            'site_url'    => trim($_POST['site_url'] ?? ''),
            'email'       => trim($_POST['email'] ?? ''),
            'email_leads' => trim($_POST['email_leads'] ?? ''),
            'telefone'    => trim($_POST['telefone'] ?? ''),
            'whatsapp'    => trim($_POST['whatsapp'] ?? ''),
            'endereco'    => trim($_POST['endereco'] ?? ''),
            'linkedin'    => trim($_POST['linkedin'] ?? ''),
            'instagram'   => trim($_POST['instagram'] ?? ''),
            'facebook'    => trim($_POST['facebook'] ?? ''),
            'ga_id'       => trim($_POST['ga_id'] ?? ''),
            'maps_embed'  => trim($_POST['maps_embed'] ?? ''),
            'smtp_host'   => trim($_POST['smtp_host'] ?? ''),
            'smtp_user'   => trim($_POST['smtp_user'] ?? ''),
            'smtp_pass'   => $smtpPass !== '' ? $smtpPass : ($current['smtp_pass'] ?? ''),
            'smtp_port'   => trim($_POST['smtp_port'] ?? ''),
        ];

        try {
            Configuracao::saveAll($data);
            $this->flash('success', 'Configurações salvas.');
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->flash('error', 'Não foi possível salvar as configurações.');
        }

        $this->redirect('/admin/configuracoes');
    }
}
