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

    public function sendMail(string $mail_for, string $data): PHPMailer
    {
        $this->addMessageSubjectToMail($mail_for);
        $this->addMessageBodyToMail($mail_for, $data);
        $this->mail->Subject = $this->msgSubject;
        $this->mail->Body = $this->msgContent;
        if ($this->mail->send()) {
            return $this->mail;
        } else {
            throw new $this->mail->ErrorInfo;
        }
    }

    public function addMessageSubjectToMail(string $mail_for): PHPMailer
    {
        if ($mail_for === 'testEmail') {
            $this->msgSubject = 'Hello - from the other side!';
        }
        return $this->mail;
    }

    public function addMessageBodyToMail(string $mail_for, string $data): PHPMailer
    {
        if ($mail_for === 'testEmail') {
            $this->msgSubject = 'Hello - from the other side!';
            $this->msgContent = 'Hi dood!</br>';
            $this->msgContent .= 'Your username is: ' . $data;
        }
        return $this->mail;
    }

    public function setMailHost()
    {
    }

    public function setMailPort()
    {
    }

    public function setMailFrom()
    {
    }

    public function addMailAddress()
    {
    }

    public function setMessageTitle()
    {
    }

    public function setMessageContent()
    {
    }
}
