<?php

declare(strict_types=1);

class ContactController extends Controller
{
    public function index(): void
    {
        $pagina = PaginaConteudo::get('contato');
        $config = Configuracao::getAll();
        $seo    = Seo::meta([
            'title'       => $pagina['seo_title'] ?? 'Contato',
            'description' => $pagina['seo_description'] ?? '',
        ]);
        $this->view('site/contato', compact('pagina', 'config', 'seo'));
    }

    public function send(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        Csrf::verify();

        // Honeypot
        if (!empty($_POST['website'])) {
            echo json_encode(['success' => true]);
            exit;
        }

        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        if (Lead::isRateLimited($ip)) {
            http_response_code(429);
            echo json_encode(['success' => false, 'message' => 'Muitas tentativas. Aguarde e tente novamente.']);
            exit;
        }

        $v = new Validator($_POST);
        $v->required('nome',     'Nome')    ->maxLength('nome',     100,  'Nome')
          ->required('email',    'E-mail')  ->email('email')        ->maxLength('email',    100, 'E-mail')
          ->required('telefone', 'Telefone')->maxLength('telefone',  20,  'Telefone')
          ->required('mensagem', 'Mensagem')->maxLength('mensagem', 2000, 'Mensagem');

        if (!$v->passes()) {
            http_response_code(422);
            echo json_encode(['success' => false, 'errors' => $v->errors()]);
            exit;
        }

        $data = [
            'nome'         => strip_tags(trim($_POST['nome'])),
            'empresa'      => null,
            'email'        => trim($_POST['email']),
            'telefone'     => strip_tags(trim($_POST['telefone'])),
            'tipo_projeto' => null,
            'local'        => null,
            'mensagem'     => strip_tags(trim($_POST['mensagem'])),
            'ip'           => $ip,
            'status'       => 1,
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        Lead::insert($data);

        // Notification email
        $emailDestino = Configuracao::get('email_leads') ?: Configuracao::get('email');
        if ($emailDestino) {
            $body = "
                <h2 style='font-family:sans-serif;color:#1a1a1a'>Novo contato recebido</h2>
                <table style='font-family:sans-serif;font-size:15px;line-height:1.6;color:#333'>
                    <tr><td style='padding:4px 12px 4px 0;font-weight:600'>Nome</td><td>{$data['nome']}</td></tr>
                    <tr><td style='padding:4px 12px 4px 0;font-weight:600'>E-mail</td><td>{$data['email']}</td></tr>
                    <tr><td style='padding:4px 12px 4px 0;font-weight:600'>Telefone</td><td>{$data['telefone']}</td></tr>
                </table>
                <p style='font-family:sans-serif;font-size:15px;margin-top:18px'><strong>Mensagem:</strong><br>{$data['mensagem']}</p>
            ";
            Mailer::send($emailDestino, 'Novo contato — Mesquita Realizações', $body);
        }

        echo json_encode(['success' => true, 'message' => 'Mensagem enviada! Entraremos em contato em breve.']);
        exit;
    }
}
