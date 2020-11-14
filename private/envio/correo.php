<?php

require './PHPMailer/Exception.php';
 require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
 
 

$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$pago = $_POST["pago"];
$mensaje = $_POST["mensaje"]; 

$body = " <p> nombre:" . $nombre . " </p> <p> \ndireccion:" . $direccion . "</p> <p> \npago:" . $pago . " </p> <p> \nmensaje:" . $mensaje  ;





   $mail = new PHPMailer(true);
 
  try {
       //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'usudomicilios@gmail.com';                     // SMTP username
    $mail->Password   = 'freefire777';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587; 
    $mail->setFrom('doliciliosshulton@gmail.com', 'Domicilios');
    $mail->addAddress('digieduardo2@gmail.com'); 
    $mail->addAddress('geo99garcia@gmail.com'); 
    

  
  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Pedido';
  $mail->Body    = $body;
 

  $mail->send();
  echo 'enviado correctamente';
   
  }
  catch (Exception $e) {
  echo " Error: {$mail->ErrorInfo}";
}  
?>

