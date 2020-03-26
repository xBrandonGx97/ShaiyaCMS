<?php

namespace Classes\Sys;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use App\Exceptions\MailException;

class MailSys
{
    protected $mail;
    private $msgSubject;
    private $msgContent;

    /*
        Example usage:
        $mail = new \Classes\Sys\MailSys('gmail');
        $mail->addMailAddress('emailToSendTo@gmail.com');
        $mail->sendMail('testEmail', 'xx');
    */

    public function __construct(string $host)
    {
        if ($host === 'local') {
            $this->mail = $this->mailLocal();
        }

        $this->mail = $this->mailGmail();
    }

    private function mailLocal(): PHPMailer
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = MAIL['host'];
        $mail->Port = MAIL['port'];
        $mail->isHTML(true);
        $mail->setFrom(MAIL['reply_email'], MAIL['reply_name']);

        return $mail;
    }

    private function mailGmail(): PHPMailer
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = MAIL['host'];
        $mail->SMTPAuth = MAIL['auth'];
        $mail->Username = MAIL['user'];
        $mail->Password = MAIL['pass'];
        $mail->Port = MAIL['port'];
        $mail->SMTPSecure = MAIL['protocol'];

        $mail->isHTML(true);
        $mail->setFrom(MAIL['reply_email'], MAIL['reply_name']);

        return $mail;
    }

    public function addMailAddress($address): void
    {
        $this->mail->addAddress($address);
    }

    public function addMessageSubjectToMail(string $subject): void
    {
        $this->msgSubject = $subject;
    }

    public function addMessageBodyToMail(string $body, string $data = null): void
    {
        if (!$body) {
            $this->msgContent = $body . $data;
        } else {
            $this->msgContent .= $body . $data . '<br>';
        }
    }

    private function presetMessages(string $mail_for, string $data = null): void
    {
        if ($mail_for === 'testEmail') {
            $this->msgSubject = 'Hello - from the other side!';
            $this->msgContent = 'Hi dood!</br>';
            $this->msgContent = 'Your username is: ' . $data;
        } elseif ($mail_for === 'verifyNewDevice') {
            $this->msgSubject = 'Please verify your new device';
            $this->msgContent .= '<a href="http://shaiyacms.local/auth/newDevice/verify/'.$data.'">Go to link</a>';
            $this->msgContent .= 'This link expires in 2 hours.';
        }
    }

    public function sendMail(string $mail_for = null, string $data = null): void
    {
        try {
            if ($mail_for) {
                $this->presetMessages($mail_for, $data);
            }
            $this->mail->Subject = $this->msgSubject;
            $this->mail->Body = $this->msgContent;

            $this->mail->send();
        } catch (PHPMailerException $e) {
            throw new MailException($e->getMessage());
            #echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
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

    private function setMessageTitle()
    {
    }

    private function setMessageContent()
    {
    }
}
