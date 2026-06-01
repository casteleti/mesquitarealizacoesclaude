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
            $dataHora = date('d \d\e F \d\e Y \à\s H\hi', strtotime($data['created_at']));
            $assunto  = 'Novo contato de ' . $data['nome'] . ' — ' . date('d/m/Y \à\s H\hi', strtotime($data['created_at']));
            $mensagemHtml = nl2br(htmlspecialchars($data['mensagem'], ENT_QUOTES, 'UTF-8'));
            $nome     = htmlspecialchars($data['nome'],     ENT_QUOTES, 'UTF-8');
            $email    = htmlspecialchars($data['email'],    ENT_QUOTES, 'UTF-8');
            $telefone = htmlspecialchars($data['telefone'], ENT_QUOTES, 'UTF-8');

            $body = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"></head>
<body style="margin:0;padding:0;background:#f2f2f2;font-family:Arial,Helvetica,sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f2f2f2;padding:40px 0;">
  <tr><td align="center">
    <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;">

      <tr><td style="background:#1a1a1a;padding:32px 40px;border-radius:8px 8px 0 0;">
        <p style="margin:0 0 4px 0;font-size:11px;letter-spacing:2px;text-transform:uppercase;color:#c0392b;font-weight:700;">Mesquita Realizações</p>
        <h1 style="margin:0;font-size:22px;color:#ffffff;font-weight:700;line-height:1.3;">Nova mensagem recebida pelo site</h1>
        <p style="margin:8px 0 0 0;font-size:13px;color:#999999;">{$dataHora}</p>
      </td></tr>

      <tr><td style="background:#ffffff;padding:40px;">

        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
          <tr><td style="border-left:3px solid #c0392b;padding-left:12px;">
            <p style="margin:0 0 2px 0;font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#999999;font-weight:700;">Nome</p>
            <p style="margin:0;font-size:16px;color:#1a1a1a;font-weight:600;">{$nome}</p>
          </td></tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
          <tr><td style="border-left:3px solid #c0392b;padding-left:12px;">
            <p style="margin:0 0 2px 0;font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#999999;font-weight:700;">E-mail</p>
            <p style="margin:0;font-size:16px;color:#1a1a1a;">{$email}</p>
          </td></tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:32px;">
          <tr><td style="border-left:3px solid #c0392b;padding-left:12px;">
            <p style="margin:0 0 2px 0;font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#999999;font-weight:700;">Telefone</p>
            <p style="margin:0;font-size:16px;color:#1a1a1a;">{$telefone}</p>
          </td></tr>
        </table>

        <table width="100%" cellpadding="0" cellspacing="0">
          <tr><td style="background:#f8f8f8;border:1px solid #ebebeb;border-radius:6px;padding:20px;">
            <p style="margin:0 0 8px 0;font-size:11px;letter-spacing:1px;text-transform:uppercase;color:#999999;font-weight:700;">Mensagem</p>
            <p style="margin:0;font-size:15px;color:#333333;line-height:1.7;">{$mensagemHtml}</p>
          </td></tr>
        </table>

      </td></tr>

      <tr><td style="background:#f8f8f8;padding:24px 40px;border-top:1px solid #ebebeb;border-radius:0 0 8px 8px;">
        <p style="margin:0;font-size:12px;color:#999999;line-height:1.6;">Este e-mail foi enviado automaticamente a partir do formulário de contato de <a href="https://mesquitarealizacoes.com.br" style="color:#c0392b;text-decoration:none;">mesquitarealizacoes.com.br</a>. Não responda este e-mail diretamente — entre em contato com o cliente pelo e-mail ou telefone informados acima.</p>
      </td></tr>

    </table>
  </td></tr>
</table>
</body></html>
HTML;

            Mailer::send($emailDestino, $assunto, $body);
        }

        echo json_encode(['success' => true, 'message' => 'Mensagem enviada! Entraremos em contato em breve.']);
        exit;
    }
}
