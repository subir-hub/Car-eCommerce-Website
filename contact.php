<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Example: Save to database or send email
    // For now, just display confirmation
    $_SESSION['name'] = $name;

    header("Location: dashboard.php");
    
} else {
    header("Location: index.php");
    exit();
}
