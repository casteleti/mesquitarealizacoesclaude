<?php

declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailerException;

require_once ROOT . '/includes/vendor/PHPMailer/src/Exception.php';
require_once ROOT . '/includes/vendor/PHPMailer/src/PHPMailer.php';
require_once ROOT . '/includes/vendor/PHPMailer/src/SMTP.php';

class Mailer
{
    public static function send(
        string $to,
        string $subject,
        string $body,
        string $from = '',
        string $fromName = 'Mesquita Realizações'
    ): bool {
        $cfg = Configuracao::getAll();

        $host     = $cfg['smtp_host'] ?? '';
        $port     = (int) ($cfg['smtp_port'] ?? 587);
        $username = $cfg['smtp_user'] ?? '';
        $password = $cfg['smtp_pass'] ?? '';
        $fromAddr = $from ?: ($cfg['email'] ?? 'noreply@mesquitarealizacoes.com.br');

        if (!$host || !$username) {
            error_log('Mailer: SMTP not configured.');
            return false;
        }

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = $host;
            $mail->Port       = $port;
            $mail->SMTPAuth   = true;
            $mail->Username   = $username;
            $mail->Password   = $password;
            $mail->SMTPSecure = $port === 465 ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom($fromAddr, $fromName);
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
            return true;
        } catch (MailerException $e) {
            error_log('Mailer error: ' . $e->getMessage());
            return false;
        }
    }
}
