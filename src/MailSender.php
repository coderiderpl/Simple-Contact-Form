<?php

namespace CodeRider;

session_start();

class MailSender {
  
/*
* @param $config array Config for PHP mailer
* @param $inputs array INputs from HTML Form
*/
  
  public function __construct(array $config, array $inputs) {
    
    $this->config = $config;
    $this->inputs = $inputs;
      
  }
  
/*
* Send e-mail via PHP Mailer, set error or success to $_SESSION
*/
  
  public function send() {
    
    if (!$this->validate()) {
      $_SESSION['contact-form']['error'] = 'All fields are required.';
      $_SESSION['contact-form']['inputs'] = $this->inputs;
      return;
    }
    
    
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
    if (isset($inputs['mail'])) {
      $mail->AddReplyTo($inputs['mail']);
    } else {
      $mail->AddReplyTo($this->config['user']);
    }
    $mail->MsgHTML($this->prepareMessage());


    if (!$mail->send()) {
      $_SESSION['contact-form']['error'] = 'Message could not be sent.';
      $_SESSION['contact-form']['inputs'] = $this->inputs;
      # $_SESSION['contact-form']['error'] = 'Message could not be sent: ' . $mail->ErrorInfo;
      return;
    } else {
      $_SESSION['contact-form']['success'] = 'Message has been sent.';
      return;
    }
    
  }
  
/*
* Validate whether inputs are empty
*/
  
  private function validate() {
    
    foreach ($this->inputs as $input) {

      if (empty(trim($input))) {
        return false;
      }

    }
    
    return 1;
    
  }
  
/*
* Insert all inputs into message
*/
  
  private function prepareMessage() {
    
    foreach ($this->inputs as $key=>$input) {
      
      $part = nl2br($input);
      $part = '<p>' . $key . ': ' . $input . '</p>';
      $content[] = $part;
      
    }
    $content = implode('', $content);
    return $content;
    
  }
  
}