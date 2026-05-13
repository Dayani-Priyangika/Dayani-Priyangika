<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    // Example: save to database or send email
    // For now, just display back the values
    echo "<div style='background:#dff0d8; padding:10px; margin:10px 0; border:1px solid green;'>
            <strong>Form Submitted!</strong><br>
            Name: $name<br>
            Email: $email<br>
            Message: $message
          </div>";
}
?>

<!-- Your original HTML and CSS start here -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Form</title>
<style>
/* Your existing CSS here */
</style>
</head>
<body>

<form action="" method="POST">
    <label>Name:</label>
    <input type="text" name="name" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Message:</label>
    <textarea name="message" required></textarea><br><br>

    <button type="submit">Submit</button>
</form>

</body>
</html>
