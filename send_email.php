<?php

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_verification_mail($toEmail, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.mail.yahoo.com';  // Yahoo SMTP server
        $mail->SMTPAuth = true;

        $mail->Username = 'tiganescu.iustin@yahoo.com';
        require('config.php'); // Asigură-te că acest fișier conține $SMTP_SECRET corect
        $mail->Password = $SMTP_SECRET;

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // TLS port
        $mail->SMTPDebug = 0; // Dezactivează mesaje de debug
        $mail->setFrom('tiganescu.iustin@yahoo.com', 'Numele Tau');
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        echo "Email trimis cu succes la $toEmail \n";
    } catch (Exception $e) {
        echo "Eroare la trimiterea emailului: " . $e->getMessage();
    }
}
?>
