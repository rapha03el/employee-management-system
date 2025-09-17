<?php
session_start();
include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Employee Management System</title>
    <link rel="stylesheet" href="includes/style.css">
</head>
<body class="auth-body">

    <div class="auth-container">
        <h2>Create an Account</h2>
        <p class="auth-subtitle">Join the Employee Management System</p>

        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>

        <form action="register_process.php" method="POST">
            <input type="email" name="email" placeholder="Email" class="auth-input" required>
            <input type="password" name="password" placeholder="Password" class="auth-input" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" class="auth-input" required>
            <button type="submit" class="auth-btn">Register</button>
        </form>

        <p class="auth-link">Already have an account? <a href="login.php">Login</a></p>
    </div>

</body>
</html>
