<?php
session_start();
include("config.php");

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: register.php");
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        $_SESSION['error'] = "Email already registered!";
        header("Location: register.php");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user with role = 'employee'
    $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$email, $hashedPassword, 'employee']);

    $_SESSION['success'] = "Registration successful! Please log in.";
    header("Location: login.php");
    exit();
}
?>
