<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $comment = htmlspecialchars(trim($_POST['comment'] ?? ''));

    if (!$name || !$email || !$comment) {
        echo "Please fill in all fields correctly.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'unique20010927@gmail.com'; // Your Gmail
        $mail->Password   = 'uyux mjfv mxkn kabw';         // Your app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('unique20010927@gmail.com', 'School Website');
        $mail->addAddress('unique20010927@gmail.com');  // Send to your email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Comment from Website';
        $mail->Body    = "<h3>New Comment Received</h3>
                          <p><strong>Name:</strong> {$name}</p>
                          <p><strong>Email:</strong> {$email}</p>
                          <p><strong>Comment:</strong><br>" . nl2br($comment) . "</p>";

        $mail->send();

        header("Location: thanks.html");
exit();

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>
