<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->isSMTP();                                      
    $mail->Host       = 'smtp.gmail.com';                   
    $mail->SMTPAuth   = true;                     
    $mail->Username   = 'fatumamm99@gmail.com';                    
    $mail->Password   = 'mjdn nvnf qkcq iiyi';                           
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 587;                                  

    //Recipients
    $mail->setFrom('ics@gmail.com', 'Fatma');
    $mail->addAddress('musakasamuel@gmail.com', 'Benjamin Musaka');     

    $mail->isHTML(true);                              
    $mail->Subject = 'Your Verification Code';
    $mail->Body    = "Your verification code is: <strong>$code</strong>";
   

    $mail->send();
    echo 'Verification code sent to ' . $email;
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
