<?php
ob_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

$email = $_POST['email'];
$name = $_POST['name'];
$subject = $_POST['subject'];
$comments = $_POST['comments'];


if(isset($_FILES['upload_file']))
{
    $file_name = $_FILES['upload_file']['name'];
    $file_tem_loc = $_FILES['upload_file']['tmp_name'];
    $file_store = "upload/".$file_name;
    move_uploaded_file($file_tem_loc, $file_store);

}

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
    $mail->isSMTP();                                           
    $mail->Host       = 'mail.qcell.tech';                   
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'g.stefatos@qcell.tech';                   
    $mail->Password   = 'M~JTcv=hlre3';                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
    $mail->Port       = 587;                                   

    //Recipients
    $mail->setFrom('g.stefatos@qcell.tech');
    $mail->addAddress('g.stefatos@qcell.tech'); 

        // Add a recipient
    if(empty($_FILES['upload_file']['name']))
    {
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $email;
        $mail->send();

        header('Location: Contact.html');
            die();
    }
          
         if(!empty($_FILES['upload_file']['name']))
         {
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->addAttachment($file_store);
            $mail->Body = $email;
            $mail->send();
            unlink("upload/".$_FILES['upload_file']['name']);
            header('Location: Contact.html');
                die();
         }
      
           

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
ob_end_flush();
?>