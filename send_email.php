<?php
require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'unique20010927@gmail.com';       // Your Gmail
        $mail->Password   = 'zsmudmzlxkzdzwnd';               // Your Gmail app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('unique20010927@gmail.com');

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'Contact Form: ' . $subject;
        $mail->Body    = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message\n";

        $mail->send();

        // Redirect to thank-you page after success
        header("Location: thank-you.html");
        exit;

    } catch (Exception $e) {
        // Show error message without redirect
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // If not POST, redirect back to form
    header("Location: contact2.html");
    exit;
}
