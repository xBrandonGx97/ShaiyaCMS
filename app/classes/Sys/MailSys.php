<?php

   namespace Classes\Sys;

   use PHPMailer\PHPMailer\PHPMailer;

   class MailSys
   {
       protected $mail;
       private $msgSubject;
       private $msgContent;

       public function __construct($host)
       {
           $this->mail = new PHPMailer();
           if ($host === 'local') {
               $this->mail_local();
           } elseif ($host === 'gmail') {
               $this->mail_gmail();
           }
       }

       public function mail_local()
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

       public function mail_gmail()
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
       }

       public function sendMail($mail_for, $data)
       {
           $this->messages($mail_for, $data);
           $this->mail->Subject = $this->msgSubject;
           $this->mail->Body = $this->msgContent;
           if ($this->mail->send()) {
               echo 'email sent';
           } else {
               echo 'error: ' . $this->mail->ErrorInfo;
           }
       }

       public function messages($mail_for, $data)
       {
           if ($mail_for === 'testEmail') {
               $this->msgSubject = 'Hello - from the other side!';
               $this->msgContent = 'Hi dood!</br>';
               $this->msgContent .= 'Your username is: ' . $data;
           }
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
