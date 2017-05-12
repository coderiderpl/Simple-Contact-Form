<?php

$smtp = [
  
  'host' => 'mail.' . str_replace('www.', '', $_SERVER['HTTP_HOST']),
  'user' => 'mailer@' . str_replace('www.', '', $_SERVER['HTTP_HOST']),
  'password' => 'Kss5s89s6s',
  'subject' => 'Contact Form: ' . str_replace('www.', '', $_SERVER['HTTP_HOST']),
  'to' => 'larsentier@gmx.com',
  'from' => 'mailer@' . str_replace('www.', '', $_SERVER['HTTP_HOST']),
  'port' => 25,

  
  
];

?>