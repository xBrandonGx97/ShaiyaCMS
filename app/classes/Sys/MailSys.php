<?php

namespace Classes\Sys;

use PHPMailer\PHPMailer\PHPMailer;

class MailSys
{
    protected $mail;
    private $msgSubject;
    private $msgContent;

    public function __construct(string $host)
    {
        if ($host === 'local') {
            $this->mail = $this->mailLocal();
        }

        $this->mail = $this->mailGmail();
    }

    private function mailLocal(): PHPMailer
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = config['mail']['host'];
        $mail->Port = config['mail']['port'];
        $mail->isHTML(true);
        $mail->setFrom(config['mail']['reply_email'], config['mail']['reply_name']);
        $mail->addAddress('userNametoSendTo@gmail.com');

        return $mail;
    }

    private function mailGmail(): PHPMailer
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = config['mail']['host'];
        $mail->SMTPAuth = config['mail']['auth'];
        $mail->Username = config['mail']['user'];
        $mail->Password = config['mail']['pass'];
        $mail->Port = config['mail']['port'];
        $mail->SMTPSecure = config['mail']['protocol'];

        $mail->isHTML(true);
        $mail->setFrom(config['mail']['reply_email'], config['mail']['reply_name']);
        $mail->addAddress('brandonjm033@gmail.com');

        return $mail;
    }

    public function sendMail(string $mail_for, string $data): void
    {
        $this->addMessageSubjectToMail($mail_for);
        $this->addMessageBodyToMail($mail_for, $data);
        $this->mail->Subject = $this->msgSubject;
        $this->mail->Body = $this->msgContent;
        if ($this->mail->send()) {
            //
        } else {
            throw new $this->mail->ErrorInfo;
        }
    }

    private function addMessageSubjectToMail(string $mail_for): void
    {
        if ($mail_for === 'testEmail') {
            $this->msgSubject = 'Hello - from the other side!';
        }
    }

    private function addMessageBodyToMail(string $mail_for, string $data): void
    {
        if ($mail_for === 'testEmail') {
            $this->msgSubject = 'Hello - from the other side!';
            $this->msgContent = 'Hi dood!</br>';
            $this->msgContent .= 'Your username is: ' . $data;
        }
    }

    private function presetMessages()
    {
        // add preset messages here
    }

    private function setMailHost()
    {
    }

    private function setMailPort()
    {
    }

    private function setMailFrom()
    {
    }

    private function addMailAddress()
    {
    }

    private function setMessageTitle()
    {
    }

    private function setMessageContent()
    {
    }
}
