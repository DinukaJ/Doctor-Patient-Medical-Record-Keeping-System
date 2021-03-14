<?php
function sendActiveReset($name, $email, $link, $type)
{
  $msgFile = array('../emails/aemail.html','');
  $msgSub = array('Welcome to Madagoda Medical Center - Confirm','Password Reset - Madagoda Medical Center');
  $to = $email;
  $from = "madagodamedicalcenter@gmail.com";
  $subject = $msgSub[$type];
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= "From : <$from> \r\n ";

  $msg = file_get_contents($msgFile[$type]);
  $msg = str_replace('#name#',$name,$msg);
  $msg = str_replace('#link#',$link,$msg);

  require_once("PHPMailer/PHPMailerAutoload.php");
  $mail = new PHPMailer;
  $mail->SMTPDebug = 0;
  $mail->CharSet = 'UTF-8';
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure='tls';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->isHTML();
  $mail->Username = 'madagodamedicalcenter@gmail.com';
  $mail->Password = 'madagoda#123';
  $mail->setFrom('madagodamedicalcenter@gmail.com',"Madagoda Medical Center");
  $mail->Subject=$subject;
  $mail->Body = $msg;
  $mail->addAddress($to);   
  return $mail->send();
}
?>