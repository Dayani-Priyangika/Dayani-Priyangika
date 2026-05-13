<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.html?error=invalidemail");
        exit();
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'unique20010927@gmail.com';       // Your Gmail
        $mail->Password   = 'jjom datp fpsi gtqz';   // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender and recipient
        $mail->setFrom('unique20010927@gmail.com', 'Website Contact Form');
        $mail->addAddress('unique20010927@gmail.com'); // Your receiving email
        $mail->addReplyTo($email, $name);

        // Email content
        $mail->isHTML(false);
        $mail->Subject = "Contact Form: " . $subject;
        $mail->Body    = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";

        // Send email
        if ($mail->send()) {
            header("Location: contact.html?success=1");
            exit();
        } else {
            header("Location: contact.html?error=sendfail");
            exit();
        }
    } catch (Exception $e) {
        header("Location: contact.html?error=sendfail");
        exit();
    }
} else {
    header("Location: contact.html");
    exit();
}
