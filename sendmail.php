<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the Composer autoloader
require 'vendor/autoload.php';
require 'email-credentials.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['Email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['Subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['Message'], FILTER_SANITIZE_STRING);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alertMessage = 'Invalid email address.';
        $alertType = 'error';
    } else {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = SMTP_PORT;

            $mail->setFrom('enquiries@reticledev.co.za', 'Reticle Dev Contact');
            $mail->addAddress('enquiries@reticledev.co.za');
            $mail->addReplyTo($email, $name);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "<h3>Contact Form Submission</h3>
                           <p><strong>Name:</strong> $name</p>
                           <p><strong>Email:</strong> $email</p>
                           <p><strong>Subject:</strong> $subject</p>
                           <p><strong>Message:</strong> $message</p>";
            $mail->AltBody = "Name: $name\nEmail: $email\nSubject: $subject\nMessage: $message";

            $mail->send();
            $alertMessage = 'Your message has been sent successfully!';
            $alertType = 'success';
        } catch (Exception $e) {
            $alertMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $alertType = 'error';
        }
    }
}
?>