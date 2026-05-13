<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.html?error=invalidemail");
        exit();
    }

    $to = "bolana@gmail.com"; // your email address
    $email_content = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";

    // Better From header
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $email_content, $headers)) {
        // Redirect to thankyou page after success
        header("Location: thankyou.html");
        exit();
    } else {
        // Redirect back to contact page with error query param
        header("Location: contact.html?error=sendfail");
        exit();
    }
} else {
    // Redirect if accessed directly
    header("Location: contact.html");
    exit();
}
?>
