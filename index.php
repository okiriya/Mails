<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$file = 'email.php';

//Create an instance; passing `true` enables exceptions
// $mail = new PHPMailer(true);
$phpmailer = new PHPMailer(true);
if(file_exists($file)){
    $message = file_get_contents($file);
}

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    // $mail->isSMTP();                                            //Send using SMTP
    // $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    // $mail->Username   = 'user@example.com';                     //SMTP username
    // $mail->Password   = 'secret';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    // $mail->Port       = 465; 
    $phpmailer->SMTPDebug = SMTP::DEBUG_SERVER;  
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'ed1b0a7af22404';
    $phpmailer->Password = '2fe177f47c3878';//TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $phpmailer->setFrom('mycompany@example.com', 'Mailer');
    $phpmailer->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $phpmailer->addAddress('ellen@example.com');               //Name is optional
    $phpmailer->addReplyTo('info@example.com', 'Information');
    $phpmailer->addCC('cc@example.com');
    $phpmailer->addBCC('bcc@example.com');

    //Attachments
    // $phpmailer->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $phpmailer->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $phpmailer->isHTML(true);                                  //Set email format to HTML
    $phpmailer->Subject = 'hi there greetings';
    $phpmailer->Body = $message;
    $phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $phpmailer->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
}
