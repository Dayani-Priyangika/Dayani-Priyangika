<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $to = "bolana@gmail.com";
    $email_content  = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message\n";
    $headers = "From: $name <$email>";

    if (mail($to, $subject, $email_content, $headers)) {
        header("Location: contact.html?success=1");
        exit;
    } else {
        header("Location: contact.html?error=1");
        exit;
    }
} else {
    header("Location: contact.html");
    exit;
}
?>
