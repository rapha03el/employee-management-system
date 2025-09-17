<?php
// Include database connection
include("config.php");

// Start a session
session_start();

// If user submits the login form
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute query to fetch user by email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password and set session
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role_id'] = $user['role_id'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Employee Management System</title>
    <link rel="stylesheet" href="includes/style.css">
</head>
<body class="auth-body"> <!-- Important: apply the auth-body class -->

    <div class="auth-container">
        <h2>Employee Management System</h2>
        <p class="auth-subtitle">Login to your account</p>

        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
        echo "<p style='color: green;'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
        }
        ?>

        <form action="login_process.php" method="POST">
            <input type="email" name="email" placeholder="Email" class="auth-input" required>
            <input type="password" name="password" placeholder="Password" class="auth-input" required>
            <button type="submit" class="auth-btn">Login</button>
        </form>

        <p class="auth-link">Don’t have an account? <a href="register.php">Register</a></p>
    </div>

</body>
</html>
