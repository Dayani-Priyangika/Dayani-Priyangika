<?php
session_start();

// Hardcoded credentials
$correct_username = 'admin';
$correct_password = '1234';

// Get form inputs
$username = $_POST['username'];
$password = $_POST['password'];

// Check credentials
if ($username === $correct_username && $password === $correct_password) {
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
    exit();
} else {
    echo "<script>alert('Incorrect username or password.'); window.location.href='index.html';</script>";
}
?>
