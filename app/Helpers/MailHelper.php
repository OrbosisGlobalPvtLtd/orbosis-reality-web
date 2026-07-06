<?php

namespace App\Helpers;

use App\Models\EmailConfiguration;

class MailHelper
{

    public static function setMailConfig(){

        if (env('MAIL_HOST')) {
            $mailConfig = [
                'transport' => env('MAIL_MAILER', 'smtp'),
                'host' => env('MAIL_HOST'),
                'port' => env('MAIL_PORT', 587),
                'encryption' => env('MAIL_ENCRYPTION', 'tls'),
                'username' => env('MAIL_USERNAME'),
                'password' => env('MAIL_PASSWORD'),
                'timeout' => null
            ];

            config(['mail.mailers.smtp' => $mailConfig]);
            config(['mail.from.address' => env('MAIL_FROM_ADDRESS')]);
            config(['mail.from.name' => env('MAIL_FROM_NAME', 'Orbosis Reality')]);
            return;
        }

        $email_setting=EmailConfiguration::first();

        if ($email_setting) {
            $mailConfig = [
                'transport' => 'smtp',
                'host' => $email_setting->mail_host,
                'port' => $email_setting->mail_port,
                'encryption' => $email_setting->mail_encryption,
                'username' => $email_setting->smtp_username,
                'password' =>$email_setting->smtp_password,
                'timeout' => null
            ];

            config(['mail.mailers.smtp' => $mailConfig]);
            config(['mail.from.address' => $email_setting->email]);
        }
        config(['mail.from.name' => 'Orbosis Reality']);
    }
}
