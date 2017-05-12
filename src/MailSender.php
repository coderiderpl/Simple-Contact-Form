<?php

namespace CodeRider\Extensions\Mailer;

class MailSender {
  
/*
* @param $message string Message to send
* @param $config array Config for PHP Mailer
*/
  
  public function __construct($message, $config) {
    
    $this->message = $message;
    $this->config = $config;
      
  }
  
/*
* Send e-mail via PHP Mailer
* Returns true if mail has been sent or false of not
*/
  
  public function send() {
    
    $mail = new \PHPMailer();
    $mail->SMTPDebug = 0;
    # $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->CharSet = 'utf-8';
    $mail->Host = $this->config['host'];
    $mail->Port = $this->config['port'];
    $mail->Username = $this->config['user'];
    $mail->Pasword = $this->config['password'];
    $mail->AddAddress($this->config['to']);

    # Mail
    $mail->SetFrom($this->config['user']);
    $mail->Subject = $this->config['subject'];
    $mail->AddReplyTo($this->config['user']);
    $mail->MsgHTML(message);

    if (!$mail->send()) {
      # $mail->ErrorInfo;
      return false;
      return;
    } else {
      return true;
    }
    
  }
  
  
}
