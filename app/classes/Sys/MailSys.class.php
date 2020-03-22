<?php

   namespace Classes\Sys;

   use PHPMailer\PHPMailer\PHPMailer;

   if (!defined('IN_CMS')) {
       die('<b>' . __NAMESPACE__ . '\MailSys</b>: unauthorized access detected, exiting...');
   }

    class MailSys
    {
        private static $mail;
        private static $msgSubject;
        private static $msgContent;

        public static function sendMail($host, $mail_for, $data)
        {
            if ($host === 'gmail') {
                self::messages($mail_for, $data);
                self::mail_gmail();
            } elseif ($host === 'localhost') {
                self::mail_local();
            }
        }

        public static function messages($mail_for, $data)
        {
            if ($mail_for === 'testEmail') {
                self::$msgSubject = 'Hello - from the other side!';
                self::$msgContent = 'Hi dood!</br>';
                self::$msgContent .= 'Your username is: ' . $data[0];
            }
        }

        public static function mail_local()
        {
            self::$mail = new PHPMailer();

            self::$mail->isSMTP();
            self::$mail->Host = config['mail']['host'];
            self::$mail->Port = config['mail']['port'];

            self::$mail->isHTML(true);
            self::$mail->setFrom(config['mail']['reply_email'], config['mail']['reply_name']);
            self::$mail->addAddress('userNametoSendTo@gmail.com');
            self::$mail->Subject = self::$msgSubject;
            self::$mail->Body = self::$msgContent;

            if (self::$mail->send()) {
                echo 'email sent';
            } else {
                echo 'error: ' . self::$mail->ErrorInfo;
            }
        }

        public static function mail_gmail()
        {
            self::$mail = new PHPMailer();

            self::$mail->isSMTP();
            self::$mail->Host = config['mail']['host'];
            self::$mail->SMTPAuth = config['mail']['auth'];
            self::$mail->Username = config['mail']['user'];
            self::$mail->Password = config['mail']['pass'];
            self::$mail->Port = config['mail']['port'];
            self::$mail->SMTPSecure = config['mail']['protocol'];

            self::$mail->isHTML(true);
            self::$mail->setFrom(config['mail']['reply_email'], config['mail']['reply_name']);
            self::$mail->addAddress('userNametoSendTo@gmail.com');
            self::$mail->Subject = self::$msgSubject;
            self::$mail->Body = self::$msgContent;

            if (self::$mail->send()) {
                echo 'email sent';
            } else {
                echo 'error: ' . self::$mail->ErrorInfo;
            }
        }
    }
