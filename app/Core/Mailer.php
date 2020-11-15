<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    public static function send($mail, $subject, $message)
    {
        $settings = parse_ini_file('settings/smtp.ini');
        $mailer = new PHPMailer;
        $mailer->CharSet = 'UTF-8';
        $mailer->setFrom($settings['username']);
        $mailer->addAddress($mail);
        $mailer->Subject = $subject;
        $mailer->msgHTML($message);

        $mailer->isSMTP();
        $mailer->SMTPAuth = true;
        $mailer->SMTPDebug = 0;
        $mailer->Host = $settings['host'];
        $mailer->Port = $settings['port'];
        $mailer->Username = $settings['username'];
        $mailer->Password = $settings['password'];
        $mailer->send();
    }
}
