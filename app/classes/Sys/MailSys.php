<?php

namespace Classes\Sys;

use PHPMailer\PHPMailer\PHPMailer;

class MailSys
{
    protected $mail;
    private $msgSubject;
    private $msgContent;

    public function __construct(string $host): void
    {
        $this->getMailer($host);
    }

    public function getMailer(string $host): string
    {
        $this->mail = new PHPMailer();
        if ($host === 'local') {
            return $this->mailLocal();
        }
        return $this->mailGmail();
    }

    public function mailLocal(): string
    {
        $this->mail->isSMTP();
        $this->mail->Host = config['mail']['host'];
        $this->mail->Port = config['mail']['port'];

        $this->mail->isHTML(true);
        $this->mail->setFrom(config['mail']['reply_email'], config['mail']['reply_name']);
        $this->mail->addAddress('userNametoSendTo@gmail.com');

        return 'mailerFound';
    }

    public function mailGmail(): string
    {
        $this->mail->isSMTP();
        $this->mail->Host = config['mail']['host'];
        $this->mail->SMTPAuth = config['mail']['auth'];
        $this->mail->Username = config['mail']['user'];
        $this->mail->Password = config['mail']['pass'];
        $this->mail->Port = config['mail']['port'];
        $this->mail->SMTPSecure = config['mail']['protocol'];

        $this->mail->isHTML(true);
        $this->mail->setFrom(config['mail']['reply_email'], config['mail']['reply_name']);
        $this->mail->addAddress('brandonjm033@gmail.com');

        return 'mailerFound';
    }

    public function sendMail(string $mail_for, string $data): string
    {
        $this->messages($mail_for, $data);
        $this->mail->Subject = $this->msgSubject;
        $this->mail->Body = $this->msgContent;
        if ($this->mail->send()) {
            return 'emailSent';
        } else {
            throw new $this->mail->ErrorInfo;
        }
    }

    public function messages(string $mail_for, string $data): string
    {
        if ($mail_for === 'testEmail') {
            $this->msgSubject = 'Hello - from the other side!';
            $this->msgContent = 'Hi dood!</br>';
            $this->msgContent .= 'Your username is: ' . $data;
        }
        return 'messageCreated';
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
