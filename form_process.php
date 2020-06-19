<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

$email = $_POST['email'];
$name = $_POST['name'];
$subject = $_POST['subject'];
$comments = $_POST['comments'];
$file = $_POST['file'];

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                   
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'gerasimosstefatos@gmail.com';                   
    $mail->Password   = 'monteeisaitrela1234';                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;                                   

    //Recipients
    $mail->setFrom('gerasimosstefatos@gmail.com');
    $mail->addAddress('gerasimosstefatos@gmail.com');     // Add a recipient
   

 
    $mail->addAttachment($file);
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    // $mail->Body = $comments;
    $mail->Body = $file;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}